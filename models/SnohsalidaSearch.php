<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Snohsalida;

/**
 * SnohsalidaSearch represents the model behind the search form of `app\models\Snohsalida`.
 */
class SnohsalidaSearch extends Snohsalida
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codemp', 'codnom', 'codper', 'anocur', 'codperi', 'codconc', 'tipsal'], 'safe'],
            [['valsal', 'monacusal', 'salsal', 'priquisal', 'segquisal'], 'number'],
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
        $query = Snohsalida::find();

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
            'valsal' => $this->valsal,
            'monacusal' => $this->monacusal,
            'salsal' => $this->salsal,
            'priquisal' => $this->priquisal,
            'segquisal' => $this->segquisal,
        ]);

        $query->andFilterWhere(['ilike', 'codemp', $this->codemp])
            ->andFilterWhere(['ilike', 'codnom', $this->codnom])
            ->andFilterWhere(['ilike', 'codper', $this->codper])
            ->andFilterWhere(['ilike', 'anocur', $this->anocur])
            ->andFilterWhere(['ilike', 'codperi', $this->codperi])
            ->andFilterWhere(['ilike', 'codconc', $this->codconc])
            ->andFilterWhere(['ilike', 'tipsal', $this->tipsal]);

        return $dataProvider;
    }
}
