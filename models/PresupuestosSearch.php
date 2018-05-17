<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presupuestos;

/**
 * PresupuestosSearch represents the model behind the search form about `app\models\Presupuestos`.
 */
class PresupuestosSearch extends Presupuestos
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'solicitud_id', 'requerimiento_id', 'proceso_id', 'documento', 'documento_id', 'beneficiario_id', 'cantidad', 'version', 'numop'], 'integer'],
            [['moneda', 'estatus_doc', 'cheque', 'num_solicitud', 'estatus1_id',
            'estatus2_id', 'estatus3_id', 'created_at', 'updated_at', 'tratamiento',
            'nombre', 'rif', 'empresaoinstitucion', 'estatussa', 'cibeneficiario', 'beneficiario',
            'cisolicitante', 'solicitante', 'proceso', ], 'safe'],
            [['monto', 'montoapr'], 'number'],
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
        $query = Presupuestos::find()
        ->select([
        'presupuestos.id as id',
        "extract(month from programaevento.fechaprograma)::int as mes_actividad",
        "conexionsigesp.req as documento",
        'programaevento.descripcion',
        'solicitudes.num_solicitud as num_solicitud',
        'gestion.programaevento_id',
        'programaevento.id',
        'presupuestos.numop',
        'presupuestos.montoapr as montoapr',
        'presupuestos.monto as monto',
        "CONCAT(empresa_institucion.rif || '-' || empresa_institucion.nrif) as rif",
        'solicitudes.id as solicitud_id',
        'gestion.solicitud_id',
        'gestion.convenio_id',
        'convenio.nombre',
        "estatus1.nombre as estatus1_id",
        "estatus2.nombre as estatus2_id",
        'estatus3.nombre as estatus3_id',
        'gestion.tipodecontacto_id',
        'tipodecontacto.nombre',
        'gestion.militar_solicitante',
        'gestion.rango_solicitante_id',
        'gestion.militar_beneficiario',
        'gestion.rango_beneficiario_id',
        'gestion.afrodescendiente',
        'gestion.indigena',
        'gestion.sexodiversidad',
        'gestion.trabajador_id',
        "personasolicitante.ci as cisolicitante",
        "personabeneficiario.ci as cibeneficiario",
        "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) AS beneficiario",
        'solicitudes.ind_beneficiario_menor as nino',
        "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido) AS solicitante",
        'requerimientos.nombre as tratamiento',
        'presupuestos.proceso_id',
        'users.nombre as trabajadorsocial',
        'solicitudes.usuario_asignacion_id',
        'areas.nombre as especialidad',
        'solicitudes.area_id',
        'solicitudes.recepcion_id',
        'recepciones.nombre as recepcion',
        "CONCAT(trabajadoracargo.dimprofesion || ' ' || trabajadoracargo.primernombre || ' ' || trabajadoracargo.primerapellido) AS trabajadoracargoactividad",
        "extract(month from solicitudes.created_at)::int as mesingreso",
        'estadoactividad.nombre as estado_actividad',
        'tipo_ayudas.nombre as tipodeayuda',
        'estatussasyc.estatus as estatussa',
        'solicitudes.estatus',
        'empresa_institucion.nombrecompleto as empresaoinstitucion',
        'presupuestos.beneficiario_id',
        'procesos.nombre as proceso',
        'presupuestos.cantidad as cantidad',
        'solicitudes.descripcion',
        "date_part('day' ,now()-gestion.updated_at) as diasdeultimamodificacion",
        "date_part('day' ,now()-solicitudes.created_at) as diasdesolicitud",
        "date_part('day' ,now()-programaevento.fechaprograma) as diasdesdeactividad",
        'presupuestos.cheque as cheque',
        "extract(year from solicitudes.created_at) as anodelasolicitud",
        "CONCAT(personabeneficiario.zona_sector || ' ' || personabeneficiario.calle_avenida || ' ' || personabeneficiario.apto_casa) as direccion",
        "to_char(programaevento.fechaprograma, 'DD/MM/YYYY') as fechaactividad",
        "to_char(solicitudes.created_at, 'DD/MM/YYYY') as fechaingreso",
        'estadobeneficiario.nombre as estadodireccion',
        "TO_CHAR(gestion.updated_at, 'DD/MM/YYYY') as fechaultimamodificacion",
        "extract(YEAR FROM age(now(), personabeneficiario.fecha_nacimiento)) as edadbeneficiario",
        "CONCAT(trabajador.dimprofesion || ' ' ||trabajador.primernombre || ' ' || trabajador.primerapellido) AS trabajadorgestion"]);

        // add conditions that should always apply here

        $query->join('LEFT JOIN', 'solicitudes', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'gestion', 'solicitudes.id = gestion.solicitud_id')
                ->join('LEFT JOIN', 'trabajador', 'gestion.trabajador_id = trabajador.id')
                ->join('LEFT JOIN', 'convenio', 'gestion.convenio_id = convenio.id')
                ->join('LEFT JOIN', 'programaevento', 'gestion.programaevento_id = programaevento.id')
                ->join('LEFT JOIN', 'tipodecontacto', 'gestion.tipodecontacto_id = tipodecontacto.id')
                ->join('LEFT JOIN', 'users', 'solicitudes.usuario_asignacion_id = users.id')
                ->join('LEFT JOIN', 'estatussasyc', 'solicitudes.estatus = estatussasyc.id')
                ->join('LEFT JOIN', 'recepciones', 'solicitudes.recepcion_id = recepciones.id')
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
                ->join('LEFT JOIN', 'estados as estadoactividad', 'municipioactividad.estado_id = estadoactividad.id')
                ->join('LEFT JOIN', 'parroquias as parroquiabeneficiario', 'personabeneficiario.parroquia_id = parroquiabeneficiario.id')
                ->join('LEFT JOIN', 'municipios as municipiobeneficiario', 'parroquiabeneficiario.municipio_id = municipiobeneficiario.id')
                ->join('LEFT JOIN', 'estados as estadobeneficiario', 'municipiobeneficiario.estado_id = estadobeneficiario.id')
                ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'num_solicitud' => SORT_DESC,
                ],
                'attributes' => [
                    'num_solicitud' => [
                        'asc' => ['num_solicitud' => \SORT_ASC],
                        'desc' => ['num_solicitud' => \SORT_DESC],
                    ],
                    'estatussa' => [
                        'asc' => ['estatussa' => \SORT_ASC],
                        'desc' => ['estatussa' => \SORT_DESC],
                    ],
                    'estatus1_id' => [
                        'asc' => ['estatus1_id' => \SORT_ASC],
                        'desc' => ['estatus1_id' => \SORT_DESC],
                    ],
                    'estatus2_id' => [
                        'asc' => ['estatus2_id' => \SORT_ASC],
                        'desc' => ['estatus2_id' => \SORT_DESC],
                    ],
                    'estatus3_id' => [
                        'asc' => ['estatus3_id' => \SORT_ASC],
                        'desc' => ['estatus3_id' => \SORT_DESC],
                    ],
                    'beneficiario' => [
                        'asc' => ['beneficiario' => \SORT_ASC],
                        'desc' => ['beneficiario' => \SORT_DESC],
                    ],
                    'cibeneficiario' => [
                        'asc' => ['cibeneficiario' => \SORT_ASC],
                        'desc' => ['cibeneficiario' => \SORT_DESC],
                    ],
                    'cisolicitante' => [
                        'asc' => ['cisolicitante' => \SORT_ASC],
                        'desc' => ['cisolicitante' => \SORT_DESC],
                    ],
                    'solicitante' => [
                        'asc' => ['solicitante' => \SORT_ASC],
                        'desc' => ['solicitante' => \SORT_DESC],
                    ],
                    'documento' => [
                        'asc' => ['documento' => \SORT_ASC],
                        'desc' => ['documento' => \SORT_DESC],
                    ],
                    'rif' => [
                        'asc' => ['rif' => \SORT_ASC],
                        'desc' => ['rif' => \SORT_DESC],
                    ],
                    'numop' => [
                        'asc' => ['numop' => \SORT_ASC],
                        'desc' => ['numop' => \SORT_DESC],
                    ],
                    'monto' => [
                        'asc' => ['presupuestos.monto' => \SORT_ASC],
                        'desc' => ['presupuestos.monto' => \SORT_DESC],
                    ],
                    'montoapr' => [
                        'asc' => ['presupuestos.montoapr' => \SORT_ASC],
                        'desc' => ['presupuestos.montoapr' => \SORT_DESC],
                    ],
                    'tratamiento' => [
                        'asc' => ['requerimientos.nombre' => \SORT_ASC],
                        'desc' => ['requerimientos.nombre' => \SORT_DESC],
                    ],
                    'proceso' => [
                        'asc' => ['procesos.nombre' => \SORT_ASC],
                        'desc' => ['procesos.nombre' => \SORT_DESC],
                    ],
                    'cantidad' => [
                        'asc' => ['presupuestos.cantidad' => \SORT_ASC],
                        'desc' => ['presupuestos.cantidad' => \SORT_DESC],
                    ],
                    'empresaoinstitucion' => [
                        'asc' => ['empresa_institucion.nombrecompleto' => \SORT_ASC],
                        'desc' => ['empresa_institucion.nombrecompleto' => \SORT_DESC],
                    ],
                    'cheque' => [
                        'asc' => ['presupuestos.cheque' => \SORT_ASC],
                        'desc' => ['presupuestos.cheque' => \SORT_DESC],
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
            'presupuestos.id' => $this->id,
            'presupuestos.solicitud_id' => $this->solicitud_id,
            'presupuestos.requerimiento_id' => $this->requerimiento_id,
            'presupuestos.proceso_id' => $this->proceso_id,
            'presupuestos.documento_id' => $this->documento_id,
            'presupuestos.beneficiario_id' => $this->beneficiario_id,
            'presupuestos.cantidad' => $this->cantidad,
            'presupuestos.monto' => $this->monto,
            'presupuestos.montoapr' => $this->montoapr,
            'presupuestos.version' => $this->version,
            'presupuestos.created_at' => $this->created_at,
            'presupuestos.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'moneda', $this->moneda])
            ->andFilterWhere(['ilike', 'estatus_doc', $this->estatus_doc])
            ->andFilterWhere(['ilike', 'estatussasyc.estatus', $this->estatussa])
            ->andFilterWhere(['ilike', 'empresa_institucion.nombrecompleto', $this->empresaoinstitucion])
            ->andFilterWhere(['ilike', 'solicitudes.num_solicitud', $this->num_solicitud])
            ->andFilterWhere(['ilike', 'conexionsigesp.req', $this->documento])
            ->andFilterWhere(['ilike', "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido)", $this->beneficiario])
            ->andFilterWhere(['ilike', "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido)", $this->solicitante])
            ->andFilterWhere(['ilike', "CONCAT(empresa_institucion.rif || '-' || empresa_institucion.nrif)", $this->rif])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '99999999'))", $this->cibeneficiario])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personasolicitante.ci, '99999999'))", $this->cisolicitante])
            ->andFilterWhere(['ilike', "TRIM(TO_CHAR(presupuestos.numop, '99999999'))", $this->numop])
            ->andFilterWhere(['ilike', 'requerimientos.nombre', $this->tratamiento])
            ->andFilterWhere(['ilike', 'procesos.nombre', $this->proceso])
            ->andFilterWhere(['ilike', 'presupuestos.cheque', $this->cheque]);



        return $dataProvider;
    }
}
