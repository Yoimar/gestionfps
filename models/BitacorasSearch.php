<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bitacoras;

/**
 * BitacorasSearch represents the model behind the search form about `app\models\Bitacoras`.
 */
class BitacorasSearch extends Bitacoras
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'solicitud_id', 'usuario_id', 'version'], 'integer'],
            [['fecha', 'nota', 'created_at', 'updated_at'], 'safe'],
            [['ind_activo', 'ind_alarma', 'ind_atendida'], 'boolean'],
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
        $query = Bitacoras::find();

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
            'fecha' => $this->fecha,
            'usuario_id' => $this->usuario_id,
            'ind_activo' => $this->ind_activo,
            'ind_alarma' => $this->ind_alarma,
            'ind_atendida' => $this->ind_atendida,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nota', $this->nota]);

        return $dataProvider;
    }
}
