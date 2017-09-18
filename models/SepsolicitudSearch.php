<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sepsolicitud;

/**
 * SepsolicitudSearch represents the model behind the search form about `app\models\Sepsolicitud`.
 */
class SepsolicitudSearch extends Sepsolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codemp', 'numsol', 'codtipsol', 'codfuefin', 'fecregsol', 'estsol', 'consol', 'tipo_destino', 'cod_pro', 'ced_bene', 'coduniadm', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla', 'fecaprsep', 'codaprusu', 'fechaconta', 'fechaanula', 'nombenalt', 'tipsepbie', 'codusu', 'numdocori', 'conanusep', 'feccieinv', 'codcencos'], 'safe'],
            [['monto', 'monbasinm', 'montotcar', 'numpolcon'], 'number'],
            [['estapro'], 'integer'],
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
        $query = Sepsolicitud::find();

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
            'fecregsol' => $this->fecregsol,
            'monto' => $this->monto,
            'monbasinm' => $this->monbasinm,
            'montotcar' => $this->montotcar,
            'estapro' => $this->estapro,
            'fecaprsep' => $this->fecaprsep,
            'numpolcon' => $this->numpolcon,
            'fechaconta' => $this->fechaconta,
            'fechaanula' => $this->fechaanula,
            'feccieinv' => $this->feccieinv,
        ]);

        $query->andFilterWhere(['like', 'codemp', $this->codemp])
            ->andFilterWhere(['like', 'numsol', $this->numsol])
            ->andFilterWhere(['like', 'codtipsol', $this->codtipsol])
            ->andFilterWhere(['like', 'codfuefin', $this->codfuefin])
            ->andFilterWhere(['like', 'estsol', $this->estsol])
            ->andFilterWhere(['like', 'consol', $this->consol])
            ->andFilterWhere(['like', 'tipo_destino', $this->tipo_destino])
            ->andFilterWhere(['like', 'cod_pro', $this->cod_pro])
            ->andFilterWhere(['like', 'ced_bene', $this->ced_bene])
            ->andFilterWhere(['like', 'coduniadm', $this->coduniadm])
            ->andFilterWhere(['like', 'codestpro1', $this->codestpro1])
            ->andFilterWhere(['like', 'codestpro2', $this->codestpro2])
            ->andFilterWhere(['like', 'codestpro3', $this->codestpro3])
            ->andFilterWhere(['like', 'codestpro4', $this->codestpro4])
            ->andFilterWhere(['like', 'codestpro5', $this->codestpro5])
            ->andFilterWhere(['like', 'estcla', $this->estcla])
            ->andFilterWhere(['like', 'codaprusu', $this->codaprusu])
            ->andFilterWhere(['like', 'nombenalt', $this->nombenalt])
            ->andFilterWhere(['like', 'tipsepbie', $this->tipsepbie])
            ->andFilterWhere(['like', 'codusu', $this->codusu])
            ->andFilterWhere(['like', 'numdocori', $this->numdocori])
            ->andFilterWhere(['like', 'conanusep', $this->conanusep])
            ->andFilterWhere(['like', 'codcencos', $this->codcencos]);

        return $dataProvider;
    }
}
