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
            'recepcionactual', 'telefono', 'orpa', 'num_solicitud'], 'safe'],
            [['id_presupuesto', 'cheque_by', 'entregado_by', 'retirado_personaid', 'responsable_by',
            'imagenentrega_id', 'anulado_by', 'cientregadoa', 'archivo_by', 'created_by', 'updated_by', 'cibeneficiario', 'cisolicitante', 'anocheque', 'mescheque', 'monto', 'rif',
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
            "CONCAT(COALESCE(empresa_institucion.rif || '-', '') || empresa_institucion.nrif) as rif"
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
                ->join('LEFT JOIN', 'departamentos', 'recepciones.departamentos_id = departamentos.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_presupuesto' => $this->id_presupuesto,
            'date_cheque' => $this->date_cheque,
            'cheque_by' => $this->cheque_by,
            'date_enviofirma' => $this->date_enviofirma,
            'date_enviocaja' => $this->date_enviocaja,
            'date_reccaja' => $this->date_reccaja,
            'date_entregado' => $this->date_entregado,
            'entregado_by' => $this->entregado_by,
            'retirado_personaid' => $this->retirado_personaid,
            'responsable_by' => $this->responsable_by,
            'imagenentrega_id' => $this->imagenentrega_id,
            'date_anulado' => $this->date_anulado,
            'anulado_by' => $this->anulado_by,
            'date_archivo' => $this->date_archivo,
            'archivo_by' => $this->archivo_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['ilike', 'cheque', $this->cheque])
            ->andFilterWhere(['ilike', 'estatus_cheque', $this->estatus_cheque])
            ->andFilterWhere(['ilike', 'motivo_anulado', $this->motivo_anulado]);

        return $dataProvider;
    }
}
