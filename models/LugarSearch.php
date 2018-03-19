<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lugar;

/**
 * LugarSearch represents the model behind the search form of `app\models\Lugar`.
 */
class LugarSearch extends Lugar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centro_clasificacion_id', 'parroquia_id', 'created_by', 'updated_by'], 'integer'],
            [['nombre', 'nombre_slug', 'direccion', 'telefono1', 'telefono2', 'telefono3', 'notas', 'created_at', 'updated_at'], 'safe'],
            [['lat', 'lng'], 'number'],
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
        $query = Lugar::find();

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
            'centro_clasificacion_id' => $this->centro_clasificacion_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'parroquia_id' => $this->parroquia_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'nombre_slug', $this->nombre_slug])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'telefono1', $this->telefono1])
            ->andFilterWhere(['ilike', 'telefono2', $this->telefono2])
            ->andFilterWhere(['ilike', 'telefono3', $this->telefono3])
            ->andFilterWhere(['ilike', 'notas', $this->notas]);

        return $dataProvider;
    }
}
