<?php

namespace app\controllers;

use Yii;
use app\models\Solicitudes;
use app\models\SolicitudesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Personas;
use yii\db\Query;
use yii\db\ActiveQuery;
use app\models\Sepingreso;
use app\models\Bitacoras;
use app\models\Users;
use app\models\Trabajador;

/**
 * SolicitudesController implements the CRUD actions for Solicitudes model.
 */
class SolicitudesController extends Controller
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
     * Lists all Solicitudes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Solicitudes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionModificar($id, $referencia=null)
    {

        return $this->render('modificar', [
            'model' => $this->findModel($id),
            'referencia' => $referencia,
        ]);
    }

    /**
     * Creates a new Solicitudes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Solicitudes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Solicitudes model.
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

    public function actionCambiotrabajador($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                $trabajadorid = Yii::$app->user->id;
                $modeluser = Trabajador::findOne([
                    'user_id' => $trabajadorid,
                ]);
                $modelusers = Users::findOne([
                    'id' => $model->usuario_asignacion_id,
                ]);

                $modelbitacora = new Bitacoras;
                $modelbitacora->solicitud_id = $model->id;
                $modelbitacora->fecha = date('Y-m-d');
                $modelbitacora->nota = "A traves del Sistema Gestión se realizó el cambio de trabajador social a "
                    .$modelusers->nombre
                    ." el día "
                    . date('d/m/Y')
                    . " a las "
                    . date('h:i a')
                    . " Cambio realizado por el trabajador:"
                    . $modeluser->Trabajadorfps;
                $modelbitacora->usuario_id = $modeluser->users_id;
                $modelbitacora->ind_activo = 1;
                $modelbitacora->ind_alarma = 0;
                $modelbitacora->ind_atendida = 0;
                $modelbitacora->version = 0;
                $modelbitacora->created_at = date('Y-m-d H:i:s');
                $modelbitacora->updated_at = date('Y-m-d H:i:s');
                $modelbitacora->save();

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('cambiotrabajador', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Solicitudes model.
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
     * Finds the Solicitudes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Solicitudes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Solicitudes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionListapersonas($q = null, $id = null) {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new Query;
        $query->addSelect(["id", "concat('C.I.: ',ci,' // ', nombre,' ',apellido) as text"])
            ->from('personas')
            ->andFilterWhere(['like', "concat(ci,' ',nombre,' ',apellido)", $q])
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => Personas::find($id)->nombre];
    }
    return $out;
    }

    public function actionTab1($id, $referencia=null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('modificar', ['model' => $model, 'referencia' => 2]);
        } else {
            return $this->render('tab1', [
                'model' => $model,
            ]);
        }
    }
}
