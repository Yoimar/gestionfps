<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gestion;

/**
 * GestionSearch represents the model behind the search form about `app\models\Gestion`.
 */
class GestionSearch extends Gestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'programaevento_id', 'solicitud_id', 'convenio_id', 'estatus3_id', 'rango_solicitante_id', 'rango_beneficiario_id', 'trabajador_id', 'created_by', 'updated_by', 'tipodecontacto_id'], 'integer'],
            [['militar_solicitante', 'militar_beneficiario'], 'boolean'],
            [['afrodescendiente', 'indigena', 'sexodiversidad', 'created_at', 'updated_at'], 'safe'],
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
        $query = Gestion::find();

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
            'programaevento_id' => $this->programaevento_id,
            'solicitud_id' => $this->solicitud_id,
            'convenio_id' => $this->convenio_id,
            'estatus3_id' => $this->estatus3_id,
            'militar_solicitante' => $this->militar_solicitante,
            'rango_solicitante_id' => $this->rango_solicitante_id,
            'militar_beneficiario' => $this->militar_beneficiario,
            'rango_beneficiario_id' => $this->rango_beneficiario_id,
            'trabajador_id' => $this->trabajador_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'tipodecontacto_id' => $this->tipodecontacto_id,
        ]);

        $query->andFilterWhere(['like', 'afrodescendiente', $this->afrodescendiente])
            ->andFilterWhere(['like', 'indigena', $this->indigena])
            ->andFilterWhere(['like', 'sexodiversidad', $this->sexodiversidad]);

        return $dataProvider;
    }
}
