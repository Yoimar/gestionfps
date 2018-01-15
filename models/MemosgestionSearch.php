<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Memosgestion;

/**
 * MemosgestionSearch represents the model behind the search form about `app\models\Memosgestion`.
 */
class MemosgestionSearch extends Memosgestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dirorigen', 'unidadorigen', 'trabajadororigen', 'estatus1origen', 'estatus2origen', 'estatus3origen', 'dirfinal', 'unidadfinal', 'trabajadorfinal', 'estatus1final', 'estatus2final', 'estatus3final', 'created_by', 'updated_by'], 'integer'],
            [['fechamemo', 'asunto', 'created_at', 'updated_at'], 'safe'],
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
        $query = Memosgestion::find()
                ->select(['id', 
                    'dirorigen', 
                    'unidadorigen', 
                    'trabajadororigen', 
                    'estatus1origen', 
                    'estatus2origen', 
                    'estatus3origen', 
                    'dirfinal', 
                    'unidadfinal', 
                    'trabajadorfinal', 
                    'estatus1final', 
                    'estatus2final', 
                    'estatus3final', 
                    'created_by', 
                    'updated_by',
                    "to_char(fechamemo, 'DD/MM/YYYY') as fechamemo",
                    'asunto', 
                    'created_at', 
                    'updated_at'
                    ]);

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
            'dirorigen' => $this->dirorigen,
            'unidadorigen' => $this->unidadorigen,
            'trabajadororigen' => $this->trabajadororigen,
            'estatus1origen' => $this->estatus1origen,
            'estatus2origen' => $this->estatus2origen,
            'estatus3origen' => $this->estatus3origen,
            'dirfinal' => $this->dirfinal,
            'unidadfinal' => $this->unidadfinal,
            'trabajadorfinal' => $this->trabajadorfinal,
            'estatus1final' => $this->estatus1final,
            'estatus2final' => $this->estatus2final,
            'estatus3final' => $this->estatus3final,
//            'fechamemo' => $this->fechamemo,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'asunto', $this->asunto])
               ->andFilterWhere(['like', "to_char(fechamemo, 'DD/MM/YYYY')", $this->fechamemo]);

        return $dataProvider;
    }
}
