<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Solicitudes;
use yii\db\Query;

/**
 * SolicitudesSearch represents the model behind the search form about `app\models\Solicitudes`.
 */
class SolicitudesSearch extends Solicitudes
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'persona_beneficiario_ci', 'persona_solicitante_ci', 'area_id', 'referente_id', 'recepcion_id', 'organismo_id', 'num_proc', 'usuario_asignacion_id', 'usuario_autorizacion_id', 'tipo_vivienda_id', 'tenencia_id', 'departamento_id', 'memo_id', 'version'], 'integer'],
            [['descripcion', 'persona_beneficiario_nombre', 'persona_beneficiario_apellido', 'persona_solicitante_nombre', 'persona_solicitante_apellido', 'actividad', 'referencia', 'referencia_externa', 'accion_tomada', 'necesidad', 'tipo_proc', 'facturas', 'observaciones', 'moneda', 'estatus', 'fecha_asignacion', 'fecha_aceptacion', 'fecha_aprobacion', 'fecha_cierre', 'informe_social', 'beneficiario_json', 'solicitante_json', 'num_solicitud', 'created_at', 'updated_at'], 'safe'],
            [['ind_mismo_benef', 'ind_inmediata', 'ind_beneficiario_menor'], 'boolean'],
            [['total_ingresos'], 'number'],
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
        $query = Solicitudes::find();

        // add conditions that should always apply here
        
        $query->joinWith('personabeneficiario as personabeneficiario', true, 'LEFT JOIN')
              ->joinWith('personasolicitante as personasolicitante', true, 'LEFT JOIN') 
              ->joinWith('estatussasyc', true, 'LEFT JOIN')
              ->joinWith('users', true, 'LEFT JOIN');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'num_solicitud' => SORT_DESC,
                ],
                'attributes' => [
                    'num_solicitud',
                    'persona_beneficiario_nombre' => [
                        'asc' => ['personas.nombre' => SORT_ASC],
                        'desc' => ['personas.nombre' => SORT_DESC],
                    ],
                    'persona_beneficiario_apellido' => [
                        'asc' => ['personas.apellido' => SORT_ASC],
                        'desc' => ['personas.apellido' => SORT_DESC],
                    ],
                    'persona_beneficiario_ci' => [
                        'asc' => ['personas.ci' => SORT_ASC],
                        'desc' => ['personas.ci' => SORT_DESC],
                    ],
                    'persona_solicitante_nombre' => [
                        'asc' => ['personas.nombre' => SORT_ASC],
                        'desc' => ['personas.nombre' => SORT_DESC],
                    ],
                    'persona_solicitante_apellido' => [
                        'asc' => ['personas.apellido' => SORT_ASC],
                        'desc' => ['personas.apellido' => SORT_DESC],
                    ],
                    'persona_solicitante_ci' => [
                        'asc' => ['personas.ci' => SORT_ASC],
                        'desc' => ['personas.ci' => SORT_DESC],
                    ],
                    'estatus' => [
                        'asc' => ['estatussasyc.estatus' => SORT_ASC],
                        'desc' => ['estatussasyc.estatus' => SORT_DESC],
                    ],
                    'usuario_asignacion_id' => [
                        'asc' => ['users.nombre' => SORT_ASC],
                        'desc' => ['users.nombre' => SORT_DESC],
                    ],
    
                ],
            ]
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
            'area_id' => $this->area_id,
            'referente_id' => $this->referente_id,
            'recepcion_id' => $this->recepcion_id,
            'organismo_id' => $this->organismo_id,
            'ind_mismo_benef' => $this->ind_mismo_benef,
            'ind_inmediata' => $this->ind_inmediata,
            'ind_beneficiario_menor' => $this->ind_beneficiario_menor,
            'num_proc' => $this->num_proc,
            'usuario_asignacion_id' => $this->usuario_asignacion_id,
            'usuario_autorizacion_id' => $this->usuario_autorizacion_id,
            'fecha_asignacion' => $this->fecha_asignacion,
            'fecha_aceptacion' => $this->fecha_aceptacion,
            'fecha_aprobacion' => $this->fecha_aprobacion,
            'fecha_cierre' => $this->fecha_cierre,
            'tipo_vivienda_id' => $this->tipo_vivienda_id,
            'tenencia_id' => $this->tenencia_id,
            'departamento_id' => $this->departamento_id,
            'memo_id' => $this->memo_id,
            'total_ingresos' => $this->total_ingresos,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,           
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'actividad', $this->actividad])
            ->andFilterWhere(['like', 'referencia', $this->referencia])
            ->andFilterWhere(['like', 'referencia_externa', $this->referencia_externa])
            ->andFilterWhere(['like', 'accion_tomada', $this->accion_tomada])
            ->andFilterWhere(['like', 'necesidad', $this->necesidad])
            ->andFilterWhere(['like', 'tipo_proc', $this->tipo_proc])
            ->andFilterWhere(['like', 'facturas', $this->facturas])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'moneda', $this->moneda])
            ->andFilterWhere(['like', 'estatussasyc.id', $this->estatus])
            ->andFilterWhere(['like', 'informe_social', $this->informe_social])
            ->andFilterWhere(['like', 'beneficiario_json', $this->beneficiario_json])
            ->andFilterWhere(['like', 'solicitante_json', $this->solicitante_json])
            ->andFilterWhere(['like', 'num_solicitud', $this->num_solicitud])
            ->andFilterWhere(['ilike', 'personabeneficiario.nombre', $this->persona_beneficiario_nombre])
            ->andFilterWhere(['ilike', 'personabeneficiario.apellido', $this->persona_beneficiario_apellido])
            ->andFilterWhere(['ilike', 'personasolicitante.nombre', $this->persona_solicitante_nombre])
            ->andFilterWhere(['ilike', 'personasolicitante.apellido', $this->persona_solicitante_apellido])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '999999999'))", $this->persona_beneficiario_ci])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personasolicitante.ci, '999999999'))", $this->persona_solicitante_ci,]);

        return $dataProvider;
    }
}
