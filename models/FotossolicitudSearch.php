<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fotossolicitud;

/**
 * FotossolicitudSearch represents the model behind the search form of `app\models\Fotossolicitud`.
 */
class FotossolicitudSearch extends Fotossolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'solicitud_id'], 'integer'],
            [['descripcion', 'foto', 'created_at', 'updated_at'], 'safe'],
            [['ind_reporte'], 'boolean'],
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
        $query = Fotossolicitud::find();

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
            'ind_reporte' => $this->ind_reporte,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'foto', $this->foto]);

        return $dataProvider;
    }
}
