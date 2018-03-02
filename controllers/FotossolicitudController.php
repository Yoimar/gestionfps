<?php

namespace app\controllers;

use Yii;
use app\models\Fotossolicitud;
use app\models\FotossolicitudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * FotossolicitudController implements the CRUD actions for Fotossolicitud model.
 */
class FotossolicitudController extends Controller
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
     * Lists all Fotossolicitud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FotossolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fotossolicitud model.
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
     * Creates a new Fotossolicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fotossolicitud();

        if ($model->load(Yii::$app->request->post())) {
            // Obtener la Imagen de la Foto y se instancia en un objeto para manipularlo
            // la siguiente data retorna un array
            $imagen = UploadedFile::getInstances($model, 'imagen');
            $model->ind_reporte = false;
            $model->created_at = Yii::$app->formatter->asDate('now','php:Y-m-d H:i:s');
            $model->updated_at = Yii::$app->formatter->asDate('now','php:Y-m-d H:i:s');

            foreach ($imagen as $file) {

            //creo la direccion para guardar la imagen que se llama adjuntos
            $path = Yii::getAlias('@app').'/web/img/adjuntos'.'/'.$file->baseName. '.' .$file->extension;

            $model->foto = $file->name;


            //Guardar dos de acuerdo al numero de imagenes
                $modelparaguardar = new Fotossolicitud();

                $modelparaguardar->solicitud_id = $model->solicitud_id;
                $modelparaguardar->descripcion = $model->descripcion;
                $modelparaguardar->foto = $model->foto;
                $modelparaguardar->ind_reporte = $model->ind_reporte;
                $modelparaguardar->created_at = $model->created_at;
                $modelparaguardar->updated_at = $model->updated_at;
                $modelparaguardar->save();

            //Guardo cada Imagen
            $file->saveAs($path);


            //Fin del Foreach
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fotossolicitud model.
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
     * Deletes an existing Fotossolicitud model.
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
     * Finds the Fotossolicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fotossolicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fotossolicitud::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
