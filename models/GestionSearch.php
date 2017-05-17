<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gestion;

/**
 * GestionSearch represents the model behind the search form about `app\models\Gestion`.
 */
class GestionSearch extends Gestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'programaevento_id', 'solicitud_id', 'convenio_id',  'estatus3_id', 'rango_solicitante_id', 'rango_beneficiario_id', 'trabajador_id', 'created_by', 'updated_by', 'tipodecontacto_id'], 'integer'],
            [['militar_solicitante', 'militar_beneficiario', 'nino', ], 'boolean'],
            [['solicitante', 'estatus1_id', 'estatus2_id', 'cisolicitante', 'cibeneficiario', 'recepcion', 'beneficiario', 'necesidad', 'descripcion', 'fechadelcheque', 'anodelasolicitud', 'direccion', 'fechaactividad', 'fechaingreso', 'fechaultimamodificacion', 'tratamiento', 'mes_actividad', 'afrodescendiente', 'indigena', 'sexodiversidad', 'trabajadorsocial', 'trabajadoracargoactividad', 'especialidad', 'mesingreso', 'estado_actividad', 'tipodeayuda', 'estatussa', 'empresaoinstitucion', 'proceso', 'created_at', 'updated_at'], 'safe'],
            [['monto', 'cantidad',], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Gestion::find()
                ->select(['gestion.id', "extract(month from programaevento.fechaprograma)::int as mes_actividad", 'programaevento.descripcion', 'solicitudes.num_solicitud', 'gestion.programaevento_id', 
                'programaevento.id', 'solicitudes.id', 'gestion.solicitud_id', 'gestion.convenio_id', 'convenio.nombre', "estatus1.nombre as estatus1_id", 
                "estatus2.nombre as estatus2_id", 'gestion.estatus3_id', 'gestion.tipodecontacto_id', 'tipodecontacto.nombre', 'gestion.militar_solicitante',
                'gestion.rango_solicitante_id', 'gestion.militar_beneficiario', 'gestion.rango_beneficiario_id', 'gestion.afrodescendiente', 'gestion.indigena', 
                'gestion.sexodiversidad', 'gestion.trabajador_id', "personasolicitante.ci as cisolicitante", "personabeneficiario.ci as cibeneficiario", 
                "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) AS beneficiario", 'solicitudes.ind_beneficiario_menor as nino',
                "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido) AS solicitante", 'requerimientos.nombre as tratamiento', 'presupuestos.proceso_id', 
                'users.nombre as trabajadorsocial', 'solicitudes.usuario_asignacion_id', 'areas.nombre as especialidad', 'solicitudes.area_id', 
                'solicitudes.recepcion_id', 'recepciones.nombre as recepcion', 'presupuestos.montoapr as monto', "CONCAT(trabajadoracargo.dimprofesion || ' ' || trabajadoracargo.primernombre || ' ' || trabajadoracargo.primerapellido) AS trabajadoracargoactividad",
                "extract(month from solicitudes.created_at)::int as mesingreso", 'estadoactividad.nombre as estado_actividad', 'tipo_ayudas.nombre as tipodeayuda', 'estatussasyc.estatus as estatussa',
                'solicitudes.estatus', 'empresa_institucion.nombrecompleto as empresaoinstitucion', 'presupuestos.beneficiario_id', 'procesos.nombre as proceso', 'presupuestos.cantidad as cantidad']);

        // add conditions that should always apply here
        
        $query->join('LEFT JOIN', 'convenio', 'gestion.convenio_id = convenio.id')
                ->join('LEFT JOIN', 'solicitudes','gestion.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'programaevento', 'gestion.programaevento_id = programaevento.id')
                ->join('LEFT JOIN', 'tipodecontacto', 'gestion.tipodecontacto_id = tipodecontacto.id')               
                ->join('LEFT JOIN', 'users', 'solicitudes.usuario_asignacion_id = users.id')
                ->join('LEFT JOIN', 'estatussasyc', 'solicitudes.estatus = estatussasyc.id')
                ->join('LEFT JOIN', 'recepciones', 'solicitudes.recepcion_id = recepciones.id')
                ->join('LEFT JOIN', 'presupuestos', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'requerimientos', 'presupuestos.requerimiento_id = requerimientos.id')
                ->join('LEFT JOIN', 'procesos', 'presupuestos.proceso_id = procesos.id')
                ->join('LEFT JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
                ->join('LEFT JOIN', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                ->join('LEFT JOIN', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                ->join('LEFT JOIN', 'tipo_requerimientos', 'requerimientos.tipo_requerimiento_id = tipo_requerimientos.id')
                ->join('LEFT JOIN', 'areas', 'solicitudes.area_id = areas.id')
                ->join('LEFT JOIN', 'tipo_ayudas', 'areas.tipo_ayuda_id = tipo_ayudas.id')
                ->join('LEFT JOIN', 'personas as personasolicitante', 'solicitudes.persona_solicitante_id = personasolicitante.id')
                ->join('LEFT JOIN', 'personas as personabeneficiario', 'solicitudes.persona_beneficiario_id  = personabeneficiario.id')
                ->join('LEFT JOIN', 'empresa_institucion', 'presupuestos.beneficiario_id = empresa_institucion.id')
                ->join('LEFT JOIN', 'rangosmilitares as rangosolicitante', 'gestion.rango_solicitante_id = rangosolicitante.id')
                ->join('LEFT JOIN', 'rangosmilitares as rangobeneficiario', 'gestion.rango_beneficiario_id = rangobeneficiario.id')
                ->join('LEFT JOIN', 'trabajador as trabajadoracargo', 'programaevento.trabajadoracargo_id = trabajadoracargo.id')
                ->join('LEFT JOIN', 'parroquias as parroquiaactividad', 'programaevento.parroquia_id = parroquiaactividad.id')
                ->join('LEFT JOIN', 'municipios as municipioactividad', 'parroquiaactividad.municipio_id = municipioactividad.id')
                ->join('LEFT JOIN', 'estados as estadoactividad', 'municipioactividad.estado_id = estadoactividad.id');
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'solicitud_id' => SORT_DESC,
                ],
                'attributes' => [
                    'solicitud_id' => [
                        'asc' => ['gestion.solicitud_id' => \SORT_ASC],
                        'desc' => ['gestion.solicitud_id' => \SORT_DESC],
                    ],
                    'estatus1_id' => [
                        'asc' => ['estatus1.nombre' => \SORT_ASC],
                        'desc' => ['estatus1.nombre' => \SORT_DESC],
                    ],
                    'estatus2_id' => [
                        'asc' => ['estatus2.nombre' => \SORT_ASC],
                        'desc' => ['estatus2.nombre' => \SORT_DESC],
                    ],
                    'estatus3_id' => [
                        'asc' => ['estatus3.nombre' => \SORT_ASC],
                        'desc' => ['estatus3.nombre' => \SORT_DESC],
                    ],
                    'tipodecontacto_id' => [
                        'asc' => ['tipodecontacto.nombre' => \SORT_ASC],
                        'desc' => ['tipodecontacto.nombre' => \SORT_DESC],
                    ],
                    'programaevento_id' => [
                        'asc' => ['programaevento.descripcion' => \SORT_ASC],
                        'desc' => ['programaevento.descripcion' => \SORT_DESC],
                    ],
                    'convenio_id' => [
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'militar_solicitante' => [ 
                        'asc' => ['gestion.militar_solicitante' => \SORT_ASC],
                        'desc' => ['gestion.militar_solicitante' => \SORT_DESC],
                    ],
                    'rango_solicitante_id' => [ 
                        'asc' => ['rangosolicitante.nombre' => \SORT_ASC],
                        'desc' => ['rangosolicitante.nombre' => \SORT_DESC],
                    ],
                    'militar_beneficiario' => [ 
                        'asc' => ['gestion.militar_beneficiario' => \SORT_ASC],
                        'desc' => ['gestion.militar_beneficiario' => \SORT_DESC],
                    ],
                    'rango_beneficiario_id' => [ 
                        'asc' => ['rangobeneficiario.nombre' => \SORT_ASC],
                        'desc' => ['rangobeneficiario.nombre' => \SORT_DESC],
                    ],
                    'afrodescendiente' => [ 
                        'asc' => ['gestion.afrodescendiente' => \SORT_ASC],
                        'desc' => ['gestion.afrodescendiente' => \SORT_DESC],
                    ],
                    'indigena' => [ 
                        'asc' => ['gestion.indigena' => \SORT_ASC],
                        'desc' => ['gestion.indigena' => \SORT_DESC],
                    ],
                    'sexodiversidad' => [ 
                        'asc' => ['gestion.sexodiversidad' => \SORT_ASC],
                        'desc' => ['gestion.sexodiversidad' => \SORT_DESC],
                    ],
                    'trabajador_id' => [ 
                        'asc' => ['gestion.trabajador_id' => \SORT_ASC],
                        'desc' => ['gestion.trabajador_id' => \SORT_DESC],
                    ],
                    'mes_actividad' => [ 
                        'asc' => ['mes_actividad' => \SORT_ASC],
                        'desc' => ['mes_actividad' => \SORT_DESC],
                    ],
                    'solicitante' => [ 
                        'asc' => ['solicitante' => \SORT_ASC],
                        'desc' => ['solicitante' => \SORT_DESC],
                    ],
                    'cisolicitante' => [ 
                        'asc' => ['cisolicitante' => \SORT_ASC],
                        'desc' => ['cisolicitante' => \SORT_DESC],
                    ],
                    'beneficiario' => [ 
                        'asc' => ['beneficiario' => \SORT_ASC],
                        'desc' => ['beneficiario' => \SORT_DESC],
                    ],
                    'cibeneficiario' => [ 
                        'asc' => ['cibeneficiario' => \SORT_ASC],
                        'desc' => ['cibeneficiario' => \SORT_DESC],
                    ],
                    'tratamiento' => [ 
                        'asc' => ['tratamiento' => \SORT_ASC],
                        'desc' => ['tratamiento' => \SORT_DESC],
                    ],
                    'nino' => [ 
                        'asc' => ['nino' => \SORT_ASC],
                        'desc' => ['nino' => \SORT_DESC],
                    ],
                    'trabajadorsocial' => [ 
                        'asc' => ['trabajadorsocial' => \SORT_ASC],
                        'desc' => ['trabajadorsocial' => \SORT_DESC],
                    ],
                    'especialidad' => [ 
                        'asc' => ['especialidad' => \SORT_ASC],
                        'desc' => ['especialidad' => \SORT_DESC],
                    ],
                    'recepcion' => [ 
                        'asc' => ['recepcion' => \SORT_ASC],
                        'desc' => ['recepcion' => \SORT_DESC],
                    ],
                    'necesidad' => [ 
                        'asc' => ['solicitudes.necesidad' => \SORT_ASC],
                        'desc' => ['solicitudes.necesidad' => \SORT_DESC],
                    ],
                    'monto' => [ 
                        'asc' => ['presupuestos.montoapr' => \SORT_ASC],
                        'desc' => ['presupuestos.montoapr' => \SORT_DESC],
                    ],
                    'trabajadoracargoactividad' => [ 
                        'asc' => ['trabajadoracargoactividad' => \SORT_ASC],
                        'desc' => ['trabajadoracargoactividad' => \SORT_DESC],
                    ],
                    'mesingreso' => [ 
                        'asc' => ['mesingreso' => \SORT_ASC],
                        'desc' => ['mesingreso' => \SORT_DESC],
                    ],
                    'estado_actividad' => [ 
                        'asc' => ['estado_actividad' => \SORT_ASC],
                        'desc' => ['estado_actividad' => \SORT_DESC],
                    ],
                    'tipodeayuda' => [ 
                        'asc' => ['tipodeayuda' => \SORT_ASC],
                        'desc' => ['tipodeayuda' => \SORT_DESC],
                    ],
                    'estatussa' => [ 
                        'asc' => ['estatussa' => \SORT_ASC],
                        'desc' => ['estatussa' => \SORT_DESC],
                    ],
                    'empresaoinstitucion' => [ 
                        'asc' => ['empresaoinstitucion' => \SORT_ASC],
                        'desc' => ['empresaoinstitucion' => \SORT_DESC],
                    ],
                    'proceso' => [ 
                        'asc' => ['proceso' => \SORT_ASC],
                        'desc' => ['proceso' => \SORT_DESC],
                    ],
                    'cantidad' => [ 
                        'asc' => ['cantidad' => \SORT_ASC],
                        'desc' => ['cantidad' => \SORT_DESC],
                    ],
                    'descripcion' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'diasdeultimamodificacion' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'diasdesolicitud' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'diasdesdeactividad' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'cheque' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'fechadelcheque' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'anodelasolicitud' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'direccion' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'fechaactividad' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'fechaingreso' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'estadodireccion' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
                    'fechaultimamodificacion' => [ 
                        'asc' => ['convenio.nombre' => \SORT_ASC],
                        'desc' => ['convenio.nombre' => \SORT_DESC],
                    ],
    
                ],
            ],
        
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'programaevento_id' => $this->programaevento_id,
            'solicitud_id' => $this->solicitud_id,
            'convenio_id' => $this->convenio_id,
            'estatus2_id' => $this->estatus2_id,
            'estatus3_id' => $this->estatus3_id,
            'militar_solicitante' => $this->militar_solicitante,
            'rango_solicitante_id' => $this->rango_solicitante_id,
            'militar_beneficiario' => $this->militar_beneficiario,
            'rango_beneficiario_id' => $this->rango_beneficiario_id,
            'trabajador_id' => $this->trabajador_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'tipodecontacto_id' => $this->tipodecontacto_id,
            'solicitudes.ind_beneficiario_menor' => $this->nino,
        ]);

        $query->andFilterWhere(['like', 'afrodescendiente', $this->afrodescendiente])
            ->andFilterWhere(['like', 'indigena', $this->indigena])
            ->andFilterWhere(['like', 'sexodiversidad', $this->sexodiversidad])
            ->andFilterWhere(['like', 'estatus1.nombre', $this->estatus1_id])
            ->andFilterWhere(['like', "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido)", $this->beneficiario])
            ->andFilterWhere(['like', "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido)", $this->solicitante])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personasolicitante.ci, '99999999'))", $this->cisolicitante])
            ->andFilterWhere(['=', 'extract(month from programaevento.fechaprograma)', $this->mes_actividad])
            ->andFilterWhere(['=', 'extract(month from solicitudes.created_at)', $this->mesingreso])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '99999999'))", $this->cibeneficiario])
            ->andFilterWhere(['like', 'requerimientos.nombre', $this->tratamiento])
            ->andFilterWhere(['like', 'users.nombre', $this->trabajadorsocial])
            ->andFilterWhere(['like', 'areas.nombre', $this->especialidad])
            ->andFilterWhere(['like', 'recepciones.nombre', $this->recepcion])
            ->andFilterWhere(['like', 'solicitudes.necesidad', $this->necesidad])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(presupuestos.monto, '9999999999999'))", $this->monto])
            ->andFilterWhere(['like', 'estadoactividad.nombre', $this->estado_actividad])
            ->andFilterWhere(['like', 'tipo_ayudas.nombre', $this->tipodeayuda])
            ->andFilterWhere(['like', 'estatussasyc.estatus', $this->estatussa])
            ->andFilterWhere(['like', 'empresa_institucion.nombrecompleto', $this->empresaoinstitucion])
            ->andFilterWhere(['like', 'procesos.nombre', $this->proceso])
            ->andFilterWhere(['like', "CONCAT(trabajadoracargo.dimprofesion || ' ' || trabajadoracargo.primernombre || ' ' || trabajadoracargo.primerapellido)", $this->trabajadoracargoactividad]);

        return $dataProvider;
    }
}
