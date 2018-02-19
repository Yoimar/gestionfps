<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gestion;

/**
 * GestionSearch represents the model behind the search form about `app\models\Gestion`.
 */
class GestionSearchGestionalo extends Gestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estatus1_id', 'estatus2_id', 'estatus3_id', 'departamento', 'trabajador_id', 'updated_by', 'recepcion_id', 'unidadorigen', 'departamento_id', 'cantidad'], 'integer'],
            [['solicitud_id', 'num_solicitud', 'cibeneficiario', 'beneficiario', 'telefono', 'fechaingreso', 'fechaingreso_hasta', 'fechaultimamodificacion','trabajadorsocial', 'empresaoinstitucion', 'cheque', 'updated_at', 'updated_hasta', 'iddoc', 'rif', 'orpa', 'requerimiento'  ], 'safe'],
            [['monto'], 'number'],
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
        $query = Gestion::find()
                ->select(['solicitudes.num_solicitud as num_solicitud', 
                'gestion.id as id', 
                "estatus1.id as estatus1_id", 
                "estatus2.id as estatus2_id", 
                'gestion.estatus3_id',
                'gestion.trabajador_id',
                'gestion.recepcion_id', 
                'recepciones2.nombre as unidadorigen',    
                'departamentos.id as departamento', 
                "personabeneficiario.ci as cibeneficiario", 
                "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) AS beneficiario", 
                'users.nombre as trabajadorsocial', 
                'solicitudes.usuario_asignacion_id',
                'solicitudes.estatus',
                "to_char(solicitudes.created_at, 'DD/MM/YYYY') as fechaingreso", 
                "TO_CHAR(gestion.updated_at, 'DD/MM/YYYY') as fechaultimamodificacion",
                "CONCAT(COALESCE(personabeneficiario.telefono_fijo || ' ', '') || COALESCE(personabeneficiario.telefono_celular || ' ', '') || COALESCE(personabeneficiario.telefono_otro || ' ', '') ) as telefono",
                "extract(YEAR FROM age(now(),personabeneficiario.fecha_nacimiento)) as edadbeneficiario",
                "string_agg(to_char(presupuestos.documento_id,'999999'), '  //  ') as iddoc",
                "string_agg(to_char(presupuestos.numop,'999999'), '  //  ') as orpa",
                "string_agg(CONCAT(COALESCE(empresa_institucion.rif || '-', '') || empresa_institucion.nrif), '  //  ') as rif",
                "string_agg(conexionsigesp.req, '  //  ') as requerimiento",
                "string_agg(empresa_institucion.nombrecompleto, '  //  ') as empresaoinstitucion",
                "count(presupuestos.cantidad) as cantidad", 
                "string_agg(presupuestos.cheque, ' // ') as cheque", 
                "sum(presupuestos.montoapr) as monto"]);

        // add conditions that should always apply here
        
        $query->join('LEFT JOIN', 'solicitudes','gestion.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'users', 'solicitudes.usuario_asignacion_id = users.id')
                ->join('LEFT JOIN', 'presupuestos', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
                ->join('LEFT JOIN', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                ->join('LEFT JOIN', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                ->join('LEFT JOIN', 'personas as personabeneficiario', 'solicitudes.persona_beneficiario_id  = personabeneficiario.id')
                ->join('LEFT JOIN', 'personas as personasolicitante', 'solicitudes.persona_solicitante_id  = personasolicitante.id')
                ->join('LEFT JOIN', 'empresa_institucion', 'presupuestos.beneficiario_id = empresa_institucion.id')
                ->join('LEFT JOIN', 'conexionsigesp', 'presupuestos.id = conexionsigesp.id_presupuesto')
                ->join('LEFT JOIN', 'recepciones', 'recepciones.id = gestion.recepcion_id')
                ->join('LEFT JOIN', 'recepciones as recepciones2', 'recepciones2.id = solicitudes.recepcion_id')
                ->join('LEFT JOIN', 'departamentos', 'recepciones.departamentos_id = departamentos.id')
                ->groupBy(['num_solicitud', 
                    'gestion.id', 
                    'estatus1.id', 
                    'estatus2.id', 
                    'gestion.estatus3_id', 
                    'gestion.trabajador_id',
                    'gestion.recepcion_id',
                    'unidadorigen',    
                    'departamentos.id',
                    'cibeneficiario', 
                    'beneficiario', 
                    'trabajadorsocial', 
                    'solicitudes.usuario_asignacion_id', 
                    'solicitudes.estatus', 
                    'fechaingreso', 
                    'fechaultimamodificacion', 
                    'telefono', 
                    'edadbeneficiario']);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'solicitud_id' => SORT_DESC,
                ],
                'attributes' => [
                    'num_solicitud' => [
                        'asc' => ['num_solicitud' => \SORT_ASC],
                        'desc' => ['num_solicitud' => \SORT_DESC],
                    ],
                    'solicitud_id' => [
                        'asc' => ['gestion.solicitud_id' => \SORT_ASC],
                        'desc' => ['gestion.solicitud_id' => \SORT_DESC],
                    ],
                    'estatus1_id' => [
                        'asc' => ['estatus1.nombre' => \SORT_ASC],
                        'desc' => ['estatus1.nombre' => \SORT_DESC],
                    ],
                    'estatus2_id' => [
                        'asc' => ['estatus2.nombre' => \SORT_ASC],
                        'desc' => ['estatus2.nombre' => \SORT_DESC],
                    ],
                    'estatus3_id' => [
                        'asc' => ['estatus3.nombre' => \SORT_ASC],
                        'desc' => ['estatus3.nombre' => \SORT_DESC],
                    ],
                    'trabajador_id' => [ 
                        'asc' => ['gestion.trabajador_id' => \SORT_ASC],
                        'desc' => ['gestion.trabajador_id' => \SORT_DESC],
                    ],
                    'mes_actividad' => [ 
                        'asc' => ['mes_actividad' => \SORT_ASC],
                        'desc' => ['mes_actividad' => \SORT_DESC],
                    ],
                    'beneficiario' => [ 
                        'asc' => ['beneficiario' => \SORT_ASC],
                        'desc' => ['beneficiario' => \SORT_DESC],
                    ],
                    'cibeneficiario' => [ 
                        'asc' => ['cibeneficiario' => \SORT_ASC],
                        'desc' => ['cibeneficiario' => \SORT_DESC],
                    ],
                    'tratamiento' => [ 
                        'asc' => ['tratamiento' => \SORT_ASC],
                        'desc' => ['tratamiento' => \SORT_DESC],
                    ],
                    'nino' => [ 
                        'asc' => ['nino' => \SORT_ASC],
                        'desc' => ['nino' => \SORT_DESC],
                    ],
                    'trabajadorsocial' => [ 
                        'asc' => ['trabajadorsocial' => \SORT_ASC],
                        'desc' => ['trabajadorsocial' => \SORT_DESC],
                    ],
                    'necesidad' => [ 
                        'asc' => ['solicitudes.necesidad' => \SORT_ASC],
                        'desc' => ['solicitudes.necesidad' => \SORT_DESC],
                    ],
                    'monto' => [ 
                        'asc' => ['monto' => \SORT_ASC],
                        'desc' => ['monto' => \SORT_DESC],
                    ],
                    'mesingreso' => [ 
                        'asc' => ['mesingreso' => \SORT_ASC],
                        'desc' => ['mesingreso' => \SORT_DESC],
                    ],
                    'empresaoinstitucion' => [ 
                        'asc' => ['empresaoinstitucion' => \SORT_ASC],
                        'desc' => ['empresaoinstitucion' => \SORT_DESC],
                    ],
                    'cantidad' => [ 
                        'asc' => ['cantidad' => \SORT_ASC],
                        'desc' => ['cantidad' => \SORT_DESC],
                    ],
                    'descripcion' => [ 
                        'asc' => ['solicitudes.descripcion' => \SORT_ASC],
                        'desc' => ['solicitudes.descripcion' => \SORT_DESC],
                    ],
                    'diasdeultimamodificacion' => [ 
                        'asc' => ['diasdeultimamodificacion' => \SORT_ASC],
                        'desc' => ['diasdeultimamodificacion' => \SORT_DESC],
                    ],
                    'diasdesolicitud' => [ 
                        'asc' => ['diasdesolicitud' => \SORT_ASC],
                        'desc' => ['diasdesolicitud' => \SORT_DESC],
                    ],
                    'cheque' => [ 
                        'asc' => ['presupuestos.cheque' => \SORT_ASC],
                        'desc' => ['presupuestos.cheque' => \SORT_DESC],
                    ],
                    'anodelasolicitud' => [ 
                        'asc' => ['anodelasolicitud' => \SORT_ASC],
                        'desc' => ['anodelasolicitud' => \SORT_DESC],
                    ],
                    'fechaingreso' => [ 
                        'asc' => ['fechaingreso' => \SORT_ASC],
                        'desc' => ['fechaingreso' => \SORT_DESC],
                    ],
                    'fechaultimamodificacion' => [ 
                        'asc' => ['fechaultimamodificacion' => \SORT_ASC],
                        'desc' => ['fechaultimamodificacion' => \SORT_DESC],
                    ],
                    'edadbeneficiario' => [ 
                        'asc' => ['edadbeneficiario' => \SORT_ASC],
                        'desc' => ['edadbeneficiario' => \SORT_DESC],
                    ],
                    'instruccion_id' => [ 
                        'asc' => ['gestion.instrucion_id' => \SORT_ASC],
                        'desc' => ['gestion.intruccion_id' => \SORT_DESC],
                    ],
                    'telefono' => [ 
                        'asc' => ['telefono' => \SORT_ASC],
                        'desc' => ['telefono' => \SORT_DESC],
                    ],
                    'requerimiento' => [ 
                        'asc' => ['requerimiento' => \SORT_ASC],
                        'desc' => ['requerimiento' => \SORT_DESC],
                    ],
                    'iddoc' => [ 
                        'asc' => ['iddoc' => \SORT_ASC],
                        'desc' => ['iddoc' => \SORT_DESC],
                    ],
                    'rif' => [ 
                        'asc' => ['iddoc' => \SORT_ASC],
                        'desc' => ['iddoc' => \SORT_DESC],
                    ],
                    'unidadorigen' => [ 
                        'asc' => ['recepciones2.nombre' => \SORT_ASC],
                        'desc' => ['recepciones2.nombre' => \SORT_DESC],
                    ],
                    'orpa' => [ 
                        'asc' => ['orpa' => \SORT_ASC],
                        'desc' => ['orpa' => \SORT_DESC],
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
            'gestion.instruccion_id' => $this->instruccion_id,
            'estatus2_id' => $this->estatus2_id,
            'estatus3_id' => $this->estatus3_id,
            'estatus1_id' => $this->estatus1_id,
            'trabajador_id' => $this->trabajador_id,
            'cantidad' => $this->cantidad,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'gestion.recepcion_id' => $this->recepcion_id,
            'departamentos.id' => $this->departamento,
            'solicitudes.ind_beneficiario_menor' => $this->nino,
        ]);

        $query->andFilterWhere(['like', 'afrodescendiente', $this->afrodescendiente])
            ->andFilterWhere(['like', 'indigena', $this->indigena])
            ->andFilterWhere(['like', 'sexodiversidad', $this->sexodiversidad])
            ->andFilterWhere(['like', "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido)", $this->beneficiario])
            ->andFilterWhere(['=', 'extract(month from solicitudes.created_at)', $this->mesingreso])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(personabeneficiario.ci, '99999999'))", $this->cibeneficiario])
            ->andFilterWhere(['like', 'solicitudes.num_solicitud', $this->solicitud_id])
            ->andFilterWhere(['like', 'users.nombre', $this->trabajadorsocial])
            ->andFilterWhere(['like', 'solicitudes.necesidad', $this->necesidad])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(presupuestos.monto, '9999999999999'))", $this->monto])
            ->andFilterWhere(['like', 'empresa_institucion.nombrecompleto', $this->empresaoinstitucion])
            ->andFilterWhere(['like', 'presupuestos.cheque', $this->cheque])
            ->andFilterWhere(['like', "TRIM(TO_CHAR(extract(year from solicitudes.created_at),'9999'))", $this->anodelasolicitud])
            ->andFilterWhere(['like', 'solicitudes.descripcion', $this->descripcion])
            ->andFilterWhere(['=', "date_part('day' ,now()-gestion.updated_at)", $this->diasdeultimamodificacion])
            ->andFilterWhere(['=', "date_part('day' ,now()-solicitudes.created_at)", $this->diasdesolicitud])
            ->andFilterWhere(['=', "date_part('year' ,now()-personabeneficiario.fecha_nacimiento)", $this->edadbeneficiario])
            ->andFilterWhere(['like', "to_char(solicitudes.created_at, 'DD/MM/YYYY')", $this->fechaingreso])
            ->andFilterWhere(['like', "to_char(gestion.updated_at, 'DD/MM/YYYY')", $this->fechaultimamodificacion])
            ->andFilterWhere(['like', "CONCAT(personabeneficiario.telefono_fijo || ' ' || personabeneficiario.telefono_celular || ' ' || personabeneficiario.telefono_otro)", $this->telefono]);

        return $dataProvider;
    }
    
}
