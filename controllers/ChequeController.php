<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Cheque;
use app\models\ChequeSearch;
use app\models\ChequeSearchCarga;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Fotossolicitud;
use app\models\Scbmovbco;
use app\models\Trabajador;

/**
 * ChequeController implements the CRUD actions for Cheque model.
 */
class ChequeController extends Controller
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
                    'view',
                    'create',
                    'update',
                    'delete',
                    'busqueda'
                    ],
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'view',
                            'busqueda',
                        ],
                        'allow' => true,
                        'roles' => ['gestion-crear'],
                    ],
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow' => true,
                        'roles' => ['gestion-listar'],
                    ],
                  [
                        'actions' => [
                            'update',
                        ],
                        'allow' => true,
                        'roles' => ['gestion-actualizar'],
                    ],
                    [
                        'actions' => [
                            'delete',
                        ],
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
     * Lists all Cheque models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChequeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBusqueda()
    {
        $searchModel = new ChequeSearchCarga();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('busqueda', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cheque model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cheque model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cheque();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cheque]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEntregacheque()
    {
        $model = new Cheque();

        if ($model->load(Yii::$app->request->post())) {

            $modelcheque = Scbmovbco::findOne([
                    'numdoc' => $model->cheque,
                    'codope' => 'CH',
                    'estmov' => ['N','C','L','O']
            ]);

            $modelorpa = Scbmovbcospg::findOne([
                'numdoc' => $model->cheque,
                'estmov' => ['N','C']
            ]);
            //reviso
            if (isset($modelorpa)){
                //Para determinar el numero de recpcion
                $modeldtorpa = Cxpdtsolicitudes::findOne([
                    'numsol' => $modelorpa->documento,
                ]);



            }else{
                $model->date_enviofirma = $modelcheque->fecenvfir;
                $model->date_enviocaja = $modelcheque->fecenvcaj;
                $model->estatus_cheque = 'EMI';
                $model->date_cheque = $modelcheque->fecmov;
                $modeluser = Trabajador::findOne([
                    'usuario_sigesp' => $modelcheque->codusu
                ]);
                if(isset($modeluser)){
                    $modelcheque->cheque_by = $modeluser->user_id;
                } else {
                    $modelcheque->cheque_by = $usuarioid;
                    $modeluser = Trabajador::findOne([
                    'user_id' => $modelcheque->cheque_by
                    ]);
                }
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->cheque]);
        }

        return $this->render('entrega', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cheque model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cheque]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cheque model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cheque model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cheque the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cheque::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
