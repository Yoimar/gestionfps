<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conexionsigesp;

/**
 * ConexionsigespSearch represents the model behind the search form of `app\models\Conexionsigesp`.
 */
class ConexionsigespSearch extends Conexionsigesp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_presupuesto', 'rif', 'created_by', 'updated_by', 'compromiso_by', 'regdocorpa_by', 'aprdocorpa_by', 'orpa_by', 'aprorpa_by', 'causado_by', 'progpago_by', 'cheque_by', 'entregado_by', 'anulado_by', 'archivo_by'], 'integer'],
            [['req', 'codestpre', 'cuenta', 'date', 'created_at', 'updated_at', 'estatus_sigesp', 'date_compromiso', 'numrecdoc', 'date_regdocorpa', 'date_aprdocorpa', 'orpa', 'date_orpa', 'date_aprorpa', 'date_causado', 'date_progpago', 'cheque', 'date_cheque', 'date_enviofirma', 'date_enviocaja', 'date_entregado', 'fechahoraregistro_entregado', 'ci_entrega', 'nombre_entrega', 'trabajador_responsableentrega', 'date_anulado', 'motivo_anulado', 'imagen_entrega', 'date_archivo'], 'safe'],
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
        $query = Conexionsigesp::find();

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
            'id_presupuesto' => $this->id_presupuesto,
            'rif' => $this->rif,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'date_compromiso' => $this->date_compromiso,
            'compromiso_by' => $this->compromiso_by,
            'date_regdocorpa' => $this->date_regdocorpa,
            'regdocorpa_by' => $this->regdocorpa_by,
            'date_aprdocorpa' => $this->date_aprdocorpa,
            'aprdocorpa_by' => $this->aprdocorpa_by,
            'date_orpa' => $this->date_orpa,
            'orpa_by' => $this->orpa_by,
            'date_aprorpa' => $this->date_aprorpa,
            'aprorpa_by' => $this->aprorpa_by,
            'date_causado' => $this->date_causado,
            'causado_by' => $this->causado_by,
            'date_progpago' => $this->date_progpago,
            'progpago_by' => $this->progpago_by,
            'date_cheque' => $this->date_cheque,
            'cheque_by' => $this->cheque_by,
            'date_enviofirma' => $this->date_enviofirma,
            'date_enviocaja' => $this->date_enviocaja,
            'date_entregado' => $this->date_entregado,
            'fechahoraregistro_entregado' => $this->fechahoraregistro_entregado,
            'entregado_by' => $this->entregado_by,
            'date_anulado' => $this->date_anulado,
            'anulado_by' => $this->anulado_by,
            'date_archivo' => $this->date_archivo,
            'archivo_by' => $this->archivo_by,
        ]);

        $query->andFilterWhere(['ilike', 'req', $this->req])
            ->andFilterWhere(['ilike', 'codestpre', $this->codestpre])
            ->andFilterWhere(['ilike', 'cuenta', $this->cuenta])
            ->andFilterWhere(['ilike', 'estatus_sigesp', $this->estatus_sigesp])
            ->andFilterWhere(['ilike', 'numrecdoc', $this->numrecdoc])
            ->andFilterWhere(['ilike', 'orpa', $this->orpa])
            ->andFilterWhere(['ilike', 'cheque', $this->cheque])
            ->andFilterWhere(['ilike', 'ci_entrega', $this->ci_entrega])
            ->andFilterWhere(['ilike', 'nombre_entrega', $this->nombre_entrega])
            ->andFilterWhere(['ilike', 'trabajador_responsableentrega', $this->trabajador_responsableentrega])
            ->andFilterWhere(['ilike', 'motivo_anulado', $this->motivo_anulado])
            ->andFilterWhere(['ilike', 'imagen_entrega', $this->imagen_entrega]);

        return $dataProvider;
    }
}
