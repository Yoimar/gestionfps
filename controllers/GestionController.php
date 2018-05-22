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
use yii\filters\AccessControl;
use app\models\Origenmemo;
use app\models\Finalmemo;
use app\models\Memosgestion;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use app\models\Historialsolicitudes;
use yii\data\ActiveDataProvider;
use app\models\Presupuestos;
use app\models\Conexionsigesp;
use app\models\Spgdtcmp;
use app\models\Cxprdspg;
use app\models\Cxprd;
use app\models\Trabajador;
use app\models\Cxpdtsolicitudes;
use app\models\Cxpsolicitudes;
use app\models\Scbprogpago;
use app\models\Scbmovbcospg;
use app\models\Scbmovbco;
use app\models\Bitacoras;
use app\models\BitacorasSearch;
use app\models\Multiplessolicitudes;
use app\models\Cheque;
use app\models\Personas;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
     * Updates an existing Gestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateajax($id, $submit = false)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax
        && $model->load(Yii::$app->request->post())
        && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())){
            if ($model->save()) {
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'message' => '¡Éxito!',
                ];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('updateajax', [
            'model' => $model,
        ]);

    }

    public function actionUpdatepersona($id, $submit = false)
    {
        $model = Personas::findOne($id);
        $model->scenario= 'actualizargestion';

        if (Yii::$app->request->isAjax
        && $model->load(Yii::$app->request->post())
        && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())){
            if ($model->save()) {
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'message' => '¡Éxito!',
                ];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('//personas/updateajax', [
            'model' => $model,
        ]);

    }

    public function actionUpdatebitacora($id, $submit = false)
    {
        $model = new Bitacoras();

        $searchModelBitacoras = new BitacorasSearch();
        $dataProviderBitacoras = $searchModelBitacoras->search(Yii::$app->request->queryParams);
        $dataProviderBitacoras->query->andWhere(['solicitud_id'=>$id]);
        $dataProviderBitacoras->query->orderBy('id ASC');

        if (Yii::$app->request->isAjax
        && $model->load(Yii::$app->request->post())
        && $submit == false)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())){
            if ($model->save()) {
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'message' => '¡Éxito!',
                ];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('//bitacoras/actualizarbitacoraajax', [
            'model' => $model,
        ]);

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

    public function actionGestiona($estatus1=null,$estatus2=null,$estatus3=null,$departamento=null,$unidad=null,$usuario=null,$verorpa=null, $vercheque =null, $vertelefono=null, $verunidad=null, $precarga=null)
    {
        $modelorigenmemo = new Origenmemo;
        $modelfinalmemo = new Finalmemo;
        $memosgestion = new Memosgestion;
        $modelorigenmemo->load(Yii::$app->request->post());
        $modelfinalmemo->load(Yii::$app->request->post());
        $memosgestion->load(Yii::$app->request->post());

        $searchModel = new \app\models\GestionSearchGestionalo();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($precarga == 1){
                 /**  Carga de Las Personas del Memo   **/
                $modelorigenmemo->departamento = 1;
//                $modelorigenmemo->unidad = 2;
                $modelorigenmemo->usuario = 6;
                $modelfinalmemo->departamentofinal = 6;
                $modelfinalmemo->unidadfinal = 8;
                $modelfinalmemo->usuariofinal = 11;
                $modelfinalmemo->estatus1final = 1;
                $modelfinalmemo->estatus2final = 18;
                $modelfinalmemo->estatus3final = 62;

                /** Filtro los que tienen o estan en estatus de elaboración de Memo **/
                $dataProvider->query->andWhere(['estatus3_id'=>61]);
        }


         if($estatus1!=''){
                $dataProvider->query->andWhere(['estatus1_id'=>$estatus1]);
            }
            if($estatus2!=''){
                $dataProvider->query->andWhere(['estatus2_id'=>$estatus2]);
            }
            if($estatus3!=''){
                $dataProvider->query->andWhere(['estatus3_id'=>$estatus3]);
            }
            if($departamento!=''){
                $dataProvider->query->andWhere(['departamentos.id'=>$departamento]);
            }
            if($unidad!=''){
                $dataProvider->query->andWhere(['gestion.recepcion_id'=>$unidad]);
            }
            if($usuario!=''){
                $dataProvider->query->andWhere(['trabajador_id'=>$usuario]);
            }

        return $this->render('gestiona', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'modelorigenmemo' => $modelorigenmemo,
                'modelfinalmemo' => $modelfinalmemo,
                'memosgestion' => $memosgestion,
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'verorpa' => $verorpa,
                'vercheque' => $vercheque,
                'vertelefono' => $vertelefono,
                'verunidad' => $verunidad,
                'precarga' => $precarga,
        ]);

    }

    /**
     * Para realizar la Vista Parcial que me permitira filtrar los casos del Origen
     */

    public function actionCambioestatus() {

    $modelfinalmemo = new Finalmemo;
    $modelorigenmemo = new Origenmemo;
    $memosgestion = new Memosgestion;


    if ($modelorigenmemo->load(Yii::$app->request->post())&&$modelfinalmemo->load(Yii::$app->request->post())&&$memosgestion->load(Yii::$app->request->post())&&$modelfinalmemo->validate()) {

        $memosgestion->estatus3origen= $modelorigenmemo->estatus3;
        $memosgestion->estatus2origen= $modelorigenmemo->estatus2;
        $memosgestion->estatus1origen= $modelorigenmemo->estatus1;
        $memosgestion->dirorigen = $modelorigenmemo->departamento;
        $memosgestion->unidadorigen = $modelorigenmemo->unidad;
        $memosgestion->trabajadororigen = $modelorigenmemo->usuario;

        $memosgestion->estatus3final=$modelfinalmemo->estatus3final;
        $memosgestion->estatus2final=$modelfinalmemo->estatus2final;
        $memosgestion->estatus1final=$modelfinalmemo->estatus1final;
        $memosgestion->dirfinal = $modelfinalmemo->departamentofinal;
        $memosgestion->unidadfinal = $modelfinalmemo->unidadfinal;
        $memosgestion->trabajadorfinal =$modelfinalmemo->usuariofinal;

        $memosgestion->save();

        $selection=(array)Yii::$app->request->post('selection');

        foreach ($selection as $idgestion) {
        /* Guardo la Informacion en el Historial de Solicitudes*/
                    $modelhistorialsolicitudes = new Historialsolicitudes;
                    $modelhistorialsolicitudes->gestion_id=$idgestion;
                    $modelhistorialsolicitudes->estatus3_id = $memosgestion->estatus3final;
                    $modelhistorialsolicitudes->estatus2_id = $memosgestion->estatus2final;
                    $modelhistorialsolicitudes->estatus1_id = $memosgestion->estatus1final;
                    $modelhistorialsolicitudes->memogestion_id = $memosgestion->id;
                    $modelhistorialsolicitudes->save();


                    $modelgestion =  Gestion::findOne($idgestion);
                    $modelgestion->estatus3_id = $memosgestion->estatus3final;
                    $modelgestion->trabajador_id = $memosgestion->trabajadorfinal;
                    $modelgestion->recepcion_id = $memosgestion->unidadfinal;
                    $modelgestion->save();
        }

        return $this->redirect('memorandum?id='.$memosgestion->id);

//        return $this->render('memorandum', [
//            'dataProvider' => $dataProvider,
//            'memosgestion' => $memosgestion,
//        ]);

        } else {
        $searchModel = (array)Yii::$app->request->post('searchModel');
        $dataProvider = (array)Yii::$app->request->post('dataProvider');
        $modelorigenmemo->load(Yii::$app->request->post());
        $modelfinalmemo->load(Yii::$app->request->post());
        $memosgestion->load(Yii::$app->request->post());
        $estatus1 = Yii::$app->request->post('estatus1');
        $estatus2 = Yii::$app->request->post('estatus2');
        $estatus3 = Yii::$app->request->post('estatus3');
        $departamento = Yii::$app->request->post('departamento');
        $unidad = Yii::$app->request->post('unidad');
        $usuario = Yii::$app->request->post('usuario');
        $verorpa = Yii::$app->request->post('verorpa');
        $vercheque = Yii::$app->request->post('vercheque');
        $vertelefono = Yii::$app->request->post('vertelefono');
        $verunidad = Yii::$app->request->post('verunidad');
        $selection=(array)Yii::$app->request->post('selection');

        return $this->redirect(['gestiona',
                'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'modelorigenmemo' => $modelorigenmemo,
                'modelfinalmemo' => $modelfinalmemo,
                'memosgestion' => $memosgestion,
                'selection' => $selection,
                'verorpa' => $verorpa,
                'vercheque' => $vercheque,
                'vertelefono' => $vertelefono,
                'verunidad' => $verunidad
               ]);

        }

    }

    public function actionOrigenmemo()
    {
        $modelorigenmemo = new Origenmemo;

        if ($modelorigenmemo->load(Yii::$app->request->post())) {
            $searchModel = new \app\models\GestionSearchGestionalo();

            if($modelorigenmemo->estatus1!=''){
                $estatus1 = $modelorigenmemo->estatus1;
            } else { $estatus1 = "";}
            if($modelorigenmemo->estatus2!=''){
                $estatus2 = $modelorigenmemo->estatus2;
            } else { $estatus2 = "";}
            if($modelorigenmemo->estatus3!=''){
                $estatus3 = $modelorigenmemo->estatus3;
            } else { $estatus3 = "";}
            if($modelorigenmemo->departamento!=''){
                $departamento = $modelorigenmemo->departamento;
            } else { $departamento = "";}
            if($modelorigenmemo->unidad!=''){
                $unidad= $modelorigenmemo->unidad;
            } else { $unidad = "";}
            if($modelorigenmemo->usuario!=''){
                $usuario = $modelorigenmemo->usuario;
            } else { $usuario = "";}

            return $this->redirect(['gestiona',
                 'estatus1' => $estatus1,
                'estatus2' => $estatus2,
                'estatus3' => $estatus3,
                'departamento' => $departamento,
                'unidad' => $unidad,
                'usuario' => $usuario,
               ]);
        }

        return $this->render('origenmemo', [
                'modelorigenmemo' => $modelorigenmemo,
        ]);


    }

    public function actionMemorandum($id, $verorpa=null, $vercheque =null, $vertelefono=null, $verunidad=null){

        $modelimprime =  Memosgestion::findOne($id);

        $query = Gestion::find()
                ->select(['solicitudes.num_solicitud as num_solicitud',
                'gestion.id as id',
                'historial_solicitudes.memogestion_id',
                "estatus1.id as estatus1_id",
                "estatus2.id as estatus2_id",
                'gestion.estatus3_id',
                'gestion.trabajador_id',
                'gestion.recepcion_id',
                'departamentos.id as departamentos_id',
                "personabeneficiario.ci as cibeneficiario",
                "CONCAT(personabeneficiario.nombre || ' ' || personabeneficiario.apellido) AS beneficiario",
                'users.nombre as trabajadorsocial',
                'solicitudes.usuario_asignacion_id',
                'solicitudes.estatus',
                "to_char(solicitudes.created_at, 'DD/MM/YYYY') as fechaingreso",
                "TO_CHAR(gestion.updated_at, 'DD/MM/YYYY') as fechaultimamodificacion",
                "CONCAT(personabeneficiario.telefono_fijo || ' / ' || personabeneficiario.telefono_celular || ' / ' || personabeneficiario.telefono_otro) as telefono",
                "extract(YEAR FROM age(now(),personabeneficiario.fecha_nacimiento)) as edadbeneficiario",
                "string_agg(to_char(presupuestos.documento_id,'999999'), '  //  ') as iddoc",
                "string_agg(to_char(presupuestos.numop,'999999'), '  //  ') as orpa",
                "string_agg(CONCAT(empresa_institucion.rif || '-' || empresa_institucion.nrif), '  //  ') as rif",
                "string_agg(conexionsigesp.req, '  //  ') as requerimiento",
                "string_agg(empresa_institucion.nombrecompleto, '  //  ') as empresaoinstitucion",
                "count(presupuestos.cantidad) as cantidad",
                "string_agg(presupuestos.cheque, ' // ') as cheque",
                "sum(presupuestos.montoapr) as monto"]);

        $query->join('LEFT JOIN', 'solicitudes','gestion.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'users', 'solicitudes.usuario_asignacion_id = users.id')
                ->join('LEFT JOIN', 'presupuestos', 'presupuestos.solicitud_id = solicitudes.id')
                ->join('LEFT JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
                ->join('LEFT JOIN', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                ->join('LEFT JOIN', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                ->join('LEFT JOIN', 'personas as personabeneficiario', 'solicitudes.persona_beneficiario_id  = personabeneficiario.id')
                ->join('LEFT JOIN', 'empresa_institucion', 'presupuestos.beneficiario_id = empresa_institucion.id')
                ->join('LEFT JOIN', 'conexionsigesp', 'presupuestos.id = conexionsigesp.id_presupuesto')
                ->join('LEFT JOIN', 'recepciones', 'recepciones.id = gestion.recepcion_id')
                ->join('LEFT JOIN', 'departamentos', 'recepciones.departamentos_id = departamentos.id')
                ->join('LEFT JOIN', 'historial_solicitudes', 'historial_solicitudes.gestion_id = gestion.id')
                ->groupBy(['solicitudes.num_solicitud',
                    'gestion.id',
                    'historial_solicitudes.memogestion_id',
                    'estatus1.id',
                    'estatus2.id',
                    'gestion.estatus3_id',
                    'gestion.trabajador_id',
                    'gestion.recepcion_id',
                    'departamentos.id',
                    'cibeneficiario',
                    'beneficiario',
                    'trabajadorsocial',
                    'solicitudes.usuario_asignacion_id',
                    'solicitudes.estatus',
                    'fechaingreso',
                    'fechaultimamodificacion',
                    'telefono',
                    'edadbeneficiario']);
        $query->andFilterWhere([
            'historial_solicitudes.memogestion_id' => $modelimprime->id,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            ]);

        $usuarioorigen = isset($modelimprime->trabajadororigen) ? $modelimprime->trabajadororigennombre->dimprofesion. " ".$modelimprime->trabajadororigennombre->primernombre. " ".$modelimprime->trabajadororigennombre->primerapellido .'<br>' : "";
        $unidadorigen = isset($modelimprime->unidadorigen) ? $modelimprime->unidadorigennombre->nombre.'<br>' : "";
        $direccionorigen = isset($modelimprime->dirorigen) ? $modelimprime->dirorigennombre->nombre : "";
        $enviado = isset($modelimprime->trabajadororigen)&& isset($modelimprime->dirorigen) ? "Enviado por" : "";
        $usuariofinal = isset($modelimprime->trabajadorfinal) ? $modelimprime->trabajadorfinalnombre->dimprofesion. " ".$modelimprime->trabajadorfinalnombre->primernombre. " ".$modelimprime->trabajadorfinalnombre->primerapellido .'<br>' : "";

        $headerHtml = '<div class="row">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left"])
        .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "450", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"])
        .'</div>'
                .'<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px;">'
        .'    <tr>'
        .'     <td colspan="4" class="text-center col-xs-8 col-sm-8 col-md-8 col-lg-8" style="font-size:12px;">'
        .'     </td>'
        .'     <td colspan="2" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4" style="font-size:12px;">'
        .'Relación N° '.  $modelimprime->id  .'<br>  '
        . Yii::$app->formatter->asDate($modelimprime->fechamemo." 23:00",'php:d/m/Y').'<br>  '
        .'      </td>'
        .'      </tr>'
        .'        <tr>'
        .'         <td  colspan="6" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4 col-lg-offset-4" style="font-size:18px;">'
        .'          RELACIÓN DE CASOS'
        .'         </td >'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .$enviado
        .'            </td>'
        .'          <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        .$usuarioorigen
        .$unidadorigen
        .$direccionorigen
        .'         </td>'
        .'         <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'          <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .'         Recibido Por:'
        .'          </td>'
        .'          <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        . $usuariofinal
        . $modelimprime->unidadfinalnombre->nombre.'<br>'
        . $modelimprime->dirfinalnombre->nombre
        .'            </td>'
        .'             <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .'            Estatus:'
        .'            </td>'
        .'            <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        . $modelimprime->estatus3finalnombre->nombre
        .'            </td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .'            Asunto:'
        .'            </td>'
        .'            <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        .$modelimprime->asunto
        .'            </td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'             </tr>'
        .'</table>'
        .'</div>';

        $footerHtml = '<p style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></p>';
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('memorandum', [
                'dataProvider' => $dataProvider,
                'memosgestion' => $modelimprime,
            ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:7px}',
             // set mPDF properties on the fly
            'options' => ['title' => 'Punto de Cuenta '],
             // call mPDF methods on the fly
            'marginTop' => '90',

            'methods' => [
                'SetHTMLHeader'=>[$headerHtml, [ 'E', [TRUE]]],
                'SetHTMLFooter'=>[$footerHtml, [ 'E', [TRUE]]],
            ],

        ]);


            /*** Pie de Página Bonito
             * '<center>'
            .'<div class="row">'
            .'<table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px; text-align: center;">'
            .'<tr>'
            .'    <td>'
            .'        <strong>¡CHAVEZ VIVE, LA PATRIA SIGUE!</strong>'
            .'        <br>"Independencia y Patria Socialista" ¡Viviremos y Venceremos!'
            .'        <br> <strong>¡PRIMEROS EN EL SACRIFICIO! ¡ULTIMOS EN EL BENEFICIO!</strong>'
            .'    </td>'
            .'</tr>'
            .'</table>'
            .'</div>'
            .'<hr style="color: #000000; margin: 0px; padding: 0px;" size="1" />'
            .'<div class="row">'
            .'<table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:10px; text-align: center;">'
            .'<tr>'
            .'    <td>'
            .'            <strong>Avenida Urdaneta, Esquina de Boleros, Palacio de Miraflores, Edificio Administrativo</strong>'
            .'            <br>'
            .'            <strong>Piso 2, Fundación Pueblo Soberano, RIF G-2000-2056-3</strong>'
            .'            <br>'
            .'            <strong>Teléfono: 0212-8063573</strong>'
            .'     </td></tr>'
            .'</table>'
            .'</div></center>
             *
             * **/


            // return the pdf output as per the destination setting
            return $pdf->render();

        }

    public function actionActualiza($id, $estatus3=null, $verorpa=null, $vercheque =null, $vertelefono=null, $verunidad=null){

        $idparagestion = $this->reload($id);

        return $this->redirect('gestiona?estatus3='.$estatus3);

    }

    public function reload($id){

        $estatus3=61;

        $modelgestion = Gestion::findOne($id);

        $modelsolicitudes = Solicitudes::findOne($modelgestion->solicitud_id);

        $modelpresupuestos = Presupuestos::find()
                                ->where(['solicitud_id' => $modelsolicitudes->id])
                                ->all();

        if (empty($modelpresupuestos)) {
        Yii::$app->session->setFlash("warning", "El caso no posee presupuestos "
             . " por favor intente con otro caso");

        return $this->redirect('gestiona?estatus3='.$estatus3);

        }

        $fechahoy = Yii::$app->formatter->asDate('now','php:Y-m-d');
        $usuarioid = Yii::$app->user->id;


            /////*** DEFINO 10 ESTATUS PARA LOS ESTATUS DEL DOCUMENTO ES DECIR EL ESTATUS DE LA CONEXION A SIGESP ****////
    //** Registro el Foreach para la conexionsigesp en caso de que el caso tenga mas de un presupuesto **//
// Inicio del Foreach
foreach ($modelpresupuestos as $modelpresupuesto) {

        $modelconexionsigesp = Conexionsigesp::findOne(
            ['id_presupuesto' => $modelpresupuesto->id ]
            );

        if (empty($modelconexionsigesp)) {
        Yii::$app->session->setFlash("warning", "El caso no ha sido aprobado por SIGESP"
             . " este año");

        return $this->redirect('gestiona?estatus3='.$estatus3);

        }


$i = 0;
while ($i<11){

    switch($modelconexionsigesp->estatus_sigesp){
        // ESTATUS VACIO
        case '':
            $modelconexionsigesp->estatus_sigesp = 'ELA';
            $modelgestion->estatus3_id = 61;
            break 1; // Aquí salé del switch

        // ESTATUS ELA -> ELABORADO
        case 'ELA':
            //VERIFICO QUE EL ESTATUS ES DIFERENTE DE 61 (EN ELABORACIÓN DE MEMO)
            //reviso si el caso esta comprometido
            $modelcomprometido = Spgdtcmp::findOne(['comprobante' => $modelconexionsigesp->req]);
            if (isset($modelcomprometido)){
                $modelgestion->estatus3_id = 62;
                $modelconexionsigesp->estatus_sigesp = 'APR';
            }
            //salgo de los while ya que el caso no esta aprobado

            break 1; // Aquí salé del switch

        //ESTATUS APR -> APROBADO Y ENVIADO A ADMINISTRACIÓN
        case 'APR':
            //reviso si el caso esta comprometido
            $modelcomprometido = Spgdtcmp::findOne(['comprobante' => $modelconexionsigesp->req]);
            if (isset($modelcomprometido)){
                // Si esta comprometido
                $modelconexionsigesp->estatus_sigesp = 'COM';
                $modelconexionsigesp->date_compromiso = $modelcomprometido->fecha;
                $modelconexionsigesp->compromiso_by = $usuarioid;
                //Coloco el estatus de Procesado por Presupuesto que es 63
                $modelgestion->estatus3_id = 63;
            } elseif ($modelgestion->estatus3_id == 61) {
                // Verifico si por casualidad lo devolvieron a Elaboración de Memo
                $modelconexionsigesp->estatus_sigesp = 'ELA';

            } else {
                //salgo de los while ya que el caso no esta comprometido
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS COM -> EL CASO SE ENCUENTRA COMPROMETIDO
        case 'COM':
            //reviso si el caso esta recibido por orpa
            $modelrecibidoorpas = Cxprdspg::find()
                ->select([
                    'numrecdoc'
                ])
                ->where(['numdoccom' => $modelconexionsigesp->req])
                ->all();

            //reviso si esta comprometido
            $modelcomprometido = Spgdtcmp::findOne(['comprobante' => $modelconexionsigesp->req]);
            if (isset($modelrecibidoorpas)){

                foreach ($modelrecibidoorpas as $modelrecibidoorpa){

                $modeldocorpa = Cxprd::find()
                ->where([
                    'numrecdoc' => $modelrecibidoorpa->numrecdoc,
                    'estprodoc' => ['C', 'R', 'E'],
                    ])
                ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                ->one();

                // Si esta recibido en el modulo de Orpa y no esta anulado
                if (isset($modeldocorpa)) {
                    $modelconexionsigesp->numrecdoc = $modelrecibidoorpa->numrecdoc;
                    $modelconexionsigesp->date_regdocorpa = $modeldocorpa->fecemidoc;
                    $modeluser = Trabajador::findOne([
                        'usuario_sigesp' => $modeldocorpa->codusureg
                    ]);
                    if(isset($modeluser)){
                        $modelconexionsigesp->regdocorpa_by = $modeluser->user_id;
                    } else {
                        $modelconexionsigesp->regdocorpa_by = $usuarioid;
                    }
                    $modelconexionsigesp->estatus_sigesp = 'ROR';
                    //Coloco el estatus de Recibido en Orpa
                    $modelgestion->estatus3_id = 64;

                    }
                }
            } elseif (empty ($modelcomprometido)) {
                // Verifico si esta comprometido
                $modelconexionsigesp->estatus_sigesp = 'APR';
                //lo que lleno en COM
                $modelconexionsigesp->date_compromiso = '';
                $modelconexionsigesp->compromiso_by = '';

            } else {
                //salgo de los while ya que el caso no esta recibido por orpa
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS ROR -> EL CASO SE ENCUENTRA RECIBIDO POR ORPA
        case 'ROR':
            //reviso si el caso esta aprobado

            $modeldocorpa = Cxprd::find()
                ->where(['numrecdoc' => $modelconexionsigesp->numrecdoc])
                ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                ->one();


            if (isset($modeldocorpa)){
                // Si esta aprobada la orpa
                if ($modeldocorpa->estaprord == 1) {

                    $modelconexionsigesp->date_aprdocorpa = $modeldocorpa->fecaprord;
                    $modeluser = Trabajador::findOne(['usuario_sigesp' => $modeldocorpa->usuaprord]);
                    if(isset($modeluser)){
                        $modelconexionsigesp->aprdocorpa_by = $modeluser->user_id;
                    } else {
                        $modelconexionsigesp->aprdocorpa_by = $usuarioid;
                    }
                    $modelconexionsigesp->estatus_sigesp = 'AOR';
                    //Coloco el estatus de Recibido en Orpa
                    $modelgestion->estatus3_id = 64;

                }

            } elseif (empty($modeldocorpa)) {
                // Verifico si esta recibido en orpa
                $modelconexionsigesp->estatus_sigesp = 'COM';
                //lo que lleno en ROR
                $modelconexionsigesp->numrecdoc = '';
                $modelconexionsigesp->date_regdocorpa = '';
                $modelconexionsigesp->regdocorpa_by = '';

            } else {
                //salgo de los while ya que el caso no esta comprometido
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS AOR -> EL CASO SE ENCUENTRA APROBADA LA RECEPCION DEL DOCUMENTO EN ORPA
        case 'AOR':
            //reviso si el caso esta recibido en Solicitud de Pago
            $modeldtorpa = Cxpdtsolicitudes::find()
                ->where(['numrecdoc' => $modelconexionsigesp->numrecdoc])
                ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                ->one();
            // reviso si el caso esta aprobado en recepcion de documentos de la solicitud de pago
            $modeldocorpa = Cxprd::find()
                ->where(['numrecdoc' => $modelconexionsigesp->numrecdoc])
                ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                ->one();

            if (isset($modeldtorpa)){
                // Si esta aprobada la orpa
                $modelconexionsigesp->orpa = $modeldtorpa->numsol;
                $modelorpa = Cxpsolicitudes::findOne([
                    'numsol' => $modelconexionsigesp->orpa,
                ]);

                $modelconexionsigesp->date_orpa = $modelorpa->fecemisol;
                $modeluser = Trabajador::findOne(
                    ['usuario_sigesp' => $modelorpa->codusureg
                ]);
                if(isset($modeluser)){
                    $modelconexionsigesp->orpa_by = $modeluser->user_id;
                } else {
                    $modelconexionsigesp->orpa_by = $usuarioid;
                }
                $modelconexionsigesp->estatus_sigesp = 'ORR';
                //Coloco el estatus de Recibido en Orpa
                $modelgestion->estatus3_id = 64;

                //Guardo el Numero de Orpa en Presupuestos
                $modelpresupuesto->numop = ltrim(substr($modelconexionsigesp->orpa, -5),"0");
                $modelpresupuesto->save();

            } elseif ($modeldocorpa->estaprord==0) {
                // Verifico si esta recibido en orpa
                $modelconexionsigesp->estatus_sigesp = 'ROR';
                // lo que lleno en AOR
                $modelconexionsigesp->date_aprdocorpa = '';
                $modelconexionsigesp->aprdocorpa_by = '';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS ORR -> EL CASO SE ENCUENTRA EN RECEPCION DE LA SOLICITUD DE PAGO ORPA
        case 'ORR':
            //reviso si el caso esta aprobado en en Solicitud de Pago
            $modelorpa = Cxpsolicitudes::findOne([
                    'numsol' => $modelconexionsigesp->orpa,
            ]);
            if (isset($modelorpa)){
                if ($modelorpa->estaprosol == 1){
                    // el caso esta aprobado en orpa
                    $modelconexionsigesp->date_aprorpa = $modelorpa->fecaprosol;
                    $modeluser = Trabajador::findOne(
                        ['usuario_sigesp' => $modelorpa->usuaprosol
                    ]);
                    if(isset($modeluser)){
                        $modelconexionsigesp->aprorpa_by = $modeluser->user_id;
                    } else {
                        $modelconexionsigesp->aprorpa_by = $usuarioid;
                    }
                    $modelconexionsigesp->estatus_sigesp = 'ORP';
                    //Coloco el estatus de Procesado por Orpa
                    $modelgestion->estatus3_id = 69;
                }
            } elseif (empty($modelorpa)) {
                // Verifico si el modelo orpa existe
                $modelconexionsigesp->estatus_sigesp = 'AOR';

            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS ORP -> LA ORPA SE ENCUENTRA ELABORADA Y APROBADA
        case 'ORP':
            //reviso si el caso esta causado
            $modelcausado = Spgdtcmp::findOne(['comprobante' => $modelconexionsigesp->orpa]);
            //reviso si el caso esta aprobado en en Solicitud de Pago
            $modelorpa = Cxpsolicitudes::findOne([
                    'numsol' => $modelconexionsigesp->orpa,
            ]);
            if (isset($modelcausado)){
                // el caso esta causado
                $modelconexionsigesp->date_causado = $modelcausado->fecha;
                $modelconexionsigesp->causado_by = $usuarioid;
                $modelconexionsigesp->estatus_sigesp = 'CAU';
                //Coloco el estatus de Causado Por Contabilidad
                $modelgestion->estatus3_id = 65;

            } elseif ($modelorpa->estaprosol == 0) {
                // Verifico si esta recibido en orpa
                $modelconexionsigesp->estatus_sigesp = 'ORR';
                // lo que lleno en ORR
                $modelconexionsigesp->date_aprorpa = '';
                $modelconexionsigesp->aprorpa_by = '';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS CAU -> EL CASO SE ENCUENTRA CONTABILIZADO Y CAUSADO
        case 'CAU':
            //reviso si el caso esta dispuesto para la programacion del pago
            $modelprogpago = Scbprogpago::findOne(['numsol' => $modelconexionsigesp->orpa]);
            //reviso si la orpa tiene un causado
            $modelcausado = Spgdtcmp::findOne(['comprobante' => $modelconexionsigesp->orpa]);
            if (isset($modelprogpago)){
                // el caso esta aprobado en orpa
                $modelconexionsigesp->date_progpago = $modelprogpago->fecpropag;
                $modeluser = Trabajador::findOne([
                    'usuario_sigesp' => $modelprogpago->codusu
                ]);
                if(isset($modeluser)){
                    $modelconexionsigesp->progpago_by = $modeluser->user_id;
                } else {
                    $modelconexionsigesp->progpago_by = $usuarioid;
                }
                $modelconexionsigesp->estatus_sigesp = 'PGP';
                //Coloco el estatus de Programado el Pago
                $modelgestion->estatus3_id = 66;


            } elseif (empty($modelcausado)) {
                // Verifico si el modelo causado existe
                $modelconexionsigesp->estatus_sigesp = 'ORP';
                // lo que lleno en CAU
                $modelconexionsigesp->date_causado = '';
                $modelconexionsigesp->causado_by = '';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS PGP -> EL CASO SE ENCUENTRA EN PROGRAMACION DE PAGO
        case 'PGP':
            //reviso si el caso tiene impreso un cheque
            $modelimprcheques = Scbmovbcospg::find()
                ->where([
                'documento' => $modelconexionsigesp->orpa,
                'estmov' => ['N','C','O']
                ])
                ->all();
            //reviso si la orpa tiene programado un pago
            $modelprogpago = Scbprogpago::findOne(['numsol' => $modelconexionsigesp->orpa]);

            if (isset($modelimprcheques)){
                // el caso tiene un cheque
                foreach ($modelimprcheques as $modelimprcheque){

                    $modelgestioncheque = Cheque::findOne(['cheque' => $modelimprcheque->numdoc]);
                    if(empty($modelgestioncheque)){
                        $modelgestioncheque = new Cheque;
                        $modelgestioncheque->cheque = $modelimprcheque->numdoc;
                        $modelgestioncheque->id_presupuesto = $modelconexionsigesp->id_presupuesto;
                        if ($modelimprcheque->estmov === 'O') {
                            $modelgestioncheque->estatus_cheque = 'ANU';
                        }else{
                        $modelgestioncheque->estatus_cheque = 'EMI';
                        }
                        $modelgestioncheque->save();
                    }

                $modelscbcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['N','C','O']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();

                $modelgestioncheque->date_cheque = $modelscbcheque->fecmov;
                $modelconexionsigesp->estatus_sigesp = 'CHE';
                //Coloco el estatus de Cheque Impreso
                $modelgestion->estatus3_id = 67;
                $modelgestioncheque->save();

                $fechabitacora = Yii::$app->formatter
                                 ->asDate($modelgestioncheque->date_cheque,'php:d/m/Y');
                $modeluser = Trabajador::findOne([
                    'usuario_sigesp' => $modelscbcheque->codusu
                ]);
                if(isset($modeluser)){
                    $modelgestioncheque->cheque_by = $modeluser->user_id;
                } else {
                    $modelgestioncheque->cheque_by = $usuarioid;
                    $modeluser = Trabajador::findOne([
                    'user_id' => $modelgestioncheque->cheque_by
                    ]);
                }

                //*** Llenado de Tablas de SASYC solicitudes, presupuestos y Bitacoras ***//
                if ($modelgestioncheque->estatus_cheque == 'EMI'){
                $modelsolicitudes->estatus = 'APR';
                $modelpresupuesto->estatus_doc = 'CHE';
                $modelpresupuesto->cheque = ltrim(substr($modelgestioncheque->cheque, -15),"0");
                $modelpresupuesto->numop = ltrim(substr($modelconexionsigesp->orpa, -9),"0");

                $modelbitacora = new Bitacoras;
                $modelbitacora->solicitud_id = $modelsolicitudes->id;
                $modelbitacora->fecha = $modelgestioncheque->date_cheque;
                $modelbitacora->nota = "El trabajador ".$modeluser->Trabajadorfps. " ha impreso "
                    ."satisfactoriamente el cheque con el número: "
                    .$modelpresupuesto->cheque . " el día "
                    .$fechabitacora;
                $modelbitacora->usuario_id = $modeluser->users_id;
                $modelbitacora->ind_activo = 1;
                $modelbitacora->ind_alarma = 0;
                $modelbitacora->ind_atendida = 0;
                $modelbitacora->version = 0;
                $modelbitacora->created_at = date('Y-m-d H:i:s');
                $modelbitacora->updated_at = date('Y-m-d H:i:s');
                $modelbitacora->save();
                $modelsolicitudes->save();
                $modelpresupuesto->save();
                $modelgestioncheque->save();

                }

                }

            } elseif (empty($modelprogpago)) {
                // Verifico si el modelo de programacion de pago existe
                $modelconexionsigesp->estatus_sigesp = 'CAU';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS CHE -> EL CASO SE ENCUENTRA ELABORADO EL CHEQUE
        case 'CHE':
            //reviso si el modelo del cheque para verificar si esta anulado
            $modelgestioncheque = Cheque::findOne([
                'id_presupuesto' => $modelconexionsigesp->id_presupuesto,
                'estatus_cheque' => ['EMI','PEN','ENT'],
            ]);

            //Coloco el estatus de Cheque Impreso
            if ($modelgestion->estatus3_id != 67 || $modelgestion->estatus3_id != 70 || $modelgestion->estatus3_id != 71){
                $modelgestion->estatus3_id = 67;
                $modelgestion->save();
            }

            if (isset($modelgestioncheque)){
            $modelcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['N','C','O']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();

            }

            //reviso el estatus del cheque es en caja
            if (isset($modelgestioncheque)&&isset($modelcheque)&&$modelcheque->estcondoc==='C'){
                $modelgestioncheque->date_enviofirma = $modelcheque->fecenvfir;
                $modelgestioncheque->date_enviocaja = $modelcheque->fecenvcaj;
                $modelconexionsigesp->estatus_sigesp = 'CHC';
                //Coloco el estatus de Cheque Enviado en Caja
                $modelgestion->estatus3_id = 71;
                $modelgestioncheque->save();
                break 2;
            }

            //reviso el estatus del cheque es entregado y lo coloco en caja
            if (isset($modelgestioncheque)&&isset($modelcheque)&&$modelcheque->estcondoc==='E'){
                $modelconexionsigesp->estatus_sigesp = 'CHC';
                break 1;
            }

            //reviso si el estatus es para la firma
            if (isset($modelgestioncheque)&&isset($modelcheque)&&$modelcheque->estcondoc=='F'){
                // el caso tiene un cheque
                $modelgestioncheque->date_enviofirma = $modelcheque->fecenvfir;
                $modelconexionsigesp->estatus_sigesp = 'CHF';
                //Coloco el estatus de Cheque Enviado a la Firma
                $modelgestion->estatus3_id = 70;

            } elseif (empty($modelcheque)&&isset ($modelgestioncheque)) {

                $modelanulado = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['A','O']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();


                //reviso el estatus del cheque es entregado y lo coloco en caja
                if (isset($modelanulado)){
                    $modelconexionsigesp->estatus_sigesp = 'ANU';
                    $modelgestioncheque->estatus_cheque = 'ANU';
                    break 1;
                }

                // Verifico si el cheque existe
                $modelconexionsigesp->estatus_sigesp = 'PGP';
                // lo que lleno en CHE

            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS CHF -> EL CASO SE ENCUENTRA ENVIADO PARA LA FIRMA
        case 'CHF':

            $modelgestioncheque = Cheque::findOne([
                'id_presupuesto' => $modelconexionsigesp->id_presupuesto,
                'estatus_cheque' => ['EMI','PEN','ENT']
            ]);
            //reviso si el modelo del cheque para verificar si esta anulado
            $modelcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['N','C']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();
            //reviso el estatus del cheque

            if (isset($modelcheque)&&$modelcheque->estcondoc=='C'){
                // el caso tiene un cheque
                $modelconexionsigesp->date_enviofirma = $modelcheque->fecenvfir;
                $modelconexionsigesp->date_enviocaja = $modelcheque->fecenvcaj;
                $modelconexionsigesp->estatus_sigesp = 'CHC';
                //Coloco el estatus de Cheque Enviado a Caja
                $modelgestion->estatus3_id = 71;

            } elseif (isset($modelcheque)&&$modelcheque->estcondoc=='S') {
                // Verifico si el cheque existe
                $modelconexionsigesp->estatus_sigesp = 'CHE';
                // lo que lleno en CHF
                $modelconexionsigesp->date_enviofirma = '';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS CHF -> EL CASO SE ENCUENTRA ENVIADO A CAJA PARA ENTREGAR
        case 'CHC':
            //reviso si el modelo del cheque para verificar si esta anulado
            $modelgestioncheque = Cheque::findOne([
                'id_presupuesto' => $modelconexionsigesp->id_presupuesto,
                'estatus_cheque' => ['EMI','PEN','ENT']
            ]);

            $modelcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['N','C']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();
            //reviso si la orpa tiene programado un pago

            if (isset($modelcheque)&&$modelcheque->estcondoc=='E'){
                // el caso tiene un cheque
                $modelgestioncheque->date_enviofirma = $modelcheque->fecenvfir;
                $modelgestioncheque->date_enviocaja = $modelcheque->fecenvcaj;
                $modelgestioncheque->date_entregado = $modelcheque->emichefec;
                //el caso esta entregado
                $modelconexionsigesp->estatus_sigesp = 'ENT';
                //Coloco el estatus de Cheque Enviado a Caja
                $modelgestion->estatus3_id = 79;
                $modelgestioncheque->estatus_cheque = 'ENT';
                $modelgestioncheque->save();

            } elseif (isset($modelcheque)&&$modelcheque->estcondoc=='F') {
                // Verifico si el cheque existe
                $modelconexionsigesp->estatus_sigesp = 'CHF';
                // lo que lleno en CHC
                $modelconexionsigesp->date_enviocaja = '';
            } else {
                //salgo de los while ya que el caso no esta co
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS ENT -> EL CASO SE ENCUENTRA ENTREGADO
        case 'ENT':
            //reviso si el modelo del cheque para verificar si esta ENTREGADO
            $modelgestioncheque = Cheque::findOne([
                'id_presupuesto' => $modelconexionsigesp->id_presupuesto,
                'estatus_cheque' => ['EMI','PEN','ENT']
            ]);

            $modelcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();

            if (isset($modelcheque)&&($modelcheque->estmov=='A'||$modelcheque->estmov=='O')){

                //el caso esta anulado
                $modelconexionsigesp->estatus_sigesp = 'ANU';

            } else {
                //salgo de los while ya que el caso no esta anulado
                break 2;
            }
            break 1; // Aquí salé del switch

//////////ESTATUS ANU -> EL CASO SE ENCUENTRA ANULADO
        case 'ANU':
            //reviso el modelo del cheque para verificar que esta ANULADO
            $modelgestioncheque = Cheque::findOne([
                'id_presupuesto' => $modelconexionsigesp->id_presupuesto,
                'estatus_cheque' => ['EMI','PEN','ENT','ANU']
            ]);

            $modelcheque = Scbmovbco::find()
                    ->where([
                    'numdoc' => $modelgestioncheque->cheque,
                    'codope' => 'CH',
                    'estmov' => ['A','O']
                    ])
                    ->andFilterWhere(['like', 'ced_bene', $modelconexionsigesp->rif])
                    ->one();

            if (isset($modelcheque)) {
                    $modelgestioncheque->date_anulado = $modelcheque->fechaanula;
                    $modelgestioncheque->motivo_anulado = $modelcheque->conanu;
                    $modelgestioncheque->anulado_by = $usuarioid;
                    $modelgestioncheque->save();

            } else {
                //reviso si el caso tiene impreso un cheque
                $modelimprcheque = Scbmovbcospg::findOne([
                    'documento' => $modelconexionsigesp->orpa,
                    'estmov' => ['N','C']
                ]);

                if ($modelconexionsigesp->cheque != $modelimprcheque->numdoc)
                {
                    $modelconexionsigesp->estatus_sigesp = 'PGP';
                }

                //salgo de los while ya que el caso no esta anulado
                break 2;
            }
            break 1; // Aquí salé del switch

        default:
            break;
    }
    ++$i;
    $modelgestion->save();
    $modelconexionsigesp->save();
}

//Fin del Foreach
}
    return $id;
    }

   public function actionMasivo()
   {
      $model = new Multiplessolicitudes;

      if ($model->load(Yii::$app->request->post())&&$model->validate()) {
        foreach ($model->caso as $idsolicitud) {

            $int = (int)$idsolicitud;
            $prueba[]= $int;

            $this->Cambiorapido($int, $model->estatus3, $model->actividad);
        }

        Yii::$app->session->setFlash("warning", "Los casos con el id ".implode (', ',  $prueba)." fueron cambiados exitosamente");

      }

      return $this->render('masivo', [
              'model' => $model,
      ]);

   }

   public function actionNumsolicitudxtrabajador($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $usuarioid = Yii::$app->user->id;
        $modeltrabajador = Trabajador::findOne([ 'user_id' => $usuarioid ]);
        if (!is_null($q)) {
            $query = new Query;
            $query->addSelect(["id", "num_solicitud as text"])
                    ->from('solicitudes')
                    ->where([ 'usuario_asignacion_id' => $modeltrabajador->users_id,
                        'estatus' => ['ACA', 'EAA', 'DEV'],])
                    ->andFilterWhere(['like', "num_solicitud", $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Solicitudes::find($id)->num_solicitud];
        }

        return $out;
    }

    public function actionMasivoxtrabajador()
   {
      $model = new Multiplessolicitudes;

      $usuarioid = Yii::$app->user->id;
      $modeltrabajador = Trabajador::findOne([
          'user_id' => $usuarioid
      ]);

      if (empty($modeltrabajador) || empty($modeltrabajador->users_id)){
          Yii::$app->session->setFlash("warning", "Por Favor coloque la opción 'Ir a perfil' y cargue su usuario de SASYC para poder ver las solicitudes asignadas");

            return $this->render('masivoxtrabajador', [ 'model' => $model ]);

      }

      if ($model->load(Yii::$app->request->post())&&$model->validate()) {
        foreach ($model->caso as $idsolicitud) {

            $int = (int)$idsolicitud;
            $prueba[]= $int;

        $this->Cambiorapido($int, $model->estatus3, $model->actividad);

        //Fin del foreach
        }
            $solicitudes = implode($prueba, ",");
            return $this->redirect([
                'masivosuccess',
                'solicitudes_id' => $solicitudes
            ]);
        }

      return $this->render('masivoxtrabajador', [ 'model' => $model, ]);

   }

   public function actionMasivosuccess($solicitudes_id){

       $array = explode(",", $solicitudes_id);

       $searchModel = new GestionSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $dataProvider->query->andFilterWhere(['in','gestion.solicitud_id',$array]);

       return $this->render('masivosuccess', [
           'dataProvider' => $dataProvider,
       ]);

   }

   public function Cambiorapido ($solicitudid, $estatus3id=null, $actividad=null){

       $modelgestion = Gestion::findOne(['solicitud_id' => $solicitudid ]);

       if (empty($modelgestion)) {
         $modelgestion = new Gestion;
         $modelgestion->solicitud_id = $solicitudid;
       }
       if ($estatus3id != null) {
           $modelgestion->estatus3_id = $estatus3id;
       }
       if ($actividad != null) {
          $modelgestion->programaevento_id = (int)$actividad;
       }

       $modelgestion->save();

       return true;
   }

   public function Actualizarporestatusnivel2($estatus2){

       $modelconnivel2 = Gestion::find()
       ->select([
           'gestion.id as id',
           'estatus2.id as estatus2_id'
       ])
       ->join('LEFT JOIN', 'estatus3', 'gestion.estatus3_id = estatus3.id')
       ->join('LEFT JOIN', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
       ->andFilterWhere([
            'estatus2_id' => $estatus2,
       ])
       ->all();

       foreach ($modelconnivel2 as $model){

           GestionController::reload($model->id);

       }

       return true;

       }


}
