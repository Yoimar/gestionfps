<?php

namespace app\controllers;

use Yii;
use app\models\Sepsolicitud;
use app\models\SepsolicitudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Sepingreso;
use app\models\Solicitudes;
use yii\db\Query;

/**
 * SepsolicitudController implements the CRUD actions for Sepsolicitud model.
 */
class SepsolicitudController extends Controller
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
                    'ubica',
                    'muestra',
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
                        'actions' => ['create', 'ubica', 'muestra'],
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
     * Lists all Sepsolicitud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SepsolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sepsolicitud model.
     * @param string $codemp
     * @param string $numsol
     * @return mixed
     */
    public function actionView($codemp, $numsol)
    {
        return $this->render('view', [
            'model' => $this->findModel($codemp, $numsol),
        ]);
    }

    /**
     * Creates a new Sepsolicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sepsolicitud();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'numsol' => $model->numsol]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUbica()
    {
        $model = new \app\models\Sepingreso;

        if ($model->load(Yii::$app->request->post())) {
            
            $numero = $model->caso;
            
            $searchModel = new \app\models\ConexionsigespSearch();
            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            return $this->redirect(
                    ['muestra', 
                        [   
                            'numero' => $numero,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]
                    ]);
        } else {
            return $this->render('ubica', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionMuestra()
    {       
        if(Yii::$app->request->post()){
            $numero = $model->caso;
        }else {
        $numero =0;
        $searchModel = new \app\models\ConexionsigespSearch();    
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        return $this->render('muestra', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Updates an existing Sepsolicitud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $codemp
     * @param string $numsol
     * @return mixed
     */
    public function actionUpdate($codemp, $numsol)
    {
        $model = $this->findModel($codemp, $numsol);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'numsol' => $model->numsol]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sepsolicitud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $codemp
     * @param string $numsol
     * @return mixed
     */
    public function actionDelete($codemp, $numsol)
    {
        $this->findModel($codemp, $numsol)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sepsolicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $codemp
     * @param string $numsol
     * @return Sepsolicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
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
    
    protected function findModel($codemp, $numsol)
    {
        if (($model = Sepsolicitud::findOne(['codemp' => $codemp, 'numsol' => $numsol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
