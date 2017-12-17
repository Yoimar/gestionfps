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
    
    public function actionGestiona($trabajador=null, $departamento=null)
    {
        $modelorigenmemo = new Origenmemo;
        $modelfinalmemo = new Finalmemo;
        $searchModel = new \app\models\GestionSearchGestionalo();

        if ($modelorigenmemo->load(Yii::$app->request->post())) {
            
            //Recibo los datos de la Busqueda
            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(
                    [
                        'estatus1_id'=>$modelorigenmemo->estatus1,
                        'estatus2_id'=>$modelorigenmemo->estatus2,
                        'estatus3_id'=>$modelorigenmemo->estatus3,
                        'departamento_id'=>$modelorigenmemo->departamento,
                        'recepcion_id'=>$modelorigenmemo->unidad,
                    ]);
            
            
            // Deberia Enviar al Controlador con los datos
            
            
        
        
            return $this->render('gestiona', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'modelorigenmemo' => $modelorigenmemo,
                'modelfinalmemo' => $modelfinalmemo,
      
        ]);
            
            
            
        } else {
        
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['trabajador_id'=>$trabajador]);
        
        
        return $this->render('gestiona', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelorigenmemo' => $modelorigenmemo,
            'modelfinalmemo' => $modelfinalmemo,
        ]);
    
    }
    }
    
    /**
     * Para realizar la Vista Parcial que me permitira filtrar los casos del Origen  
     */
    
    public function actionCambioestatusgeneromemo() {
    
    $selectiona = (array)Yii::$app->request->post('selection'); //typecasting

    

//    foreach ($selection as $id) {
//        
//    }
    return $this->render('memorandum', [
                'selectionas' => $selectiona,
    ]);
}
    
}
