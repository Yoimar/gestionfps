<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Memos;

/**
 * MemosSearch represents the model behind the search form about `app\models\Memos`.
 */
class MemosSearch extends Memos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'origen_id', 'destino_id', 'usuario_id', 'version'], 'integer'],
            [['fecha', 'numero', 'asunto', 'created_at', 'updated_at'], 'safe'],
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
        $query = Memos::find();

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
            'fecha' => $this->fecha,
            'origen_id' => $this->origen_id,
            'destino_id' => $this->destino_id,
            'usuario_id' => $this->usuario_id,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'asunto', $this->asunto]);

        return $dataProvider;
    }
}
