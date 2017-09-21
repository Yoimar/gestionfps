<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conexionsigesp;

/**
 * ConexionsigespSearch represents the model behind the search form about `app\models\Conexionsigesp`.
 */
class ConexionsigespSearch extends Conexionsigesp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_presupuesto', 'rif', 'created_by', 'updated_by'], 'integer'],
            [['req', 'codestpre', 'cuenta', 'date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Conexionsigesp::find();

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
            'id_presupuesto' => $this->id_presupuesto,
            'rif' => $this->rif,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'req', $this->req])
            ->andFilterWhere(['like', 'codestpre', $this->codestpre])
            ->andFilterWhere(['like', 'cuenta', $this->cuenta]);

        return $dataProvider;
    }
}
