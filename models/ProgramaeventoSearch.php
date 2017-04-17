<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Programaevento;

/**
 * ProgramaeventoSearch represents the model behind the search form about `app\models\Programaevento`.
 */
class ProgramaeventoSearch extends Programaevento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'origenid', 'nprograma', 'trabajadoracargo_id', 'referencia_id', 'parroquia_id', 'version', 'created_by', 'updated_by'], 'integer'],
            [['fechaprograma', 'descripcion', 'fecharecibido', 'created_at', 'updated_at'], 'safe'],
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
        $query = Programaevento::find();

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
            'origenid' => $this->origenid,
            'nprograma' => $this->nprograma,
            'fechaprograma' => $this->fechaprograma,
            'trabajadoracargo_id' => $this->trabajadoracargo_id,
            'referencia_id' => $this->referencia_id,
            'parroquia_id' => $this->parroquia_id,
            'fecharecibido' => $this->fecharecibido,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
