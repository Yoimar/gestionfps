<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rpcbeneficiario;

/**
 * RpcbeneficiarioSearch represents the model behind the search form about `app\models\Rpcbeneficiario`.
 */
class RpcbeneficiarioSearch extends Rpcbeneficiario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codemp', 'ced_bene', 'codpai', 'codest', 'codmun', 'codpar', 'codtipcta', 'rifben', 'nombene', 'apebene', 'dirbene', 'telbene', 'celbene', 'email', 'sc_cuenta', 'codbansig', 'codban', 'ctaban', 'foto', 'fecregben', 'nacben', 'numpasben', 'tipconben', 'tipcuebanben', 'sc_cuentarecdoc'], 'safe'],
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
        $query = Rpcbeneficiario::find();

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
            'fecregben' => $this->fecregben,
        ]);

        $query->andFilterWhere(['like', 'codemp', $this->codemp])
            ->andFilterWhere(['like', 'ced_bene', $this->ced_bene])
            ->andFilterWhere(['like', 'codpai', $this->codpai])
            ->andFilterWhere(['like', 'codest', $this->codest])
            ->andFilterWhere(['like', 'codmun', $this->codmun])
            ->andFilterWhere(['like', 'codpar', $this->codpar])
            ->andFilterWhere(['like', 'codtipcta', $this->codtipcta])
            ->andFilterWhere(['like', 'rifben', $this->rifben])
            ->andFilterWhere(['like', 'nombene', $this->nombene])
            ->andFilterWhere(['like', 'apebene', $this->apebene])
            ->andFilterWhere(['like', 'dirbene', $this->dirbene])
            ->andFilterWhere(['like', 'telbene', $this->telbene])
            ->andFilterWhere(['like', 'celbene', $this->celbene])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'sc_cuenta', $this->sc_cuenta])
            ->andFilterWhere(['like', 'codbansig', $this->codbansig])
            ->andFilterWhere(['like', 'codban', $this->codban])
            ->andFilterWhere(['like', 'ctaban', $this->ctaban])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'nacben', $this->nacben])
            ->andFilterWhere(['like', 'numpasben', $this->numpasben])
            ->andFilterWhere(['like', 'tipconben', $this->tipconben])
            ->andFilterWhere(['like', 'tipcuebanben', $this->tipcuebanben])
            ->andFilterWhere(['like', 'sc_cuentarecdoc', $this->sc_cuentarecdoc]);

        return $dataProvider;
    }
}
