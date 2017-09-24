<?php

namespace app\controllers;

use Yii;
use app\models\Sepsolicitud;
use app\models\SepsolicitudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Sepingreso;
use app\models\Solicitudes;
use yii\db\Query;
use yii\data\ActiveDataProvider;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'create',
                    'update',
                    'delete',
                    'view',
                    'ubica',
                    'muestra',
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
                        'actions' => ['create', 'ubica', 'muestra'],
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
    
    public function actionUbica()
    {
        $model = new \app\models\Sepingreso;

        if ($model->load(Yii::$app->request->post())) {
            
            $numero = $model->caso; 
//            $query = \app\models\Presupuestos::find()
//                    ->andFilterWhere([
//                    'solicitud_id' => $numero,]);
//
//            $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            ]);
            
            return $this->redirect('muestra?numero='.$numero);
        } else {
            return $this->render('ubica', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionMuestra($numero=null)
    {       

            $query = \app\models\PresupuestosSearch::find()
                    ->andFilterWhere([
                    'solicitud_id' => $numero]);

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);
            
            $consulta = Yii::$app->db->createCommand("SELECT CONCAT('Caso N°: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT('Solicitante: ' ||ps.nombre || ' ' || ps.apellido || ' C.I.: ' ||ps.ci ) AS solicitante, "
            ."CONCAT('Beneficiario: ' ||pb.nombre || ' ' || pb.apellido || ' C.I.: ' ||pb.ci ) AS beneficiario, "
            ."CONCAT('Requerimiento: ' || r1.nombre) AS requerimiento, "
            ."CONCAT('Unidad: ' || r2.nombre) AS unidad, "
            ."CONCAT('Tipo de Ayuda: ' || ta.nombre) AS tipoayuda, "
            ."CONCAT('Area: ' || a1.nombre) AS area, "
            ."CONCAT('Necesidad: ' || s1.necesidad) AS necesidad, "
            ."CONCAT('Descripcion: ' || s1.descripcion) AS descripcion, "
            ."pr1.montoapr as monto, "
            ."CONCAT('Casa Comercial: ' || ei1.nombrecompleto) AS casacomercial, "
            ."ei1.nombrecompleto AS nombrecasacomercial, "
            ."ei1.nrif AS rif, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."s1.num_solicitud as ndonacion ,"
            ."CONCAT('Telefonos: ' || pb.telefono_otro || ' ' || pb.telefono_fijo || ' ' || pb.telefono_otro) as telefonos "
            ."FROM solicitudes s1 FULL OUTER JOIN presupuestos pr1 ON pr1.solicitud_id=s1.id "
            ."JOIN personas pb ON s1.persona_beneficiario_id=pb.id "
            ."JOIN personas ps ON s1.persona_solicitante_id=ps.id "
            ."JOIN areas a1 ON a1.id=s1.area_id "
            ."JOIN tipo_ayudas ta ON a1.tipo_ayuda_id= ta.id "
            ."JOIN requerimientos r1 ON pr1.requerimiento_id=r1.id "
            ."JOIN recepciones r2 ON s1.recepcion_id=r2.id "
            ."JOIN empresa_institucion ei1 ON pr1.beneficiario_id = ei1.id "
            ."WHERE pr1.solicitud_id = ".$numero)->queryAll();

        return $this->render('muestra', [
//            'searchModel' => $searchModel,
            'numero' => $numero,
            'dataProvider' => $dataProvider,
            'consulta' => $consulta
        ]);
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
    
    public function actionNumsolicitud($q = null, $id = null) {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new Query;
        $query->addSelect(['id', 'num_solicitud as text'])
            ->from('solicitudes')
            ->andFilterWhere(['like', 'num_solicitud', $q])
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
    
    protected function findModel($codemp, $numsol)
    {
        if (($model = Sepsolicitud::findOne(['codemp' => $codemp, 'numsol' => $numsol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionInserta($numero)            
    {
        $consulta = Yii::$app->db->createCommand("SELECT CONCAT('Caso N°: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT('Solicitante: ' ||ps.nombre || ' ' || ps.apellido || ' C.I.: ' ||ps.ci ) AS solicitante, "
            ."CONCAT('Beneficiario: ' ||pb.nombre || ' ' || pb.apellido || ' C.I.: ' ||pb.ci ) AS beneficiario, "
            ."CONCAT('Requerimiento: ' || r1.nombre) AS requerimiento, "
            ."CONCAT('Unidad: ' || r2.nombre) AS unidad, "
            ."CONCAT('Tipo de Ayuda: ' || ta.nombre) AS tipoayuda, "
            ."CONCAT('Area: ' || a1.nombre) AS area, "
            ."CONCAT('Necesidad: ' || s1.necesidad) AS necesidad, "
            ."CONCAT('Descripcion: ' || s1.descripcion) AS descripcion, "
            ."pr1.montoapr as monto, "
            ."CONCAT('Casa Comercial: ' || ei1.nombrecompleto) AS casacomercial, "
            ."ei1.nombrecompleto AS nombrecasacomercial, "
            ."ei1.nrif AS rif, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."s1.num_solicitud as ndonacion ,"
            ."CONCAT('Telefonos: ' || pb.telefono_otro || ' ' || pb.telefono_fijo || ' ' || pb.telefono_otro) as telefonos "
            ."FROM solicitudes s1 FULL OUTER JOIN presupuestos pr1 ON pr1.solicitud_id=s1.id "
            ."JOIN personas pb ON s1.persona_beneficiario_id=pb.id "
            ."JOIN personas ps ON s1.persona_solicitante_id=ps.id "
            ."JOIN areas a1 ON a1.id=s1.area_id "
            ."JOIN tipo_ayudas ta ON a1.tipo_ayuda_id= ta.id "
            ."JOIN requerimientos r1 ON pr1.requerimiento_id=r1.id "
            ."JOIN recepciones r2 ON s1.recepcion_id=r2.id "
            ."JOIN empresa_institucion ei1 ON pr1.beneficiario_id = ei1.id "
            ."WHERE pr1.solicitud_id = ".$numero)->queryAll();
        
        for ($i=0 ; $i<count($consulta); $i++){
            $hayrif = Yii::$app->dbsigesp->createCommand("select count(*) from rpc_beneficiario where ced_bene = '"
                .$consulta[$i]['rif']
                ."';")->queryScalar();
        
        if ($hayrif == 0){
            $fechahoy = $consulta[$i]['fecha'];
            Yii::$app->dbsigesp->createCommand("INSERT INTO rpc_beneficiario (codemp, ced_bene, "
                    . "codpai, codest, codmun, codpar, codtipcta, rifben, nombene, apebene, dirbene, "
                    . "telbene, celbene, email, sc_cuenta, codbansig, codban, ctaban, foto, "
                    . "fecregben, nacben, numpasben, tipconben, tipcuebanben, sc_cuentarecdoc) "
                    . "VALUES ('0001', '"
                    . $consulta[$i]['rif']
                    . "', '---', '---', '---', '---', NULL, NULL, '"
                    . substr($consulta[$i]['nombrecasacomercial'],50)
                    . "', '"
                    . substr($consulta[$i]['nombrecasacomercial'],0,50)
                    . "', 'CARACAS', NULL, NULL, NULL, '21104990001', '---', NULL, NULL, NULL, "
                    . "'"
                    . $fechahoy
                    . "', 'V', NULL, 'F', "
                    . "NULL, NULL);")->execute();
        }
        $estructura = ($consulta[$i]['codestpre'] == "0201") ? "3701" : "3702";
        $cuenta = ($consulta[$i]['codestpre'] == "0201") ? "407010201" : "407010401";
        $tiposolicitud = ($consulta[$i]['codestpre'] == "0201") ? "00001" : "00002";
        
        $haydon = Yii::$app->dbsigesp->createCommand("select count(*) from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();
        
        if ($haydon == 0){ 
            Yii::$app->dbsigesp->createCommand("INSERT INTO sep_solicitud (codemp, "
                . "numsol, codtipsol, codfuefin, fecregsol, estsol, consol, "
                . "monto, monbasinm, montotcar, tipo_destino, cod_pro, ced_bene, "
                . "coduniadm, codestpro1, codestpro2, codestpro3, codestpro4, "
                . "codestpro5, estcla, estapro, fecaprsep, codaprusu, numpolcon, "
                . "fechaconta, fechaanula, nombenalt, tipsepbie, codusu, numdocori, "
                . "conanusep, feccieinv, codcencos) VALUES ('0001', "
                . "'DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                . "', "
                . "'03', '--', "
                . "'"
                . $consulta[$i]['fecha']
                . "', "
                . "'E', "
                . "'"
                .$consulta[$i]['solicitud']. ' '
                .$consulta[$i]['solicitante']. ' '
                .$consulta[$i]['beneficiario']. ' '
                .$consulta[$i]['unidad']. ' '
                .$consulta[$i]['tipoayuda']. ' '
                .$consulta[$i]['area'] . ' '
                .$consulta[$i]['requerimiento']. ' '
                .$consulta[$i]['necesidad']. ' '
                .$consulta[$i]['descripcion']. ' '
                .$consulta[$i]['rif']. ' '
                .$consulta[$i]['casacomercial']. ' '
                .$consulta[$i]['monto']. ' '
                ." Bs."
                .$consulta[$i]['telefonos']. ' '
                . "', "
                . ""
                . $consulta[$i]['monto']
                . ", "
                . ""
                . $consulta[$i]['monto']
                . ", "
                . "0, 'B', '----------', "
                . "'"
                . $consulta[$i]['rif']
                . "', "
                . "'0000000003', '000000000000000000000AE01', '000000000000000000000"
                . $estructura
                . "', "
                . "'000000000000000000000"
                . $consulta[$i]['codestpre']
                . "', '0000000000000000000000000', "
                . "'0000000000000000000000000', 'P', "
                . "1, '"
                . $consulta[$i]['fecha']
                . "', 'ADMINISTRADOR', 0, '1900-1-1', "
                . "'1900-1-1', '', '-', 'ADMINISTRADOR', '', '', '1900-1-1', '---');")->execute();
        }
        
        $hayconcepto = Yii::$app->dbsigesp->createCommand("select count(*) from sep_dt_concepto where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();
        
        if ($hayconcepto == 0){   
        Yii::$app->dbsigesp->createCommand("INSERT INTO sep_dt_concepto (codemp, numsol, codconsep, "
                ."codestpro1, codestpro2, codestpro3, codestpro4, codestpro5, estcla, spg_cuenta, "
                ."codfuefin, codcencos, cancon, monpre, moncon, orden) VALUES "
                ."('0001', "
                . "'DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                . "', '"
                . $tiposolicitud
                . "', '000000000000000000000AE01', '000000000000000000000"
                . $estructura
                ."', '000000000000000000000"
                .$consulta[$i]['codestpre']
                . "', '0000000000000000000000000', '0000000000000000000000000', 'P', "
                ."'"
                . $cuenta
                . "', '--', '---', 1, "
                . $consulta[$i]['monto']
                . ", "
                . $consulta[$i]['monto']
                . ", 1);")->execute();
        }
        
        $hayasiento = Yii::$app->dbsigesp->createCommand("select count(*) from sep_cuentagasto where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();
        
        if ($hayasiento == 0){ 
        Yii::$app->dbsigesp->createCommand("INSERT INTO sep_cuentagasto (codemp, numsol, codestpro1, "
                . "codestpro2, codestpro3, codestpro4, codestpro5, estcla, spg_cuenta, codfuefin, "
                ."codcencos, monto) VALUES ('0001', '"
                . "DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                . "', '000000000000000000000AE01', '000000000000000000000"
                . $estructura
                . "', '000000000000000000000"
                . $consulta[$i]['codestpre']
                . "', '0000000000000000000000000', '0000000000000000000000000', 'P', '"
                . $cuenta
                . "', '--', '---', "
                . $consulta[$i]['monto']
                . ");")->execute();
        }    
            
            
        }
        
        $haygestion = Yii::$app->db->createCommand("select count(*) from gestion where solicitud_id = "
                .$numero.";")->queryScalar();
        
        if ($haygestion == 0){ 
        Yii::$app->db->createCommand("UPDATE gestion "
                . "SET estatus3_id = 17 WHERE solicitud_id = ".$numero.";")->execute();
        }else{
        Yii::$app->db->createCommand("INSERT INTO gestion (solicitud_id, estatus3_id) VALUES "
                . "("
                . $numero 
                .", 17);")->execute();    
        }
        
        return $this->redirect('muestra?numero='.$numero);
    }
}
