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
        
        //encontrar el id de solicitud
        $idsolicitud = $this->Encontrarsolicitud($modelcheque->id_presupuesto);
        
        //Encontrar el id de solicitud y enviar
        $modelsolicitud = Solicitudes::findOne($idsolicitud);
        
        //Encontrar el id de la Persona Beneficiario
        $idbeneficiario = $this->Encontrarbeneficiario($idsolicitud);
        
        //Cargo las Fotos solicitud Necesito Solicitud ID
        $modelfotossolicitud = new Fotossolicitud();
        
        //Cargo el beneficiario para los cambios
        $modelpersonabeneficiario = Personas::findOne($idbeneficiario);
        
        // Cargar los cheques en una pantallita y seleccionarlos
        $chequesdisponibles = $this->Chequesporcaso($idsolicitud);
        
        if ($modelcheque->load(Yii::$app->request->post())) {
            echo "Entre<pre>";
            print_r ($modelcheque->cheques);
            echo "</pre>";
            exit();
        }
    
        return $this->render('cargarfoto', [
            'modelcheque' => $modelcheque,
            'modelfotossolicitud' => $modelfotossolicitud,
            'modelpersonabeneficiario' => $modelpersonabeneficiario,
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
}
