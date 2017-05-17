<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Procesos;

/**
 * ProcesosSearch represents the model behind the search form about `app\models\Procesos`.
 */
class ProcesosSearch extends Procesos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'defeventosasyc_id', 'version'], 'integer'],
            [['nombre', 'created_at', 'updated_at'], 'safe'],
            [['ind_cantidad', 'ind_monto', 'ind_beneficiario'], 'boolean'],
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
        $query = Procesos::find();

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
            'defeventosasyc_id' => $this->defeventosasyc_id,
            'ind_cantidad' => $this->ind_cantidad,
            'ind_monto' => $this->ind_monto,
            'ind_beneficiario' => $this->ind_beneficiario,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
