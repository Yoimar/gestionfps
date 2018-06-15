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
use app\models\Conexionsigesp;
use app\models\Scbmovbcospg;
use app\models\Cxpdtsolicitudes;
use app\models\Cxprdspg;
use app\controllers\GestionController;
use app\models\Presupuestos;
use app\models\Gestion;
use app\models\Solicitudes;
use app\models\Personas;
use app\models\Bitacoras;
use app\models\Sepingreso;
use yii\helpers\Html;
use kartik\mpdf\Pdf;


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
                    'busqueda',
                    'entregacheque',
                    'actualizafecha',
                    'reporte',
                    ],
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'view',
                            'busqueda',
                            'entregacheque',
                            'actualizafecha',
                            'reporte',
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
        $modelcheque = new Cheque();
        $iraentrega = 0;
        $chequemanual = 0;


        if ($modelcheque->load(Yii::$app->request->post())) {

            $idconexionsigesp = $this->Encontrarconexionsigesp($modelcheque->cheque);


            if ($idconexionsigesp != false) {
                $idgestion = $this->Encontrargestion($idconexionsigesp);

                //Si es verdadero lo actualizo para que me traiga el cheque
                GestionController::reload($idgestion);

                Yii::$app->session->setFlash("warning", "El cheque fue actualizado".$idconexionsigesp
                ."Seleccione ir a Entrega");
                $iraentrega = 1;

            }else{
                //Pantalla de carga de Caso Manual con presupuesto Manual
                Yii::$app->session->setFlash("warning", "El caso no pertenece"
             . " a un caso por bienestar social Seleccione Carga Manual");
                $chequemanual = 1;
            }

        }

        return $this->render('entrega', [
            'modelcheque' => $modelcheque,
            'chequemanual' => $chequemanual,
            'iraentrega' => $iraentrega,
        ]);
    }

    public function actionActualizafecha(){
        $modelcheque = new Cheque();

        if ($modelcheque->load(Yii::$app->request->post())) {

        $modelcheques = Scbmovbco::find()->select([ 'numdoc', ])
                    ->where([ 'fecmov' => $modelcheque->date_cheque,
                              'codope' => 'CH',
                              'estmov' => ['N','C','O','L']   ])
                    ->all();
        $i=0;

        // Inicio del Foreach
        foreach ($modelcheques as $instanciacheque){

        $idconexionsigesp = $this->Encontrarconexionsigesp($instanciacheque->numdoc);

            if ($idconexionsigesp != false) {
                $idgestion = $this->Encontrargestion($idconexionsigesp);
                //Si es verdadero lo actualizo para que me traiga el cheque
                GestionController::reload($idgestion);
                $i++;
            }
        }

        Yii::$app->session->setFlash("success", "Fueron cargados ".$i." cheques");

        }
        return $this->render('actualizafecha', [
            'modelcheque' => $modelcheque,
        ]);

    }

    public function Encontrargestion($conexionsigesp){

        $modelconexionsigesp = Conexionsigesp::findOne($conexionsigesp);

        $modelpresupuesto = Presupuestos::findOne($modelconexionsigesp->id_presupuesto);

        $modelgestion = Gestion::findOne([
            'solicitud_id' => $modelpresupuesto->solicitud_id,
        ]);

        return $modelgestion->id;
    }

    public function Encontrarconexionsigesp($cheque){
        /* Encuentro la orpa */
        $modelorpa = Scbmovbcospg::findOne([
            'numdoc' => $cheque, 'estmov' => ['N','C','O']
        ]);

        //reviso el numero de orpa o si existe orpa
        if (isset($modelorpa)){
            //Para determinar el numero de recepcion
            $modeldtorpa = Cxpdtsolicitudes::findOne([
                'numsol' => $modelorpa->documento,
            ]);

            //reviso si el caso esta recibido por orpa
            $modelrecibidoorpa = Cxprdspg::findOne([
                'numrecdoc' => $modeldtorpa->numrecdoc,
                'ced_bene' => $modeldtorpa->ced_bene,
            ]);

            $modelconexionsigesp = Conexionsigesp::findOne([
                'req' =>  $modelrecibidoorpa->numdoccom,
            ]);

            return isset($modelconexionsigesp)?$modelconexionsigesp->id:false;

        }else {
            return false;
        }
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

    public function actionReporte()
    {
        $searchModel = new ChequeSearchCarga();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCargarfoto($cheque){

        $modelcheque = Cheque::findOne($cheque);

        /** Inicializar el responsable y el entregado por **/
        $usuarioid = Yii::$app->user->id;
        $modelcheque->responsable_by = $usuarioid;
        $modelcheque->entregado_by = $usuarioid;


        //encontrar el id de solicitud
        $idsolicitud = $this->Encontrarsolicitud($modelcheque->id_presupuesto);

        //Encontrar el id de solicitud y enviar
        $modelsolicitud = Solicitudes::findOne($idsolicitud);

        //Encontrar el id de la Persona Beneficiario
        $idbeneficiario = $this->Encontrarbeneficiario($idsolicitud);

        //Encontrar el id de la Persona Solicitante
        $idsolicitante = $this->Encontrarsolicitante($idsolicitud);

        //Cargo las Fotos solicitud Necesito Solicitud ID
        $modelfotossolicitud = $this->Cargamodelofotossolicitud($modelcheque->imagenentrega_id);

        //Cargo el beneficiario para los cambios
        $modelpersonabeneficiario = Personas::findOne($idbeneficiario);

        //Cargo el solicitante para los cambios
        $modelpersonasolicitante = Personas::findOne($idsolicitante);

        // Cargar los cheques en una pantallita y seleccionarlos
        $chequesdisponibles = $this->Chequesporcaso($idsolicitud);

        //Buscar Gestion
        $modelgestion = Gestion::findOne([
            'solicitud_id' => $idsolicitud,
        ]);

        if (
                $modelcheque->load(Yii::$app->request->post()) &&
                $modelfotossolicitud->load(Yii::$app->request->post()) &&
                //$modelgestion->load(Yii::$app->request->post()) &&
                $modelpersonabeneficiario->load(Yii::$app->request->post()) &&
                $modelpersonasolicitante->load(Yii::$app->request->post()) &&
                $modelsolicitud->load(Yii::$app->request->post())
           ){
            //Guardar la Foto

            $image = $modelfotossolicitud->cargarimagen();

            //Verifico que la imagen alla sido cargada si no devuelvo con error
            if ($image == false){
                 Yii::$app->session->setFlash("warning", "Por Favor Realize la carga de la Imagen");
                 return $this->render('cargarfoto', [
                    'modelcheque' => $modelcheque,
                    'modelgestion' => $modelgestion,
                    'modelfotossolicitud' => $modelfotossolicitud,
                    'modelpersonabeneficiario' => $modelpersonabeneficiario,
                    'modelpersonasolicitante' => $modelpersonasolicitante,
                    'modelsolicitud' => $modelsolicitud,
                    'chequesdisponibles' => $chequesdisponibles,
                ]);
            }

            $modelfotossolicitud->descripcion = "Entrega de los cheques ". $this->Chequesfortext($modelcheque->cheques);
            $modelfotossolicitud->solicitud_id = $modelsolicitud->id;
            $modelfotossolicitud->foto = $modelfotossolicitud->getRevisarimagen($image);
            $modelfotossolicitud = $modelfotossolicitud->cargardefecto($modelfotossolicitud);

            if ($modelfotossolicitud->save()) {
                    $path = $modelfotossolicitud->getArchivoimagen();
                    $image->saveAs($path);
            }

            //Entregar el cheque

            $modelcheque->imagenentrega_id = $modelfotossolicitud->id;
            $modelcheque->estatus_cheque = 'ENT';
            $modelcheque->save();

            //Verificar si tiene dos cheques para la misma Foto y realizo el registro de sigesp (interno)
            $this->Duplicadocheque($modelcheque, $modelcheque->cheques);

            //Registro en la Bitacora
            $this->Registroenlabitacora($modelcheque, $modelfotossolicitud);

            //Guardar los modelos de Beneficiario Solicitante y Solicitud
            $modelpersonabeneficiario->save();

            return $this->redirect(['imprimirentrega',
                'cheque' => $cheque,
            ]);

        }

        return $this->render('cargarfoto', [
            'modelcheque' => $modelcheque,
            'modelgestion' => $modelgestion,
            'modelfotossolicitud' => $modelfotossolicitud,
            'modelpersonabeneficiario' => $modelpersonabeneficiario,
            'modelpersonasolicitante' => $modelpersonasolicitante,
            'modelsolicitud' => $modelsolicitud,
            'chequesdisponibles' => $chequesdisponibles,
        ]);
    }

     /*
     Metodo para encontrar los cheques asociados a una solicitud
     */
    public function Chequesporcaso($id_solicitud){
        $presupuestos = Presupuestos::find()
                ->where(['solicitud_id' => $id_solicitud])
                ->all();

        foreach ($presupuestos as $presupuesto){

            $modelcheques = Cheque::find()
                    ->where(['id_presupuesto' => $presupuesto->id])
                    ->all();
            foreach ($modelcheques as $modelcheque) {
                $cheques[$modelcheque->cheque] = $modelcheque->cheque;
            }
        }
        return $cheques;
    }

    /*
     Metodo para encontrar la solicitud con el id del presupuesto
     */
    public function Encontrarsolicitud($id_presupuesto){

        $presupuesto = Presupuestos::findOne($id_presupuesto);

        return $presupuesto->solicitud_id;
    }

    /*
     Metodo para encontrar el id del beneficiario de una solicitud
     */
    public function Encontrarbeneficiario($idsolicitud){

        $solicitud = Solicitudes::findOne($idsolicitud);

        return $solicitud->persona_beneficiario_id;
    }

    /*
     Metodo para encontrar el id del solicitante de una solicitud
     */
    public function Encontrarsolicitante($idsolicitud){

        $solicitud = Solicitudes::findOne($idsolicitud);

        return $solicitud->persona_solicitante_id;
    }

    public function Cargamodelofotossolicitud($imagenentrega_id){
        if (empty($imagenentrega_id)){
            $modelfotossolicitud = new Fotossolicitud;
        }else{
            $modelfotossolicitud = Fotossolicitud::findOne($imagenentrega_id);
        }
        return $modelfotossolicitud;
    }

    public function Duplicadocheque($modelcheque, $cheques){

        $this->CambiarSigesp($modelcheque);

        foreach ($cheques as $cheque) {
            if ($modelcheque->cheque != $cheque) {

                $modelduplicadocheque = Cheque::findOne($cheque);
                $modelduplicadocheque->estatus_cheque = 'ENT';
                $modelduplicadocheque->imagenentrega_id = $modelcheque->imagenentrega_id;
                $modelduplicadocheque->date_reccaja = $modelcheque->date_reccaja;
                $modelduplicadocheque->date_entregado = $modelcheque->date_entregado;
                $modelduplicadocheque->entregado_by = $modelcheque->entregado_by;
                $modelduplicadocheque->retirado_personaid = $modelcheque->retirado_personaid;
                $modelduplicadocheque->responsable_by = $modelcheque->responsable_by;
                $modelduplicadocheque->save();

                //Modificar en sigesp
                $this->CambiarSigesp($modelduplicadocheque);

            }

        }
        return true;
    }

    public function Registroenlabitacora($modelcheque, $modelfotossolicitud){
        $modeltrabajador = Trabajador::findOne([
            'user_id' => $modelcheque->entregado_by
            ]);
        $modelbitacora = new Bitacoras;
                $modelbitacora->solicitud_id = $modelfotossolicitud->solicitud_id;
                $modelbitacora->fecha = $modelcheque->date_entregado;
                $modelbitacora->nota = "El trabajador ".$modeltrabajador->trabajadorfps." ha registrado"
                    ."la entrega del (los) cheque(s) : "
                    .$this->Chequesfortext($modelcheque->cheques)
                    . " el día "
                    . date('d/m/Y') . " a las " . date('h:i a');
                $modelbitacora->usuario_id = $modeltrabajador->users_id;
                $modelbitacora->ind_activo = 1;
                $modelbitacora->ind_alarma = 0;
                $modelbitacora->ind_atendida = 0;
                $modelbitacora->version = 0;
                $modelbitacora->created_at = date('Y-m-d H:i:s');
                $modelbitacora->updated_at = date('Y-m-d H:i:s');
                $modelbitacora->save();

        return true;
    }

    public function Chequesfortext($cheques){

        $array = array_map(function($v) { return ltrim($v, '0'); }, $cheques);
        $chequesfortext = implode(", ", $array);

        return $chequesfortext;
    }

    public function CambiarSigesp($modelcheque){

        $modelsigesp = Scbmovbco::findOne([
                    'numdoc' => $modelcheque->cheque,
                    'estmov' => ['N','C','O']
        ]);

        $modelpersona = Personas::findOne($modelcheque->retirado_personaid);

            $modelsigesp->estcondoc = 'E';
            $modelsigesp->emichefec = $modelcheque->date_entregado;
            $modelsigesp->emichenom = $modelpersona->nombre." ".$modelpersona->apellido;
            $modelsigesp->emicheced = strval($modelpersona->ci);
            $modelsigesp->emicheproc = 1;

        $modelsigesp->save();

        return true;
    }

    public function actionImprimirentrega($cheque){

        $model = Cheque::findOne($cheque);
        $modelfotossolicitud = $this->Cargamodelofotossolicitud($model->imagenentrega_id);
        $cheques = $this->Chequesporentrega($modelfotossolicitud->id);
        $modelsolicitud = Solicitudes::findOne($modelfotossolicitud->solicitud_id);
        $modelbeneficiario = Personas::findOne($modelsolicitud->persona_beneficiario_id);
        $modelsolicitante = Personas::findOne($modelsolicitud->persona_solicitante_id);
        $modelretirado = Personas::findOne($model->retirado_personaid);
        $modelresponsable = Trabajador::findOne(['user_id'=> $model->responsable_by]);
        $modelentregado = Trabajador::findOne(['user_id'=> $model->entregado_by]);
        /** Inicializar el depdrown de Kartik Beneficiario **/
        if (isset($modelbeneficiario->parroquia_id)) {
            $parroquia = \app\models\Parroquias::findOne($modelbeneficiario->parroquia_id);
            $municipio = \app\models\Municipios::findOne($parroquia->municipio_id);
            $modelestado = \app\models\Estados::findOne($municipio->estado_id);
        }else{
            //cargo el modelo de caracas defecto 1
            $modelestado = \app\models\Estados::findOne(1);
        }

        //data provider para cintillo con cheques monto y total
        $searchModel = new ChequeSearchCarga();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['imagenentrega_id'=>$modelfotossolicitud->id]);



        $headerHtml = '<div class="row">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left"])
        .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "450", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"])
        .'</div>';

        $footerHtml = '<center>'
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
       .'</div></center><p style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></p>';
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('imprimir', [
                'model' => $model,
                'modelfotossolicitud' => $modelfotossolicitud,
                'cheques' => $cheques,
                'modelsolicitud' => $modelsolicitud,
                'modelsolicitante' => $modelsolicitante,
                'modelbeneficiario' => $modelbeneficiario,
                'modelretirado' => $modelretirado,
                'modelresponsable' => $modelresponsable,
                'modelentregado' => $modelentregado,
                'modelestado' => $modelestado,
                'dataProvider' => $dataProvider,
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
            'cssInline' => '.kv-heading-1{font-size:7px} tr{
            border: 1px solid black !important;
            vertical-align: middle;}
            td.negro{
            border: 1px solid black !important;
            }
            negro{
            border: 1px solid black !important;
            }',
             // set mPDF properties on the fly
            'options' => ['title' => 'Entrega de Caso'],
             // call mPDF methods on the fly
            'marginTop' => '35',

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

        public function Chequesporentrega($id_fotossolicitud){
            $cheques = Cheque::find()
                ->where(['imagenentrega_id' => $id_fotossolicitud])
                ->all();

        foreach ($cheques as $cheque){

            $chequesimpr[] = ltrim($cheque->cheque, "0");

        }

        $chequesimprimir = implode(", ", $chequesimpr);

        return $chequesimprimir;


        }

        public function actionRecibircheque($cheque){
            $model = Cheque::findOne($cheque);
            $model->estatus_cheque = 'PEN';
            $model->date_reccaja = date("Y-m-d");
            $model->save();

            return $this->redirect('busqueda');
        }

    public function actionChequemanual($cheque){
        $model = new Sepingreso;

        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect(['asociapresupuesto',
                'caso' => $model->caso,
                'cheque' => $model->cheque,
            ]);

        }

        return $this->render('chequemanual', [
                'model' => $model,
                'cheque' => $cheque,
            ]);
    }

    public function actionAsociapresupuesto($caso,$cheque){
        $presupuestos = Presupuestos::find()
                ->where(['solicitud_id' => $caso])
                ->all();
        if (count($presupuestos) == 1){

            $model_banco_cheque = Scbmovbco::findOne(['numdoc' => $cheque]);


        }


    }






}
