<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trabajador;

/**
 * TrabajadorSearch represents the model behind the search form about `app\models\Trabajador`.
 */
class TrabajadorSearch extends Trabajador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'users_id', 'ci', 'created_by', 'updated_by'], 'integer'],
            [['primernombre', 'segundonombre', 'primerapellido', 'segundoapellido', 'telfextension', 'telfpersonal', 'telfpersonal2', 'telfcasa', 'dimprofesion', 'profesion', 'created_at', 'updated_at'], 'safe'],
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
        $query = Trabajador::find();

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
            'user_id' => $this->user_id,
            'users_id' => $this->users_id,
            'ci' => $this->ci,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'primernombre', $this->primernombre])
            ->andFilterWhere(['like', 'segundonombre', $this->segundonombre])
            ->andFilterWhere(['like', 'primerapellido', $this->primerapellido])
            ->andFilterWhere(['like', 'segundoapellido', $this->segundoapellido])
            ->andFilterWhere(['like', 'telfextension', $this->telfextension])
            ->andFilterWhere(['like', 'telfpersonal', $this->telfpersonal])
            ->andFilterWhere(['like', 'telfpersonal2', $this->telfpersonal2])
            ->andFilterWhere(['like', 'telfcasa', $this->telfcasa])
            ->andFilterWhere(['like', 'dimprofesion', $this->dimprofesion])
            ->andFilterWhere(['like', 'profesion', $this->profesion]);

        return $dataProvider;
    }
}
