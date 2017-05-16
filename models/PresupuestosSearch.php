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
            [['id', 'solicitud_id', 'requerimiento_id', 'proceso_id', 'documento_id', 'beneficiario_id', 'cantidad', 'version', 'numop'], 'integer'],
            [['moneda', 'estatus_doc', 'cheque', 'created_at', 'updated_at'], 'safe'],
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
        $query = Presupuestos::find();

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
            'id' => $this->id,
            'solicitud_id' => $this->solicitud_id,
            'requerimiento_id' => $this->requerimiento_id,
            'proceso_id' => $this->proceso_id,
            'documento_id' => $this->documento_id,
            'beneficiario_id' => $this->beneficiario_id,
            'cantidad' => $this->cantidad,
            'monto' => $this->monto,
            'montoapr' => $this->montoapr,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'numop' => $this->numop,
        ]);

        $query->andFilterWhere(['like', 'moneda', $this->moneda])
            ->andFilterWhere(['like', 'estatus_doc', $this->estatus_doc])
            ->andFilterWhere(['like', 'cheque', $this->cheque]);

        return $dataProvider;
    }
}
