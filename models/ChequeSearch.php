<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cheque;

/**
 * ChequeSearch represents the model behind the search form of `app\models\Cheque`.
 */
class ChequeSearch extends Cheque
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cheque', 'estatus_cheque', 'date_cheque', 'date_enviofirma', 'date_enviocaja', 'date_reccaja', 'date_entregado', 'date_anulado', 'motivo_anulado', 'date_archivo', 'created_at', 'updated_at'], 'safe'],
            [['id_presupuesto', 'cheque_by', 'entregado_by', 'retirado_personaid', 'responsable_by', 'imagenentrega_id', 'anulado_by', 'archivo_by', 'created_by', 'updated_by'], 'integer'],
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
        $query = Cheque::find();

        // add conditions that should always apply here

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
