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
            [['codemp', 'numsol', 'codtipsol', 'codfuefin', 'fecregsol', 'estsol', 'consol', 'tipo_destino', 'cod_pro', 'ced_bene', 'coduniadm', 'codestpro1', 'codestpro2', 'codestpro3', 'codestpro4', 'codestpro5', 'estcla', 'fecaprsep', 'codaprusu', 'fechaconta', 'fechaanula', 'nombenalt', 'tipsepbie', 'codusu', 'numdocori', 'conanusep', 'feccieinv', 'codcencos', 'nombrebeneficiario', 'rifbeneficiario', 'estructura'], 'safe'],
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
        $query = Sepsolicitud::find()
                ->select([
                    "sep_solicitud.codemp as codemp",
                    "sep_solicitud.numsol as numsol",
                    "sep_solicitud.codtipsol as codtipsol",
                    "sep_solicitud.codfuefin as codfuefin",
                    "sep_solicitud.fecregsol as fecregsol",
                    "sep_solicitud.estsol as estsol",
                    "sep_solicitud.consol as consol",
                    "sep_solicitud.monto as monto",
                    "sep_solicitud.monbasinm as monbasinm",
                    "sep_solicitud.montotcar as montotcar",
                    "sep_solicitud.tipo_destino as tipo_destino",
                    "sep_solicitud.cod_pro as cod_pro",
                    "sep_solicitud.ced_bene as ced_bene",
                    "sep_solicitud.coduniadm as coduniadm",
                    "sep_solicitud.codestpro1 as codestpro1",
                    "sep_solicitud.codestpro2 as codestpro2",
                    "sep_solicitud.codestpro3 as codestpro3",
                    "sep_solicitud.codestpro4 as codestpro4",
                    "sep_solicitud.codestpro5 as codestpro5",
                    "sep_solicitud.estcla as estcla",
                    "sep_solicitud.estapro as estapro",
                    "sep_solicitud.fecaprsep as fecaprsep",
                    "sep_solicitud.codaprusu as codaprusu",
                    "sep_solicitud.numpolcon as numpolcon",
                    "sep_solicitud.fechaconta as fechaconta",
                    "sep_solicitud.fechaanula as fechaanula",
                    "sep_solicitud.nombenalt as nombenalt",
                    "sep_solicitud.tipsepbie as tipsepbie",
                    "sep_solicitud.codusu as codusu",
                    "sep_solicitud.numdocori as numdocori",
                    "sep_solicitud.conanusep as conanusep",
                    "sep_solicitud.feccieinv as feccieinv",
                    "sep_solicitud.codcencos as codcencos",
                    "rpc_beneficiario.apebene as nombrebeneficiario",
                    "rpc_beneficiario.rifben as rifbeneficiario",
                    ]);

        // add conditions that should always apply here
        
        $query->join('LEFT JOIN', 'rpc_beneficiario', 'rpc_beneficiario.ced_bene = sep_solicitud.ced_bene');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'numsol' => SORT_DESC,
                ],
                'attributes' => [
                    'codemp' => [
                        'asc' => ['sep_solicitud.codemp' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codemp' => \SORT_DESC], 
                    ],
                    'numsol' => [
                        'asc' => ['sep_solicitud.numsol' => \SORT_ASC],
                        'desc' => ['sep_solicitud.numsol' => \SORT_DESC],
                        ],
                    'codtipsol' => [
                        'asc' => ['sep_solicitud.codtipsol' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codtipsol' => \SORT_DESC],
                        ],
                    'codfuefin' => [
                        'asc' => ['sep_solicitud.codfuefin' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codfuefin' => \SORT_DESC],
                        ],
                    'fecregsol' => [
                        'asc' => ['sep_solicitud.fecregsol' => \SORT_ASC],
                        'desc' => ['sep_solicitud.fecregsol' => \SORT_DESC],
                        ],
                    'estsol' => [
                        'asc' => ['sep_solicitud.estsol' => \SORT_ASC],
                        'desc' => ['sep_solicitud.estsol' => \SORT_DESC],
                        ],
                    'consol' => [
                        'asc' => ['sep_solicitud.consol' => \SORT_ASC],
                        'desc' => ['sep_solicitud.consol' => \SORT_DESC],
                        ],
                    'monto' => [
                        'asc' => ['sep_solicitud.monto' => \SORT_ASC],
                        'desc' => ['sep_solicitud.monto' => \SORT_DESC],
                        ],
                    'monbasinm' => [
                        'asc' => ['sep_solicitud.monbasinm' => \SORT_ASC],
                        'desc' => ['sep_solicitud.monbasinm' => \SORT_DESC],
                        ],
                    'montotcar' => [
                        'asc' => ['sep_solicitud.montotcar' => \SORT_ASC],
                        'desc' => ['sep_solicitud.montotcar' => \SORT_DESC],
                        ],
                    'tipo_destino' => [
                        'asc' => ['sep_solicitud.tipo_destino' => \SORT_ASC],
                        'desc' => ['sep_solicitud.tipo_destino' => \SORT_DESC],
                        ],
                    'cod_pro' => [
                        'asc' => ['sep_solicitud.cod_pro' => \SORT_ASC],
                        'desc' => ['sep_solicitud.cod_pro' => \SORT_DESC],
                        ],
                    'ced_bene' => [
                        'asc' => ['sep_solicitud.ced_bene' => \SORT_ASC],
                        'desc' => ['sep_solicitud.ced_bene' => \SORT_DESC],
                        ],
                    'coduniadm' => [
                        'asc' => ['sep_solicitud.coduniadm' => \SORT_ASC],
                        'desc' => ['sep_solicitud.coduniadm' => \SORT_DESC],
                        ],
                    'codestpro1' => [
                        'asc' => ['sep_solicitud.codestpro1' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro1' => \SORT_DESC],
                        ],
                    'codestpro2' => [
                        'asc' => ['sep_solicitud.codestpro2' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro2' => \SORT_DESC],
                        ],
                    'codestpro3' => [
                        'asc' => ['sep_solicitud.codestpro3' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro3' => \SORT_DESC],
                        ],
                    'codestpro4' => [
                        'asc' => ['sep_solicitud.codestpro4' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro4' => \SORT_DESC],
                        ],
                    'codestpro5' => [
                        'asc' => ['sep_solicitud.codestpro5' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro5' => \SORT_DESC],
                        ],
                    'estcla' => [
                        'asc' => ['sep_solicitud.estcla' => \SORT_ASC],
                        'desc' => ['sep_solicitud.estcla' => \SORT_DESC],
                        ],
                    'estapro ' => [
                        'asc' => ['sep_solicitud.estapro ' => \SORT_ASC],
                        'desc' => ['sep_solicitud.estapro ' => \SORT_DESC],
                        ],
                    'fecaprsep' => [
                        'asc' => ['sep_solicitud.fecaprsep' => \SORT_ASC],
                        'desc' => ['sep_solicitud.fecaprsep' => \SORT_DESC],
                        ],
                    'codaprusu' => [
                        'asc' => ['sep_solicitud.codaprusu' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codaprusu' => \SORT_DESC],
                        ],
                    'numpolcon' => [
                        'asc' => ['sep_solicitud.numpolcon' => \SORT_ASC],
                        'desc' => ['sep_solicitud.numpolcon' => \SORT_DESC],
                        ],
                    'fechaconta' => [
                        'asc' => ['sep_solicitud.fechaconta' => \SORT_ASC],
                        'desc' => ['sep_solicitud.fechaconta' => \SORT_DESC],
                        ],
                    'fechaanula' => [
                        'asc' => ['sep_solicitud.fechaanula' => \SORT_ASC],
                        'desc' => ['sep_solicitud.fechaanula' => \SORT_DESC],
                        ],
                    'nombenalt' => [
                        'asc' => ['sep_solicitud.nombenalt' => \SORT_ASC],
                        'desc' => ['sep_solicitud.nombenalt' => \SORT_DESC],
                        ],
                    'tipsepbie' => [
                        'asc' => ['sep_solicitud.tipsepbie' => \SORT_ASC],
                        'desc' => ['sep_solicitud.tipsepbie' => \SORT_DESC],
                        ],
                    'codusu' => [
                        'asc' => ['sep_solicitud.codusu' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codusu' => \SORT_DESC],
                        ],
                    'numdocori' => [
                        'asc' => ['sep_solicitud.numdocori' => \SORT_ASC],
                        'desc' => ['sep_solicitud.numdocori' => \SORT_DESC],
                        ],
                    'conanusep' => [
                        'asc' => ['sep_solicitud.conanusep' => \SORT_ASC],
                        'desc' => ['sep_solicitud.conanusep' => \SORT_DESC],
                        ],
                    'feccieinv' => [
                        'asc' => ['sep_solicitud.feccieinv' => \SORT_ASC],
                        'desc' => ['sep_solicitud.feccieinv' => \SORT_DESC],
                        ],
                    'codcencos' => [
                        'asc' => ['sep_solicitud.codcencos' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codcencos' => \SORT_DESC],
                        ],
                    'nombrebeneficiario' => [
                        'asc' => ['rpc_beneficiario.apebene' => \SORT_ASC],
                        'desc' => ['rpc_beneficiario.apebene' => \SORT_DESC], 
                    ],
                    'rifbeneficiario' => [
                        'asc' => ['rpc_beneficiario.rifben' => \SORT_ASC],
                        'desc' => ['rpc_beneficiario.rifben' => \SORT_DESC], 
                    ],
                    'estructura' => [
                        'asc' => ['sep_solicitud.codestpro3' => \SORT_ASC],
                        'desc' => ['sep_solicitud.codestpro3' => \SORT_DESC], 
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

        $query->andFilterWhere(['like', 'sep_solicitud.codemp', $this->codemp])
            ->andFilterWhere(['like', 'sep_solicitud.numsol', $this->numsol])
            ->andFilterWhere(['like', 'sep_solicitud.codtipsol', $this->codtipsol])
            ->andFilterWhere(['like', 'sep_solicitud.codfuefin', $this->codfuefin])
            ->andFilterWhere(['like', 'sep_solicitud.estsol', $this->estsol])
            ->andFilterWhere(['like', 'sep_solicitud.consol', $this->consol])
            ->andFilterWhere(['like', 'sep_solicitud.tipo_destino', $this->tipo_destino])
            ->andFilterWhere(['like', 'sep_solicitud.cod_pro', $this->cod_pro])
            ->andFilterWhere(['like', 'sep_solicitud.ced_bene', $this->ced_bene])
            ->andFilterWhere(['like', 'sep_solicitud.coduniadm', $this->coduniadm])
            ->andFilterWhere(['like', 'sep_solicitud.codestpro1', $this->codestpro1])
            ->andFilterWhere(['like', 'sep_solicitud.codestpro2', $this->codestpro2])
            ->andFilterWhere(['like', 'sep_solicitud.codestpro3', $this->codestpro3])
            ->andFilterWhere(['like', 'sep_solicitud.codestpro4', $this->codestpro4])
            ->andFilterWhere(['like', 'sep_solicitud.codestpro5', $this->codestpro5])
            ->andFilterWhere(['like', 'sep_solicitud.estcla', $this->estcla])
            ->andFilterWhere(['like', 'sep_solicitud.codaprusu', $this->codaprusu])
            ->andFilterWhere(['like', 'sep_solicitud.nombenalt', $this->nombenalt])
            ->andFilterWhere(['like', 'sep_solicitud.tipsepbie', $this->tipsepbie])
            ->andFilterWhere(['like', 'sep_solicitud.codusu', $this->codusu])
            ->andFilterWhere(['like', 'sep_solicitud.numdocori', $this->numdocori])
            ->andFilterWhere(['like', 'sep_solicitud.conanusep', $this->conanusep])
            ->andFilterWhere(['like', 'sep_solicitud.codcencos', $this->codcencos])
            ->orFilterWhere(['like', 'sep_solicitud.codestpro1', $this->estructura])
            ->orFilterWhere(['like', 'sep_solicitud.codestpro2', $this->estructura])
            ->orFilterWhere(['like', 'sep_solicitud.codestpro3', $this->estructura])
            ->andFilterWhere(['like', 'rpc_beneficiario.apebene', $this->nombrebeneficiario])
            ->andFilterWhere(['like', 'rpc_beneficiario.rifben', $this->rifbeneficiario]);

        return $dataProvider;
    }
}
