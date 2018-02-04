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
use app\models\Memosgestion;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use app\models\Historialsolicitudes;
use yii\data\ActiveDataProvider;


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
    
    public function actionGestiona($estatus1=null,$estatus2=null,$estatus3=null,$departamento=null,$unidad=null,$usuario=null,$verorpa=null, $vercheque =null, $vertelefono=null, $verunidad=null, $precarga=null)
    {
        $modelorigenmemo = new Origenmemo;
        $modelfinalmemo = new Finalmemo;
        $memosgestion = new Memosgestion;
        $modelorigenmemo->load(Yii::$app->request->post());
        $modelfinalmemo->load(Yii::$app->request->post());
        $memosgestion->load(Yii::$app->request->post());
        
        $searchModel = new \app\models\GestionSearchGestionalo();
        
        if ($precarga == 1){
                 /**  Carga de Las Personas del Memo   **/
                $modelorigenmemo->departamento = 1;
//                $modelorigenmemo->unidad = 2;
                $modelorigenmemo->usuario = 6;
                $modelfinalmemo->departamentofinal = 6;
                $modelfinalmemo->unidadfinal = 8;
                $modelfinalmemo->usuariofinal = 11;
                $modelfinalmemo->estatus1final = 1;
                $modelfinalmemo->estatus2final = 2;
              //  $modelfinalmemo->estatus3final = 62;
                
                /** Filtro los que tienen o estan en estatus de elaboración de Memo **/
              //   $dataProvider->query->andWhere(['estatus3_id'=>61]);
        }
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
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
            $modelfinalmemo = new Finalmemo;
            $memosgestion = new Memosgestion;
            $searchModel = new \app\models\GestionSearchGestionalo();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
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
        
    public function actionActualiza($id,$estatus1=null,$estatus2=null,$estatus3=null,$departamento=null,$unidad=null,$usuario=null,$verorpa=null, $vercheque =null, $vertelefono=null, $verunidad=null){
     
    $modelgestion = Gestion::findOne($id);
    
    $modelsolicitudes = Solicitudes::findOne($modelgestion->solicitud_id);
        
    $fechahoy = Yii::$app->formatter->asDate('now','php:Y-m-d');
        
    if ($consulta[0]['tiporif']==""){

    $query = \app\models\PresupuestosSearch::find()
            ->select(["conexionsigesp.req as documento", 'presupuestos.montoapr as montopre', 'empresa_institucion.nombrecompleto as nombre', "empresa_institucion.nrif as nrif", "empresa_institucion.rif AS rif", "presupuestos.beneficiario_id", "presupuestos.solicitud_id" ])
            ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
            ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
            ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
        ]);    
        
        $modelorigenmemo = new Origenmemo;
        $modelfinalmemo = new Finalmemo;
        $memosgestion = new Memosgestion;
        $modelorigenmemo->load(Yii::$app->request->post());
        $modelfinalmemo->load(Yii::$app->request->post());
        $memosgestion->load(Yii::$app->request->post());
        
        $searchModel = new \app\models\GestionSearchGestionalo();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
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
        ]);

    }

    }
}
