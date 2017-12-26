<?php

namespace app\controllers;

use Yii;
use app\models\Gestion;
use app\models\GestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Solicitudes;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\filters\AccessControl;
use app\models\Origenmemo;
use app\models\Finalmemo;



/**
 * GestionController implements the CRUD actions for Gestion model.
 */
class GestionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'create',
                    'update',
                    'delete',
                    'view',
                    ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'view',
                        ],
                        'allow' => true,
                        'roles' => ['gestion-listar'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['gestion-crear'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['gestion-actualizar'],
                    ],
                    [
                        'actions' => ['delete' ],
                        'allow' => true,
                        'roles' => ['gestion-eliminar'],
                    ],
                ],
            ],
            
            
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gestion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * Esto de abajo es un select2 con Ajax
     */
    
    public function actionNumsolicitud($q = null, $id = null) {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new Query;
        $query->addSelect(["id", "num_solicitud as text"])
            ->from('solicitudes')
            ->andFilterWhere(['like', "num_solicitud", $q])
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => Solicitudes::find($id)->num_solicitud];
    }
    return $out;
    }
    
    public function actionGestiona()
    {
        $modelorigenmemo = new Origenmemo;
        
        $modelfinalmemo = new Finalmemo;
        
        $searchModel = new \app\models\GestionSearchGestionalo();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
        return $this->render('gestiona', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'modelorigenmemo' => $modelorigenmemo,
                'modelfinalmemo' => $modelfinalmemo,
      
        ]);

    }
    
    /**
     * Para realizar la Vista Parcial que me permitira filtrar los casos del Origen  
     */
    
    public function actionCambioestatus() {
    
    $modelfinalmemo = new Finalmemo;
    
    $modelorigenmemo = new Origenmemo;
    
    if ($modelfinalmemo->load(Yii::$app->request->post())) {
        $estatus3id=$modelfinalmemo->estatus3final;
        $estatus2id=$modelfinalmemo->estatus2final;
        $estatus1id=$modelfinalmemo->estatus1final;
        $departamentoid=$modelfinalmemo->departamentofinal;
        $unidadid=$modelfinalmemo->unidadfinal;
        $trabajadorid=$modelfinalmemo->usuariofinal;
        
        $estatus3id=$modelorigenmemo->estatus3origen;
        $estatus2id=$modelorigenmemo->estatus2origen;
        $estatus1id=$modelorigenmemo->estatus1origen;
        $departamentoid=$modelorigenmemo->departamentoorigen;
        $unidadid=$modelorigenmemo->unidadorigen;
        $trabajadorid=$modelorigenmemo->usuarioorigen;
        
    }
    $selection=(array)Yii::$app->request->post('selection');

    return $this->render('memorandum', [
                'estatus3id' => $estatus3id,
                'estatus2id' => $estatus2id,
                'estatus1id' => $estatus1id,
                'departamentoid' => $departamentoid,
                'unidadid' => $unidadid,
                'trabajadorid' => $trabajadorid,
                'selection' => $selection,
    ]);
    
    }
    
    public function actionOrigenmemo()
    {
        $modelorigenmemo = new Origenmemo;
        
        if ($modelorigenmemo->load(Yii::$app->request->post())) {
            $modelfinalmemo = new Finalmemo;
            $searchModel = new \app\models\GestionSearchGestionalo();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            if($modelorigenmemo->estatus1!=''){
                $dataProvider->query->andWhere(['estatus1_id'=>$modelorigenmemo->estatus1]);
            }
            if($modelorigenmemo->estatus2!=''){
                $dataProvider->query->andWhere(['estatus2_id'=>$modelorigenmemo->estatus2]);
            }
            if($modelorigenmemo->estatus3!=''){
                $dataProvider->query->andWhere(['estatus3_id'=>$modelorigenmemo->estatus3]);
            }
            if($modelorigenmemo->departamento!=''){
                $dataProvider->query->andWhere(['departamento_id'=>$modelorigenmemo->departamento]);
            }
            if($modelorigenmemo->unidad!=''){
                $dataProvider->query->andWhere(['recepcion_id'=>$modelorigenmemo->unidad]);
            }
            if($modelorigenmemo->usuario!=''){
                $dataProvider->query->andWhere(['trabajador_id'=>$modelorigenmemo->usuario]);
            } 
        
        return $this->render('gestiona', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'modelorigenmemo' => $modelorigenmemo,
                'modelfinalmemo' => $modelfinalmemo,
      
        ]);
                  
        }
        return $this->render('origenmemo', [
                'modelorigenmemo' => $modelorigenmemo,
        ]);
        
        
    }
    
}
