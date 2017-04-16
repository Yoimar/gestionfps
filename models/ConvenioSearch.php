<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Convenio;

/**
 * ConvenioSearch represents the model behind the search form about `app\models\Convenio`.
 */
class ConvenioSearch extends Convenio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipoconvenio_id', 'version', 'created_by', 'updated_by'], 'integer'],
            [['nombre', 'dimnombre', 'created_at', 'updated_at'], 'safe'],
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
        $query = Convenio::find();

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
            'tipoconvenio_id' => $this->tipoconvenio_id,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'dimnombre', $this->dimnombre]);

        return $dataProvider;
    }
}
