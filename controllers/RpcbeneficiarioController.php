<?php

namespace app\controllers;

use Yii;
use app\models\Rpcbeneficiario;
use app\models\RpcbeneficiarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RpcbeneficiarioController implements the CRUD actions for Rpcbeneficiario model.
 */
class RpcbeneficiarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rpcbeneficiario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RpcbeneficiarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rpcbeneficiario model.
     * @param string $codemp
     * @param string $ced_bene
     * @return mixed
     */
    public function actionView($codemp, $ced_bene)
    {
        return $this->render('view', [
            'model' => $this->findModel($codemp, $ced_bene),
        ]);
    }

    /**
     * Creates a new Rpcbeneficiario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rpcbeneficiario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'ced_bene' => $model->ced_bene]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rpcbeneficiario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $codemp
     * @param string $ced_bene
     * @return mixed
     */
    public function actionUpdate($codemp, $ced_bene)
    {
        $model = $this->findModel($codemp, $ced_bene);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'ced_bene' => $model->ced_bene]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rpcbeneficiario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $codemp
     * @param string $ced_bene
     * @return mixed
     */
    public function actionDelete($codemp, $ced_bene)
    {
        $this->findModel($codemp, $ced_bene)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rpcbeneficiario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $codemp
     * @param string $ced_bene
     * @return Rpcbeneficiario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codemp, $ced_bene)
    {
        if (($model = Rpcbeneficiario::findOne(['codemp' => $codemp, 'ced_bene' => $ced_bene])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
