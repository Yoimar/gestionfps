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
            [['id', 'origenid', 'nprograma', 'trabajadoracargo_id', 'referencia_id', 'parroquia_id', 'created_by', 'updated_by'], 'integer'],
            [['fechaprograma', 'descripcion', 'fecharecibido', 'dateprograma', 'created_at', 'updated_at'], 'safe'],
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
        $query = Programaevento::find()
        ->select([
            'id',
            'origenid',
            'nprograma',
            'trabajadoracargo_id',
            'referencia_id',
            'parroquia_id',
            'created_by',
            'updated_by',
            'fechaprograma',
            'descripcion',
            'fecharecibido',
            "fechaprograma as dateprograma",
            'created_at',
            'updated_at',

        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'fechaprograma' => SORT_DESC,
                ],
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => \SORT_ASC],
                        'desc' => ['id' => \SORT_DESC],
                    ],
                    'origenid' => [
                        'asc' => ['origenid' => \SORT_ASC],
                        'desc' => ['origenid' => \SORT_DESC],
                    ],
                    'nprograma' => [
                        'asc' => ['nprograma' => \SORT_ASC],
                        'desc' => ['nprograma' => \SORT_DESC],
                    ],
                    'trabajadoracargo_id' => [
                        'asc' => ['trabajadoracargo_id' => \SORT_ASC],
                        'desc' => ['trabajadoracargo_id' => \SORT_DESC],
                    ],
                    'referencia_id' => [
                        'asc' => ['referencia_id' => \SORT_ASC],
                        'desc' => ['referencia_id' => \SORT_DESC],
                    ],
                    'parroquia_id' => [
                        'asc' => ['parroquia_id' => \SORT_ASC],
                        'desc' => ['parroquia_id' => \SORT_DESC],
                    ],
                    'fechaprograma' => [
                        'asc' => ['fechaprograma' => \SORT_ASC],
                        'desc' => ['fechaprograma' => \SORT_DESC],
                    ],
                    'dateprograma' => [
                        'asc' => ['fechaprograma' => \SORT_ASC],
                        'desc' => ['fechaprograma' => \SORT_DESC],
                    ],
                    'descripcion' => [
                        'asc' => ['descripcion' => \SORT_ASC],
                        'desc' => ['descripcion' => \SORT_DESC],
                    ],
                    'created_at' => [
                        'asc' => ['cheque.created_at' => \SORT_ASC],
                        'desc' => ['cheque.created_at' => \SORT_DESC],
                    ],
                    'created_by' => [
                        'asc' => ['cheque.created_by' => \SORT_ASC],
                        'desc' => ['cheque.created_by' => \SORT_DESC],
                    ],
                    'updated_at' => [
                        'asc' => ['cheque.updated_at' => \SORT_ASC],
                        'desc' => ['cheque.updated_at' => \SORT_DESC],
                    ],
                    'updated_by' => [
                        'asc' => ['cheque.updated_by' => \SORT_ASC],
                        'desc' => ['cheque.updated_by' => \SORT_DESC],
                    ],
                ],
            ],

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
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);
        $query->andFilterWhere(["=", "date(fechaprograma)", $this->dateprograma]);

        return $dataProvider;
    }
}
