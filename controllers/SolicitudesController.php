<?php

namespace app\controllers;

use Yii;
use app\models\Solicitudes;
use app\models\SolicitudesSearch;
use app\models\PresupuestosSearch;
use app\models\BitacorasSearch;
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
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;
use yii\helpers\Html;

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
            ->andFilterWhere(['ilike', "concat(ci,' ',nombre,' ',apellido)", $q])
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

    public function actionImprimirpunto($id){

        $id = (int)$id;

            $query = \app\models\PresupuestosSearch::find()
                    ->select(["conexionsigesp.req  as documento", 'presupuestos.montoapr as montopre', 'empresa_institucion.nombrecompleto as nombre', "CONCAT(empresa_institucion.rif || '-' || empresa_institucion.nrif) as rif" ])
                    ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                    ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                    ->andFilterWhere(['presupuestos.solicitud_id' => $id]);

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

            $consulta = Yii::$app->db->createCommand(
            "SELECT CONCAT('Caso N: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT(ps.nombre || ' ' || ps.apellido) AS solicitante, "
            ."ps.ci AS cisolicitante, "
            ."CONCAT(pb.nombre || ' ' || pb.apellido) AS beneficiario, "
            ."pb.ci AS cibeneficiario, "
            ."r1.nombre AS requerimiento, "
            ."CONCAT('Unidad de ' || r2.nombre) AS unidad, "
            ."ta.nombre AS tipoayuda, "
            ."CONCAT('Area: ' || a1.nombre) AS area, "
            ."s1.necesidad AS necesidad, "
            ."s1.descripcion AS descripcion, "
            ."pr1.montoapr as monto, "
            ."ei1.nombrecompleto AS casacomercial, "
            ."ei1.nrif AS rif, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."s1.num_proc as puntomemo, "
            ."s1.num_solicitud as ndonacion ,"
            ."s1.ind_mismo_benef,"
            ."s1.ind_beneficiario_menor,"
            ."pb.tipo_nacionalidad_id as tiponacbenef,"
            ."ps.tipo_nacionalidad_id as tiponacsolic,"
            ."s1.observaciones,"
            ."extract(YEAR FROM age(now(),pb.fecha_nacimiento)) as edadbeneficiario,"
            ."extract(YEAR FROM age(now(),ps.fecha_nacimiento)) as edadsolicitante,"
            ."CONCAT('Telefonos: ' || COALESCE(pb.telefono_otro || ' ', '') || COALESCE(pb.telefono_fijo || ' ', '') || COALESCE(pb.telefono_celular || ' ', '') ) as telefonos "
            ."FROM solicitudes s1 FULL OUTER JOIN presupuestos pr1 ON pr1.solicitud_id=s1.id "
            ."JOIN personas pb ON s1.persona_beneficiario_id=pb.id "
            ."JOIN personas ps ON s1.persona_solicitante_id=ps.id "
            ."JOIN areas a1 ON a1.id=s1.area_id "
            ."JOIN tipo_ayudas ta ON a1.tipo_ayuda_id= ta.id "
            ."JOIN requerimientos r1 ON pr1.requerimiento_id=r1.id "
            ."JOIN recepciones r2 ON s1.recepcion_id=r2.id "
            ."JOIN empresa_institucion ei1 ON pr1.beneficiario_id = ei1.id "
            ."WHERE pr1.solicitud_id = ".$id)->queryAll();

            if(empty($consulta)){
                Yii::$app->session->setFlash("warning", "El caso no posee punto "
                     . " por favor intente con otro caso");

                return $this->redirect("@web/sepsolicitud/muestra?numero=".$id);

            }

            $montototal = Yii::$app->db->createCommand("SELECT SUM(monto)FROM presupuestos where solicitud_id = ".$id)->queryScalar();
            $montototalenletras = strtoupper(SepsolicitudController::Valorenletras($montototal, 'Bolivares'));
            $montoapr = Yii::$app->db->createCommand("SELECT SUM(montoapr)FROM presupuestos where solicitud_id = ".$id)->queryScalar();
            $montoaprenletras = strtoupper(SepsolicitudController::Valorenletras($montoapr, 'Bolivares'));


        $headerHtml = '<div class="row">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "80", "class" => "pull-left"])
        .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "350", "class" => "pull-right"])
        .'</div> '
        .'<div class="row"><table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; "> '
        .'<tr style="border: solid 2px black;"><td rowspan="2" class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3" style="font-size:14px;">'.$consulta[0]['solicitud']
        .'</td><td rowspan="2" class="text-center col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border: solid 2px black; font-size:18px;"><strong>PUNTO DE CUENTA</strong> '
        .'</td><td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center" style="font-size:12px;"><strong>1- N# de página: </strong>{PAGENO}/{nb}</td></tr><tr> '
        .'<td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center" style="border: solid 2px black; font-size:12px;"><strong>2. Fecha: </strong>'.Yii::$app->formatter->asDate($consulta[0]['fecha'],'php:d-m-Y')
        .'</td></tr><tr> '
        .'<td rowspan="4" class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3"><strong>3- Presentado:</strong></td> '
        .'<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;"> '
        .'A- AL: My. José Holberg Zambrano Gonzalez<br>Presidente de la Fundación Pueblo Soberano '
        .'</td><td rowspan="4" class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3"><strong>4- PTO N#</strong> '
        .'<br> FPS-'.$consulta[0]['puntomemo']
        .'</td></tr><tr><td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;"> '
        .'B- AL: Cap. Rafael Ramón Tesorero Rodríguez<br>Coordinador General de la Fundación Pueblo Soberano '
        .'</td></tr><tr><td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;"> '
        .'C- POR: '.$consulta[0]['unidad'].' de la Dirección de Bienestar Social de la Fundación Pueblo Soberano '
        .'</td></tr><tr><td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;"> '
        .'D- POR: 1erTte. Miguel Silveiro Castillo Pérez<br>Administrador de la Fundación Pueblo Soberano '
        .'</td></tr></table></div>';

                $footerHtml = '<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px;">'
        .'<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>6- Presentado por: Dirección de Bienestar Social</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>7- Revisado por: Unidad de Presupuesto</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>8- Aprobado por: Unidad de Contabilidad</strong></td></tr><tr>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td></tr><tr>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td></tr>'
        .'<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>9- Aprobado por: Director de Administración y Finanzas</strong>'
        .'</td><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>10- Revisado por: Coordinador General</strong>'
        .'</td><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px; background:#d8d8d8;">'
        .'<strong>11- Aprobado por: Presidente</strong></td></tr><tr>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="border: solid 2px black; margin: 0px; padding: 0px; font-size:12px;">'
        .'<br><br>________________________________<br>Firma</td></tr><tr>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td>'
        .'<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 0px; font-size:12px;">'
        .'<strong>Fecha:</strong></td></tr></table></div> <p style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></p>';

    // get your HTML raw content without any layouts or scripts
    $content = $this->renderPartial('imprimirpunto', [
//            'searchModel' => $searchModel,
            'numero' => $id,
            'dataProvider' => $dataProvider,
            'consulta' => $consulta,
            'montototal' => $montototal,
            'montototalenletras' => $montototalenletras,
            'montoapr' => $montoapr,
            'montoaprenletras' => $montoaprenletras,
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
        'cssInline' => '.kv-heading-1{font-size:10px}',
         // set mPDF properties on the fly
        'options' => ['title' => 'Punto de Cuenta '. $consulta[0]['solicitud']],
         // call mPDF methods on the fly
        'marginTop' => '74',

        'methods' => [
            'SetHTMLHeader'=>[$headerHtml, [ 'E', [TRUE]]],
            'SetHTMLFooter'=>[$footerHtml, [ 'E', [TRUE]]],
        ],

    ]);



    // return the pdf output as per the destination setting
    return $pdf->render();


    }

    public function actionImprimirplanilla($id){

        $solicitudessearch = SolicitudesSearch::findOne($id);
        //Manera de llegarle a un valor a traves de relaciones
        //Utilizando el Metodo Mágico GET
        //$solicitudessearch->personabeneficiario->parroquia->estado->nombre;

        $searchModel = new PresupuestosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['presupuestos.solicitud_id'=>$id]);

        $headerHtml = '<div class="row"><table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; "> '
        .'<tr style="border: solid 2px black;"><td rowspan="3" class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "110", "class" => "pull-left"])
        .'</td><td rowspan="3" class="text-center col-xs-8 col-sm-8 col-md-8 col-lg-8" style="border: solid 2px black; font-size:18px;"><strong>SOLICITUD: '.$solicitudessearch->num_solicitud.'</strong> '
        .'</td><td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="font-size:10px; margin: 0px; padding: 0px;"><strong>PÁGINA: </strong>{PAGENO} de {nb}</td></tr><tr> '
        .'<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="border: solid 2px black; font-size:10px; margin: 0px; padding: 0px;"><strong>FECHA: </strong>'.Yii::$app->formatter->asDate($solicitudessearch->created_at,'php:d/m/Y')
        .'</td></tr><tr> '
        .'<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="border: solid 2px black; font-size:10px; margin: 0px; padding: 0px;"><strong> '.strtoupper($solicitudessearch->estatussasyc->estatus)
        .'</strong></td></tr></table></div>';

        if(empty($solicitudessearch->users->nombre)){
            $nombre = "";
        }else{
            $nombre = $solicitudessearch->users->nombre;
        }

        $footerHtml = '<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border-collapse: collapse; margin: 0px; padding: 0px; font-size:12px;">'
        .'<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="margin: 0px; padding: 0px; font-size:12px;">'
        ."<strong>"
        .
        $nombre
        ."<strong>"
        .'</td></tr></table></div> <p class="pull-right" style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></span>';

    // get your HTML raw content without any layouts or scripts
    $content = $this->renderPartial('imprimirplanilla', [
//            'searchModel' => $searchModel,
            'numero' => $id,
            'dataProvider' => $dataProvider,
            'solicitudessearch' => $solicitudessearch,
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
        'cssInline' => '.kv-heading-1{font-size:10px}',
         // set mPDF properties on the fly
        'options' => ['title' => 'Planilla '. $solicitudessearch->num_solicitud],
         // call mPDF methods on the fly
        'marginTop' => '27',

        'methods' => [
            'SetHTMLHeader'=>[$headerHtml, [ 'E', [TRUE]]],
            'SetHTMLFooter'=>[$footerHtml, [ 'E', [TRUE]]],
        ],

    ]);



    // return the pdf output as per the destination setting
    return $pdf->render();


    }

    public function actionBitacora($id){

        $solicitudessearch = SolicitudesSearch::findOne($id);
        //Manera de llegarle a un valor a traves de relaciones
        //Utilizando el Metodo Mágico GET
        //$solicitudessearch->personabeneficiario->parroquia->estado->nombre;

        $searchModel = new PresupuestosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['presupuestos.solicitud_id'=>$id]);

        $searchModelBitacoras = new BitacorasSearch();
        $dataProviderBitacoras = $searchModelBitacoras->search(Yii::$app->request->queryParams);
        $dataProviderBitacoras->query->andWhere(['solicitud_id'=>$id]);
        $dataProviderBitacoras->query->orderBy('id ASC');

        $headerHtml = '<div class="row"><table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; "> '
        .'<tr style="border: solid 2px black;"><td rowspan="3" class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "110", "class" => "pull-left"])
        .'</td><td rowspan="3" class="text-center col-xs-8 col-sm-8 col-md-8 col-lg-8" style="border: solid 2px black; font-size:18px;"><strong>SOLICITUD: '.$solicitudessearch->num_solicitud.'<br/>BITÁCORA</strong> '
        .'</td><td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="font-size:10px; margin: 0px; padding: 0px;"><strong>PÁGINA: </strong>{PAGENO} de {nb}</td></tr><tr> '
        .'<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="border: solid 2px black; font-size:10px; margin: 0px; padding: 0px;"><strong>FECHA: </strong>'.Yii::$app->formatter->asDate($solicitudessearch->created_at,'php:d/m/Y')
        .'</td></tr><tr> '
        .'<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center" style="border: solid 2px black; font-size:10px; margin: 0px; padding: 0px;"><strong> '.strtoupper($solicitudessearch->estatussasyc->estatus)
        .'</strong></td></tr></table></div>';

        if(empty($solicitudessearch->users->nombre)){
            $nombre = "";
        }else{
            $nombre = $solicitudessearch->users->nombre;
        }

        $footerHtml = '<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border-collapse: collapse; margin: 0px; padding: 0px; font-size:12px;">'
        .'<tr><td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="margin: 0px; padding: 0px; font-size:12px;">'
        ."<strong>TRABAJADOR SOCIAL: "
        .strtoupper($nombre)."<strong>"
        .'</td></tr></table></div> <p class="pull-right" style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></span>';

    // get your HTML raw content without any layouts or scripts
    $content = $this->renderPartial('bitacora', [
            'numero' => $id,
            'dataProvider' => $dataProvider,
            'solicitudessearch' => $solicitudessearch,
            'dataProviderBitacoras' => $dataProviderBitacoras,
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
        'cssInline' => '.kv-heading-1{font-size:10px}',
         // set mPDF properties on the fly
        'options' => ['title' => 'Bitacora '. $solicitudessearch->num_solicitud],
         // call mPDF methods on the fly
        'marginTop' => '27',

        'methods' => [
            'SetHTMLHeader'=>[$headerHtml, [ 'E', [TRUE]]],
            'SetHTMLFooter'=>[$footerHtml, [ 'E', [TRUE]]],
        ],

    ]);



    // return the pdf output as per the destination setting
    return $pdf->render();


    }
}
