<?php

namespace app\controllers;

use Yii;
use app\models\Empresainstitucion;
use app\models\EmpresainstitucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Conexionsigesp;
use app\models\Sepsolicitud;

/**
 * EmpresainstitucionController implements the CRUD actions for Empresainstitucion model.
 */
class EmpresainstitucionController extends Controller
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
     * Lists all Empresainstitucion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresainstitucionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empresainstitucion model.
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
     * Creates a new Empresainstitucion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresainstitucion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Empresainstitucion model.
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

    public function actionUpdates($id,$volver,$idpresupuesto)
    {
        $model = $this->findModel($id);

        $modelconexionsigesp = Conexionsigesp::findOne([
            'id_presupuesto' => $idpresupuesto
        ]);
        // Para verificar si el caso, posee una conexion con SIGESP y necesita cambiar el caso
        if (isset($modelconexionsigesp)){
        $modelsepsolicitud = Sepsolicitud::findOne([
            'numsol' => $modelconexionsigesp->req,
            'ced_bene' => $modelconexionsigesp->rif
        ]);

        if ($modelsepsolicitud->estsol == 'C'){
             Yii::$app->session->setFlash("warning", "El caso ya esta PROCESADO<br> "
                            . "Para reparar la solicitud POR FAVOR<br> "
                            . "ay que devolverlo del sistema"
                            . "ADMINISTRATIVO SIGESP <br>"
                            . "Si el caso ya posee un CHEQUE <br> "
                            . "DEBE ser INGRESADO nuevamente");
                    return $this->redirect(['sepsolicitud/muestra', 'numero' => $volver]);
        }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['sepsolicitud/muestra', 'numero' => $volver]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Empresainstitucion model.
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
     * Finds the Empresainstitucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresainstitucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresainstitucion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
