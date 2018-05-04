<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cheque;

/**
 * ChequeSearch represents the model behind the search form of `app\models\Cheque`.
 */
class ChequeSearchCarga extends Cheque
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cheque', 'estatus_cheque', 'date_cheque', 'date_enviofirma', 'date_enviocaja',
            'date_reccaja', 'date_entregado', 'date_anulado', 'motivo_anulado', 'date_archivo',
            'created_at', 'updated_at', 'beneficiario',  'solicitante', 'entregadoa', 'estado_beneficiario',  'tipodeayuda', 'tratamiento', 'especialidad', 'necesidad',  'empresainstitucion',  'recepcioninicial',
            'recepcionactual', 'telefono', 'orpa', 'num_solicitud', 'chequeforprint'], 'safe'],
            [['id_presupuesto', 'cheque_by', 'entregado_by', 'retirado_personaid', 'responsable_by',
            'imagenentrega_id', 'anulado_by', 'cientregadoa', 'archivo_by', 'created_by', 'updated_by', 'cibeneficiario', 'cisolicitante', 'anocheque', 'mescheque', 'monto', 'rif', 'estatus3', 'estatus2', 'estatus1',
            ], 'integer'],
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
        $query = Cheque::find()
        ->select([
            'cheque.cheque',
            "LTRIM(cheque.cheque, '0') as chequeforprint" ,
            'cheque.id_presupuesto',
            'cheque.date_cheque',
            'cheque.cheque_by',
            'cheque.date_enviofirma',
            'cheque.date_enviocaja',
            'cheque.date_reccaja',
            'cheque.date_entregado',
            'cheque.entregado_by',
            'cheque.retirado_personaid',
            'cheque.responsable_by',
            'cheque.imagenentrega_id',
            'cheque.date_anulado',
            'cheque.anulado_by',
            'cheque.date_archivo',
            'cheque.archivo_by',
            'cheque.created_at',
            'cheque.created_by',
            'cheque.updated_at',
            'cheque.updated_by',
            'cheque.estatus_cheque',
            'cheque.motivo_anulado',
            "CONCAT(COALESCE(empresa_institucion.rif || '-', '') || empresa_institucion.nrif) as rif",
            'solicitudes.num_solicitud',
            'solicitudes.id as solicitud_id',
            "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) as beneficiario",
            "personabeneficiario.ci as cibeneficiario",
            "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido) as solicitante",
            "personasolicitante.ci as cisolicitante",
            "CONCAT(personaretira.nombre || ' ' || personaretira.apellido) as entregadoa",
            "personaretira.ci as cientregadoa",
            'estadobeneficiario.nombre as estado_beneficiario',
            "extract(year from cheque.date_cheque) as anocheque",
            "extract(month from cheque.date_cheque) as mescheque",
            'solicitudes.necesidad as necesidad',
            'solicitudes.descripcion as descripcion',
            'empresa_institucion.nombrecompleto as empresainstitucion',
            'presupuestos.montoapr as monto',
            'tipo_ayudas.nombre as tipodeayuda',
            'requerimientos.nombre as tratamiento',
            'areas.nombre as especialidad',
            'recepciones2.nombre as recepcioninicial',
            'recepciones.nombre as recepcionactual',
            "CONCAT(COALESCE(personabeneficiario.telefono_fijo || ' ', '') || COALESCE(personabeneficiario.telefono_celular || ' ', '') || COALESCE(personabeneficiario.telefono_otro || ' ', '') ) as telefono",
            'presupuestos.numop as orpa',
            "estatus1.nombre as estatus1",
            "estatus2.nombre as estatus2",
            "estatus3.nombre as estatus3",
]);

        // add conditions that should always apply here

        $query->join('LEFT JOIN', 'presupuestos', 'cheque.id_presupuesto = presupuestos.id')
                ->join('LEFT JOIN', 'solicitudes', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'gestion','gestion.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
                ->join('LEFT JOIN', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                ->join('LEFT JOIN', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                ->join('LEFT JOIN', 'personas as personabeneficiario', 'solicitudes.persona_beneficiario_id  = personabeneficiario.id')
                ->join('LEFT JOIN', 'personas as personasolicitante', 'solicitudes.persona_solicitante_id  = personasolicitante.id')
                ->join('LEFT JOIN', 'personas as personaretira', 'cheque.retirado_personaid  = personaretira.id')
                ->join('LEFT JOIN', 'empresa_institucion', 'presupuestos.beneficiario_id = empresa_institucion.id')
                ->join('LEFT JOIN', 'conexionsigesp', 'presupuestos.id = conexionsigesp.id_presupuesto')
                ->join('LEFT JOIN', 'recepciones', 'recepciones.id = gestion.recepcion_id')
                ->join('LEFT JOIN', 'recepciones as recepciones2', 'recepciones2.id = solicitudes.recepcion_id')
                ->join('LEFT JOIN', 'parroquias as parroquiabeneficiario', 'personabeneficiario.parroquia_id = parroquiabeneficiario.id')
                ->join('LEFT JOIN', 'municipios as municipiobeneficiario', 'parroquiabeneficiario.municipio_id = municipiobeneficiario.id')
                ->join('LEFT JOIN', 'estados as estadobeneficiario', 'municipiobeneficiario.estado_id = estadobeneficiario.id')
                ->join('LEFT JOIN', 'areas', 'solicitudes.area_id = areas.id')
                ->join('LEFT JOIN', 'tipo_ayudas', 'areas.tipo_ayuda_id = tipo_ayudas.id')
                ->join('LEFT JOIN', 'requerimientos', 'presupuestos.requerimiento_id = requerimientos.id')
                ->join('LEFT JOIN', 'departamentos', 'recepciones.departamentos_id = departamentos.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'cheque' => SORT_DESC,
                ],
                'attributes' => [
                    'cheque' => [
                        'asc' => ['cheque.cheque' => \SORT_ASC],
                        'desc' => ['cheque.cheque' => \SORT_DESC],
                    ],
                    'id_presupuesto' => [
                        'asc' => ['cheque.id_presupuesto' => \SORT_ASC],
                        'desc' => ['cheque.id_presupuesto' => \SORT_DESC],
                    ],
                    'estatus_cheque' => [
                        'asc' => ['cheque.estatus_cheque' => \SORT_ASC],
                        'desc' => ['cheque.estatus_cheque' => \SORT_DESC],
                    ],
                    'date_cheque' => [
                        'asc' => ['cheque.date_cheque' => \SORT_ASC],
                        'desc' => ['cheque.date_cheque' => \SORT_DESC],
                    ],
                    'cheque_by' => [
                        'asc' => ['cheque.cheque_by' => \SORT_ASC],
                        'desc' => ['cheque.cheque_by' => \SORT_DESC],
                    ],
                    'date_enviofirma' => [
                        'asc' => ['cheque.date_enviofirma' => \SORT_ASC],
                        'desc' => ['cheque.date_enviofirma' => \SORT_DESC],
                    ],
                    'date_enviocaja' => [
                        'asc' => ['cheque.date_enviocaja' => \SORT_ASC],
                        'desc' => ['cheque.date_enviocaja' => \SORT_DESC],
                    ],
                    'date_reccaja' => [
                        'asc' => ['cheque.date_reccaja' => \SORT_ASC],
                        'desc' => ['cheque.date_reccaja' => \SORT_DESC],
                    ],
                    'date_entregado' => [
                        'asc' => ['cheque.date_entregado' => \SORT_ASC],
                        'desc' => ['cheque.date_entregado' => \SORT_DESC],
                    ],
                    'entregado_by' => [
                        'asc' => ['cheque.entregado_by' => \SORT_ASC],
                        'desc' => ['cheque.entregado_by' => \SORT_DESC],
                    ],
                    'retirado_personaid' => [
                        'asc' => ['cheque.retirado_personaid' => \SORT_ASC],
                        'desc' => ['cheque.retirado_personaid' => \SORT_DESC],
                    ],
                    'responsable_by' => [
                        'asc' => ['cheque.responsable_by' => \SORT_ASC],
                        'desc' => ['cheque.responsable_by' => \SORT_DESC],
                    ],
                    'imagenentrega_id' => [
                        'asc' => ['cheque.imagenentrega_id' => \SORT_ASC],
                        'desc' => ['cheque.imagenentrega_id' => \SORT_DESC],
                    ],
                    'date_anulado' => [
                        'asc' => ['cheque.date_anulado' => \SORT_ASC],
                        'desc' => ['cheque.date_anulado' => \SORT_DESC],
                    ],
                    'motivo_anulado' => [
                        'asc' => ['cheque.motivo_anulado' => \SORT_ASC],
                        'desc' => ['cheque.motivo_anulado' => \SORT_DESC],
                    ],
                    'anulado_by' => [
                        'asc' => ['cheque.anulado_by' => \SORT_ASC],
                        'desc' => ['cheque.anulado_by' => \SORT_DESC],
                    ],
                    'date_archivo' => [
                        'asc' => ['cheque.date_archivo' => \SORT_ASC],
                        'desc' => ['cheque.date_archivo' => \SORT_DESC],
                    ],
                    'archivo_by' => [
                        'asc' => ['cheque.archivo_by' => \SORT_ASC],
                        'desc' => ['cheque.archivo_by' => \SORT_DESC],
                    ],
                    'created_at' => [
                        'asc' => ['cheque.created_at' => \SORT_ASC],
                        'desc' => ['cheque.created_at' => \SORT_DESC],
                    ],
                    'created_by' => [
                        'asc' => ['cheque.created_by' => \SORT_ASC],
                        'desc' => ['cheque.created_by' => \SORT_DESC],
                    ],
                    'updated_at' => [
                        'asc' => ['cheque.updated_at' => \SORT_ASC],
                        'desc' => ['cheque.updated_at' => \SORT_DESC],
                    ],
                    'updated_by' => [
                        'asc' => ['cheque.updated_by' => \SORT_ASC],
                        'desc' => ['cheque.updated_by' => \SORT_DESC],
                    ],
                    /************* Variables declaradas *************/
                    'solicitud_id' => [
                        'asc' => ['solicitudes.id' => \SORT_ASC],
                        'desc' => ['solicitudes.id' => \SORT_DESC],
                    ],
                    'num_solicitud' => [
                        'asc' => ['solicitudes.num_solicitud' => \SORT_ASC],
                        'desc' => ['solicitudes.num_solicitud' => \SORT_DESC],
                    ],
                    'beneficiario' => [
                        'asc' => ['beneficiario' => \SORT_ASC],
                        'desc' => ['beneficiario' => \SORT_DESC],
                    ],
                    'cibeneficiario' => [
                        'asc' => ['cibeneficiario' => \SORT_ASC],
                        'desc' => ['cibeneficiario' => \SORT_DESC],
                    ],
                    'solicitante' => [
                        'asc' => ['solicitante' => \SORT_ASC],
                        'desc' => ['solicitante' => \SORT_DESC],
                    ],
                    'cisolicitante' => [
                        'asc' => ['cisolicitante' => \SORT_ASC],
                        'desc' => ['cisolicitante' => \SORT_DESC],
                    ],
                    'entregadoa' => [
                        'asc' => ['entregadoa' => \SORT_ASC],
                        'desc' => ['entregadoa' => \SORT_DESC],
                    ],
                    'cientregadoa' => [
                        'asc' => ['cientregadoa' => \SORT_ASC],
                        'desc' => ['cientregadoa' => \SORT_DESC],
                    ],
                    'estado_beneficiario' => [
                        'asc' => ['estado_beneficiario' => \SORT_ASC],
                        'desc' => ['estado_beneficiario' => \SORT_DESC],
                    ],
                    'anocheque' => [
                        'asc' => ['anocheque' => \SORT_ASC],
                        'desc' => ['anocheque' => \SORT_DESC],
                    ],
                    'mescheque' => [
                        'asc' => ['mescheque' => \SORT_ASC],
                        'desc' => ['mescheque' => \SORT_DESC],
                    ],
                    'necesidad' => [
                        'asc' => ['solicitudes.necesidad' => \SORT_ASC],
                        'desc' => ['solicitudes.necesidad' => \SORT_DESC],
                    ],
                    'descripcion' => [
                        'asc' => ['solicitudes.descripcion' => \SORT_ASC],
                        'desc' => ['solicitudes.descripcion' => \SORT_DESC],
                    ],
                    'rif' => [
                        'asc' => ['rif' => \SORT_ASC],
                        'desc' => ['rif' => \SORT_DESC],
                    ],
                    'empresainstitucion' => [
                        'asc' => ['empresainstitucion' => \SORT_ASC],
                        'desc' => ['empresainstitucion' => \SORT_DESC],
                    ],
                    'monto' => [
                        'asc' => ['monto' => \SORT_ASC],
                        'desc' => ['monto' => \SORT_DESC],
                    ],
                    'tipodeayuda' => [
                        'asc' => ['tipodeayuda' => \SORT_ASC],
                        'desc' => ['tipodeayuda' => \SORT_DESC],
                    ],
                    'tratamiento' => [
                        'asc' => ['tratamiento' => \SORT_ASC],
                        'desc' => ['tratamiento' => \SORT_DESC],
                    ],
                    'especialidad' => [
                        'asc' => ['areas.nombre' => \SORT_ASC],
                        'desc' => ['areas.nombre' => \SORT_DESC],
                    ],
                    'recepcioninicial' => [
                        'asc' => ['recepciones2.nombre' => \SORT_ASC],
                        'desc' => ['recepciones2.nombre' => \SORT_DESC],
                    ],
                    'recepcionactual' => [
                        'asc' => ['recepciones.nombre' => \SORT_ASC],
                        'desc' => ['recepciones.nombre' => \SORT_DESC],
                    ],
                    'telefono' => [
                        'asc' => ['telefono' => \SORT_ASC],
                        'desc' => ['telefono' => \SORT_DESC],
                    ],
                    'orpa' => [
                        'asc' => ['orpa' => \SORT_ASC],
                        'desc' => ['orpa' => \SORT_DESC],
                    ],
                    'estatus1' => [
                        'asc' => ['estatus1.nombre' => \SORT_ASC],
                        'desc' => ['estatus1.nombre' => \SORT_DESC],
                    ],
                    'estatus2' => [
                        'asc' => ['estatus2.nombre' => \SORT_ASC],
                        'desc' => ['estatus2.nombre' => \SORT_DESC],
                    ],
                    'estatus3' => [
                        'asc' => ['estatus3.nombre' => \SORT_ASC],
                        'desc' => ['estatus3.nombre' => \SORT_DESC],
                    ],
                    'chequeforprint' => [
                        'asc' => ['cheque.cheque' => \SORT_ASC],
                        'desc' => ['cheque.cheque' => \SORT_DESC],
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
            'cheque.id_presupuesto' => $this->id_presupuesto,
            'cheque.date_cheque' => $this->date_cheque,
            'cheque.cheque_by' => $this->cheque_by,
            'cheque.date_enviofirma' => $this->date_enviofirma,
            'cheque.date_enviocaja' => $this->date_enviocaja,
            'cheque.date_reccaja' => $this->date_reccaja,
            'cheque.date_entregado' => $this->date_entregado,
            'cheque.entregado_by' => $this->entregado_by,
            'cheque.retirado_personaid' => $this->retirado_personaid,
            'cheque.responsable_by' => $this->responsable_by,
            'cheque.imagenentrega_id' => $this->imagenentrega_id,
            'cheque.date_anulado' => $this->date_anulado,
            'cheque.anulado_by' => $this->anulado_by,
            'cheque.date_archivo' => $this->date_archivo,
            'cheque.archivo_by' => $this->archivo_by,
            'cheque.created_at' => $this->created_at,
            'cheque.created_by' => $this->created_by,
            'cheque.updated_at' => $this->updated_at,
            'cheque.updated_by' => $this->updated_by,
            'estatus3_id' => $this->estatus3_id,
            'estatus2_id' => $this->estatus2_id,
            'estatus1_id' => $this->estatus1_id,
        ]);

        $query->andFilterWhere(['ilike', 'cheque.cheque', $this->cheque])
            ->andFilterWhere(['ilike', 'estatus_cheque', $this->estatus_cheque])
            ->andFilterWhere(['ilike', 'motivo_anulado', $this->motivo_anulado])
            ->andFilterWhere(['ilike', "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido)", $this->beneficiario])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '99999999'))", $this->cibeneficiario])
            ->andFilterWhere(['ilike', "CONCAT(personasolicitante.nombre || ' ' || personasolicitante.apellido)", $this->solicitante])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personasolicitante.ci, '99999999'))", $this->cisolicitante])
            ->andFilterWhere(['ilike', "CONCAT(personaretira.nombre || ' ' || personaretira.apellido)", $this->entregadoa])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personaretira.ci, '99999999'))", $this->cientregadoa])
            ->andFilterWhere(['=', 'extract(month from cheque.date_cheque)', $this->mescheque])
            ->andFilterWhere(['=', 'extract(year from cheque.date_cheque)', $this->anocheque])
            ->andFilterWhere(['like', 'solicitudes.id', $this->solicitud_id])
            ->andFilterWhere(['like', 'solicitudes.num_solicitud', $this->num_solicitud])
            ->andFilterWhere(['ilike', 'solicitudes.necesidad', $this->necesidad])
            ->andFilterWhere(['ilike', 'solicitudes.descripcion', $this->descripcion])
            ->andFilterWhere(['like', "CONCAT(empresa_institucion.rif || ' ' || empresa_institucion.nrif)", $this->rif])
            ->andFilterWhere(['like', "empresa_institucion.nombrecompleto", $this->empresainstitucion])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(presupuestos.monto, '9999999999999'))", $this->monto])
            ->andFilterWhere(['ilike', 'tipo_ayudas.nombre', $this->tipodeayuda])
            ->andFilterWhere(['ilike', 'requerimientos.nombre', $this->tratamiento])
            ->andFilterWhere(['ilike', 'areas.nombre', $this->especialidad])
            ->andFilterWhere(['ilike', 'recepciones2.nombre', $this->recepcioninicial])
            ->andFilterWhere(['ilike', 'recepciones.nombre', $this->recepcionactual])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(presupuestos.numop, '999999999'))", $this->orpa])
            ->andFilterWhere(['like', "CONCAT(personabeneficiario.telefono_fijo || ' ' || personabeneficiario.telefono_celular || ' ' || personabeneficiario.telefono_otro)", $this->telefono]);

        return $dataProvider;
    }
}
