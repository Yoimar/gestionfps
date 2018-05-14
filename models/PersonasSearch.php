<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personas;

/**
 * PersonasSearch represents the model behind the search form about `app\models\Personas`.
 */
class PersonasSearch extends Personas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_nacionalidad_id', 'ci', 'estado_civil_id', 'nivel_academico_id', 'parroquia_id', 'seguro_id', 'version'], 'integer'],
            [['nombre', 'apellido', 'sexo', 'lugar_nacimiento', 'fecha_nacimiento', 'ciudad', 'zona_sector', 'calle_avenida', 'apto_casa', 'telefono_fijo', 'telefono_celular', 'telefono_otro', 'email', 'twitter', 'ocupacion', 'observaciones', 'otro_apoyo', 'created_at', 'updated_at'], 'safe'],
            [['ind_trabaja', 'ind_asegurado'], 'boolean'],
            [['ingreso_mensual', 'cobertura'], 'number'],
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
        $query = Personas::find();

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
            'tipo_nacionalidad_id' => $this->tipo_nacionalidad_id,
            'ci' => $this->ci,
            'estado_civil_id' => $this->estado_civil_id,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'nivel_academico_id' => $this->nivel_academico_id,
            'parroquia_id' => $this->parroquia_id,
            'ind_trabaja' => $this->ind_trabaja,
            'ingreso_mensual' => $this->ingreso_mensual,
            'ind_asegurado' => $this->ind_asegurado,
            'seguro_id' => $this->seguro_id,
            'cobertura' => $this->cobertura,
            'version' => $this->version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'lugar_nacimiento', $this->lugar_nacimiento])
            ->andFilterWhere(['ilike', 'ciudad', $this->ciudad])
            ->andFilterWhere(['ilike', 'zona_sector', $this->zona_sector])
            ->andFilterWhere(['ilike', 'calle_avenida', $this->calle_avenida])
            ->andFilterWhere(['ilike', 'apto_casa', $this->apto_casa])
            ->andFilterWhere(['like', 'telefono_fijo', $this->telefono_fijo])
            ->andFilterWhere(['like', 'telefono_celular', $this->telefono_celular])
            ->andFilterWhere(['like', 'telefono_otro', $this->telefono_otro])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'ocupacion', $this->ocupacion])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'otro_apoyo', $this->otro_apoyo]);

        return $dataProvider;
    }
}
