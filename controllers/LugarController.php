<?php

namespace app\controllers;

use Yii;
use app\models\Lugar;
use app\models\LugarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LugarController implements the CRUD actions for Lugar model.
 */
class LugarController extends Controller
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
     * Lists all Lugar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LugarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lugar model.
     * @param integer $id
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
     * Creates a new Lugar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lugar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lugar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lugar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lugar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lugar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lugar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
        * Para hacer vistas Por Geolocalizacion
        * Es decir, guardar la ip que tengo por la geolocalizacion
        *
    **/

    public function actionCreargeo()
    {
        $model = new Lugar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                   return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('creargeo', [
                   'model' => $model,
        ]);
    }

    public function actionMapasearch()
    {
        return $this->render('mapasearch');
    }

    public function actionCreatereportes()
    {
        $model = new Lugar();

        if ($model->load(Yii::$app->request->post())) {
            switch ($model->tipo_reporte) {
                case 1:
                    return $this->render('graficobarras');
                    break;
                case 2:
                    $data = Lugar::find()
                    ->select([
                        "nombre as name",
                        "lat",
                        "lng as lon",
                        ])
                    ->asArray()->all();
                    return $this->render('maphc', [
                        'data' => $data,
                    ]);
                    break;
                case 3:
                    return $this->render('mapam');
                    break;
                case 4:
                    return $this->render('mapgm');
                    break;
                default:
                    # code...
                    break;
            }

        }

        return $this->render('createreportes', [
                   'model' => $model,
        ]);
    }
}
