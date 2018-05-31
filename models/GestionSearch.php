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
            [['id', 'programaevento_id', 'convenio_id',  'estatus3_id', 'rango_solicitante_id',
             'rango_beneficiario_id', 'trabajador_id', 'created_by', 'updated_by',
              'tipodecontacto_id', 'diasdeultimamodificacion', 'diasdesolicitud',
               'diasdesdeactividad', 'edadbeneficiario','instruccion_id', 'persona_beneficiario_id', 'persona_solicitante_id',], 'integer'],
            [['militar_solicitante', 'militar_beneficiario', 'nino', ], 'boolean'],
            [['solicitante', 'solicitud_id', 'estatus1_id', 'estatus2_id', 'cisolicitante', 'cibeneficiario', 'recepcion', 'beneficiario', 'necesidad', 'descripcion', 'anodelasolicitud', 'telefono', 'fechaactividad', 'fechaingreso', 'fechaaprobacion', 'fechaultimamodificacion', 'tratamiento', 'mes_actividad', 'afrodescendiente', 'indigena', 'sexodiversidad', 'trabajadorsocial', 'trabajadoracargoactividad', 'especialidad', 'mesingreso', 'estado_actividad', 'tipodeayuda', 'estatussa', 'empresaoinstitucion', 'proceso', 'cheque', 'direccion', 'estadodireccion','created_at', 'updated_at'], 'safe'],
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
                ->select([
                "extract(month from programaevento.fechaprograma)::int as mes_actividad",
                'programaevento.descripcion',
                'solicitudes.num_solicitud',
                'solicitudes.necesidad',
                'solicitudes.persona_beneficiario_id as persona_beneficiario_id',
                'solicitudes.persona_solicitante_id as persona_solicitante_id',
                'gestion.programaevento_id',
                'programaevento.id', 
                'solicitudes.id', 'gestion.id as id', 'gestion.solicitud_id', 'gestion.convenio_id', 'convenio.nombre', "estatus1.nombre as estatus1_id",
                "estatus2.nombre as estatus2_id", 'gestion.estatus3_id as estatus3_id', 'gestion.tipodecontacto_id', 'tipodecontacto.nombre', 'gestion.militar_solicitante',
                'gestion.rango_solicitante_id', 'gestion.militar_beneficiario', 'gestion.rango_beneficiario_id', 'gestion.afrodescendiente', 'gestion.indigena',
                'gestion.sexodiversidad', 'gestion.trabajador_id', "personasolicitante.ci as cisolicitante", "personabeneficiario.ci as cibeneficiario",
                "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) AS beneficiario", 'solicitudes.ind_beneficiario_menor as nino',
                "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido) AS solicitante",  "to_char(solicitudes.fecha_aprobacion, 'DD/MM/YYYY') as fechaaprobacion",
                'users.nombre as trabajadorsocial', 'solicitudes.usuario_asignacion_id', 'areas.nombre as especialidad', 'solicitudes.area_id',
                'solicitudes.recepcion_id', 'recepciones.nombre as recepcion', "CONCAT(trabajadoracargo.dimprofesion || ' ' || trabajadoracargo.primernombre || ' ' || trabajadoracargo.primerapellido) AS trabajadoracargoactividad",
                "extract(month from solicitudes.created_at)::int as mesingreso", 'estadoactividad.nombre as estado_actividad', 'tipo_ayudas.nombre as tipodeayuda', 'estatussasyc.estatus as estatussa',
                'solicitudes.estatus', 'procesos.nombre as proceso',
                'solicitudes.descripcion', "date_part('day' ,now()-gestion.updated_at) as diasdeultimamodificacion", "date_part('day' ,now()-solicitudes.created_at) as diasdesolicitud", "date_part('day' ,now()-programaevento.fechaprograma) as diasdesdeactividad",
                "extract(year from solicitudes.created_at) as anodelasolicitud", "CONCAT(estadobeneficiario.nombre || ' ' || municipiobeneficiario.nombre || ' ' || parroquiabeneficiario.nombre || ' ' || personabeneficiario.zona_sector || ' ' || personabeneficiario.calle_avenida || ' ' || personabeneficiario.apto_casa) as direccion",
                "to_char(programaevento.fechaprograma, 'DD/MM/YYYY') as fechaactividad", "to_char(solicitudes.created_at, 'DD/MM/YYYY') as fechaingreso", 'estadobeneficiario.nombre as estadodireccion', "TO_CHAR(gestion.updated_at, 'DD/MM/YYYY') as fechaultimamodificacion",
                "gestion.instruccion_id",
                "CONCAT(COALESCE(personabeneficiario.telefono_fijo || ' ', '') || COALESCE(personabeneficiario.telefono_celular || ' ', '') || COALESCE(personabeneficiario.telefono_otro || ' ', '') ) as telefono",
                "extract(YEAR FROM age(now(),personabeneficiario.fecha_nacimiento)) as edadbeneficiario", "string_agg(empresa_institucion.nombrecompleto, '  //  ') as empresaoinstitucion",
                "count(presupuestos.cantidad) as cantidad", "string_agg(presupuestos.cheque, ' / ') as cheque", "string_agg(to_char(presupuestos.beneficiario_id,'99999'), ', ')", "string_agg(to_char(presupuestos.proceso_id,'99999'), ', ')", "string_agg(requerimientos.nombre, ', ') as tratamiento", "sum(presupuestos.montoapr) as monto"]);

        // add conditions that should always apply here

        $query->join('LEFT JOIN', 'convenio', 'gestion.convenio_id = convenio.id')
                ->join('JOIN', 'solicitudes','gestion.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'programaevento', 'gestion.programaevento_id = programaevento.id')
                ->join('LEFT JOIN', 'tipodecontacto', 'gestion.tipodecontacto_id = tipodecontacto.id')
                ->join('LEFT JOIN', 'users', 'solicitudes.usuario_asignacion_id = users.id')
                ->join('LEFT JOIN', 'estatussasyc', 'solicitudes.estatus = estatussasyc.id')
                ->join('LEFT JOIN', 'recepciones', 'solicitudes.recepcion_id = recepciones.id')
                ->join('LEFT JOIN', 'presupuestos', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'requerimientos', 'presupuestos.requerimiento_id = requerimientos.id')
                ->join('LEFT JOIN', 'procesos', 'presupuestos.proceso_id = procesos.id')
                ->join('JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
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
                ->join('LEFT JOIN', 'estados as estadoactividad', 'municipioactividad.estado_id = estadoactividad.id')
                ->join('LEFT JOIN', 'parroquias as parroquiabeneficiario', 'personabeneficiario.parroquia_id = parroquiabeneficiario.id')
                ->join('LEFT JOIN', 'municipios as municipiobeneficiario', 'parroquiabeneficiario.municipio_id = municipiobeneficiario.id')
                ->join('LEFT JOIN', 'estados as estadobeneficiario', 'municipiobeneficiario.estado_id = estadobeneficiario.id')
                ->join('LEFT JOIN', 'instruccion', 'gestion.instruccion_id = instruccion.id')
                ->groupBy(['mes_actividad', 'programaevento.descripcion', 'solicitudes.num_solicitud',
                'solicitudes.necesidad',
                'persona_beneficiario_id',
                'persona_solicitante_id',
                'gestion.programaevento_id', 'programaevento.id', 'solicitudes.id', 'gestion.id', 'gestion.solicitud_id', 'gestion.convenio_id', 'convenio.nombre', 'estatus1.nombre', 'estatus2.nombre', 'gestion.estatus3_id', 'gestion.tipodecontacto_id', 'tipodecontacto.nombre', 'gestion.militar_solicitante',
                'gestion.rango_solicitante_id', 'gestion.militar_beneficiario', 'gestion.rango_beneficiario_id',
                'gestion.afrodescendiente', 'gestion.indigena', 'gestion.sexodiversidad', 'gestion.trabajador_id',
                'cisolicitante', 'cibeneficiario',
                'beneficiario', 'nino', 'solicitante', 'trabajadorsocial', 'solicitudes.usuario_asignacion_id', 'especialidad', 'solicitudes.area_id', 'solicitudes.recepcion_id', 'recepcion', 'trabajadoracargoactividad', 'estado_actividad', 'tipodeayuda', 'estatussa', 'solicitudes.estatus',
                'proceso', 'solicitudes.descripcion', 'diasdeultimamodificacion', 'diasdesolicitud', 'diasdesdeactividad',
                'anodelasolicitud', 'direccion', 'fechaactividad', 'fechaingreso', 'estadodireccion', 'fechaultimamodificacion', 'gestion.instruccion_id', 'telefono', 'edadbeneficiario']);


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
                        'asc' => ['gestion.estatus3_id' => \SORT_ASC],
                        'desc' => ['gestion.estatus3_id' => \SORT_DESC],
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
                    'persona_solicitante_id' => [
                        'asc' => ['solicitudes.persona_solicitante_id' => \SORT_ASC],
                        'desc' => ['solicitudes.persona_solicitante_id' => \SORT_DESC],
                    ],
                    'persona_beneficiario_id' => [
                        'asc' => ['solicitudes.persona_beneficiario_id' => \SORT_ASC],
                        'desc' => ['solicitudes.persona_beneficiario_id' => \SORT_DESC],
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
                        'asc' => ['monto' => \SORT_ASC],
                        'desc' => ['monto' => \SORT_DESC],
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
                        'asc' => ['solicitudes.descripcion' => \SORT_ASC],
                        'desc' => ['solicitudes.descripcion' => \SORT_DESC],
                    ],
                    'diasdeultimamodificacion' => [
                        'asc' => ['diasdeultimamodificacion' => \SORT_ASC],
                        'desc' => ['diasdeultimamodificacion' => \SORT_DESC],
                    ],
                    'diasdesolicitud' => [
                        'asc' => ['diasdesolicitud' => \SORT_ASC],
                        'desc' => ['diasdesolicitud' => \SORT_DESC],
                    ],
                    'diasdesdeactividad' => [
                        'asc' => ['diasdesdeactividad' => \SORT_ASC],
                        'desc' => ['diasdesdeactividad' => \SORT_DESC],
                    ],
                    'cheque' => [
                        'asc' => ['presupuestos.cheque' => \SORT_ASC],
                        'desc' => ['presupuestos.cheque' => \SORT_DESC],
                    ],
                    'anodelasolicitud' => [
                        'asc' => ['anodelasolicitud' => \SORT_ASC],
                        'desc' => ['anodelasolicitud' => \SORT_DESC],
                    ],
                    'direccion' => [
                        'asc' => ['direccion' => \SORT_ASC],
                        'desc' => ['direccion' => \SORT_DESC],
                    ],
                    'fechaactividad' => [
                        'asc' => ['fechaactividad' => \SORT_ASC],
                        'desc' => ['fechaactividad' => \SORT_DESC],
                    ],
                    'fechaingreso' => [
                        'asc' => ['fechaingreso' => \SORT_ASC],
                        'desc' => ['fechaingreso' => \SORT_DESC],
                    ],
                    'estadodireccion' => [
                        'asc' => ['estadodireccion' => \SORT_ASC],
                        'desc' => ['estadodireccion' => \SORT_DESC],
                    ],
                    'fechaultimamodificacion' => [
                        'asc' => ['fechaultimamodificacion' => \SORT_ASC],
                        'desc' => ['fechaultimamodificacion' => \SORT_DESC],
                    ],
                    'edadbeneficiario' => [
                        'asc' => ['edadbeneficiario' => \SORT_ASC],
                        'desc' => ['edadbeneficiario' => \SORT_DESC],
                    ],
                    'instruccion_id' => [
                        'asc' => ['gestion.instruccion_id' => \SORT_ASC],
                        'desc' => ['gestion.instruccion_id' => \SORT_DESC],
                    ],
                    'telefono' => [
                        'asc' => ['telefono' => \SORT_ASC],
                        'desc' => ['telefono' => \SORT_DESC],
                    ],
                    'fechaaprobacion' => [
                        'asc' => ['solicitudes.fecha_aprobacion' => \SORT_ASC],
                        'desc' => ['solicitudes.fecha_aprobacion' => \SORT_DESC],
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
            'gestion.instruccion_id' => $this->instruccion_id,
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
            ->andFilterWhere(['ilike', 'estatus1.nombre', $this->estatus1_id])
            ->andFilterWhere(['ilike', "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido)", $this->beneficiario])
            ->andFilterWhere(['ilike', "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido)", $this->solicitante])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personasolicitante.ci, '99999999'))", $this->cisolicitante])
            ->andFilterWhere(['=', 'extract(month from programaevento.fechaprograma)', $this->mes_actividad])
            ->andFilterWhere(['=', 'extract(month from solicitudes.created_at)', $this->mesingreso])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '99999999'))", $this->cibeneficiario])
            ->andFilterWhere(['like', 'solicitudes.num_solicitud', $this->solicitud_id])
            ->andFilterWhere(['ilike', 'requerimientos.nombre', $this->tratamiento])
            ->andFilterWhere(['ilike', 'users.nombre', $this->trabajadorsocial])
            ->andFilterWhere(['ilike', 'areas.nombre', $this->especialidad])
            ->andFilterWhere(['ilike', 'recepciones.nombre', $this->recepcion])
            ->andFilterWhere(['ilike', 'solicitudes.necesidad', $this->necesidad])
            ->andFilterWhere(['ilike', 'estadoactividad.nombre', $this->estado_actividad])
            ->andFilterWhere(['ilike', 'estadobeneficiario.nombre', $this->estadodireccion])
            ->andFilterWhere(['ilike', 'tipo_ayudas.nombre', $this->tipodeayuda])
            ->andFilterWhere(['like', 'estatussasyc.estatus', $this->estatussa])
            ->andFilterWhere(['ilike', 'empresa_institucion.nombrecompleto', $this->empresaoinstitucion])
            ->andFilterWhere(['ilike', 'procesos.nombre', $this->proceso])
            ->andFilterWhere(['like', 'presupuestos.cheque', $this->cheque])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(extract(year from solicitudes.created_at),'9999'))", $this->anodelasolicitud])
            ->andFilterWhere(['ilike', 'solicitudes.descripcion', $this->descripcion])
            ->andFilterWhere(['=', "date_part('day' ,now()-gestion.updated_at)", $this->diasdeultimamodificacion])
            ->andFilterWhere(['=', "date_part('day' ,now()-solicitudes.created_at)", $this->diasdesolicitud])
            ->andFilterWhere(['=', "date_part('day' ,now()-programaevento.fechaprograma)", $this->diasdesdeactividad])
            ->andFilterWhere(['=', "date_part('year' ,now()-personabeneficiario.fecha_nacimiento)", $this->edadbeneficiario])
            ->andFilterWhere(['like', "to_char(programaevento.fechaprograma, 'DD/MM/YYYY')", $this->fechaactividad])
            ->andFilterWhere(['like', "to_char(solicitudes.created_at, 'DD/MM/YYYY')", $this->fechaingreso])
            ->andFilterWhere(['like', "to_char(solicitudes.fecha_aprobacion, 'DD/MM/YYYY')", $this->fechaaprobacion])
            ->andFilterWhere(['like', "to_char(gestion.updated_at, 'DD/MM/YYYY')", $this->fechaultimamodificacion])
            ->andFilterWhere(['ilike', "CONCAT(trabajadoracargo.dimprofesion || ' ' || trabajadoracargo.primernombre || ' ' || trabajadoracargo.primerapellido)", $this->trabajadoracargoactividad])
            ->andFilterWhere(['ilike', "CONCAT(estadobeneficiario.nombre || ' ' || municipiobeneficiario.nombre || ' ' || parroquiabeneficiario.nombre || ' ' || personabeneficiario.zona_sector || ' ' || personabeneficiario.calle_avenida || ' ' || personabeneficiario.apto_casa)", $this->direccion])
            ->andFilterWhere(['like', "CONCAT(personabeneficiario.telefono_fijo || ' / ' || personabeneficiario.telefono_celular || ' / ' || personabeneficiario.telefono_otro)", $this->telefono]);

        return $dataProvider;
    }

}
