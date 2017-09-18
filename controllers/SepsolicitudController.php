<?php

namespace app\controllers;

use Yii;
use app\models\Sepsolicitud;
use app\models\SepsolicitudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    protected function findModel($codemp, $numsol)
    {
        if (($model = Sepsolicitud::findOne(['codemp' => $codemp, 'numsol' => $numsol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
