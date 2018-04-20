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
use app\models\Presupuestos;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\i18n\Formatter;
use app\models\Bitacoras;
use app\models\Trabajador;
use app\models\Empresainstitucion;
use app\models\Conexionsigesp;

/**
 * SepsolicitudController implements the CRUD actions for Sepsolicitud model.
 */
class SepsolicitudController extends Controller
{
    public $Void = "";
    public $SP = " ";
    public $Dot = ".";
    public $Zero = "0";
    public $Neg = "Menos";



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
        $dataProvider->query->andWhere(['estsol'=>'E', 'coduniadm'=>'0000000003']);


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
        $model = new Sepingreso;

        if ($model->load(Yii::$app->request->post())&&$model->validate()) {

            //Se hace el Modelo Personalizado lo recibe el mismo caso y lo reenvia a la siguiente Vista

            $numero = $model->caso;
            $haypresupuesto = \app\models\PresupuestosSearch::find()
                    ->select(["count(*)"])
                    ->andFilterWhere(['presupuestos.solicitud_id' => $numero])
                    ->scalar();
            $consultaestatus = Yii::$app->db->createCommand("SELECT estatus "
                    ."FROM solicitudes "
                    ."WHERE id = ".$numero)->queryOne();

        if($haypresupuesto==0){
                Yii::$app->session->setFlash("warning", "El caso no posee Presupuesto asociado<br>Intente de Nuevo");
                return $this->render('ubica', [
                'model' => $model,
                ]);
            }else if($consultaestatus['estatus']=="ACA" or $consultaestatus['estatus']=="EAA" or $consultaestatus['estatus']=="APR" or $consultaestatus['estatus']=="PPA"){

                return $this->redirect('muestra?numero='.$numero);

            } else {

                Yii::$app->session->setFlash("warning", "El caso no tiene estatus para ser aprobado <br>Por favor Verifique el caso e intente de Nuevo");
                return $this->render('ubica', [
                 'model' => $model,
                 ]);

            }

        } else {
            return $this->render('ubica', [
                'model' => $model,
            ]);
        }
    }

    public function actionMuestra($numero)
    {
        //Hay que validar si entran dos casas comerciales
        //1ero Encuentro las casas comerciales
        $idempresas = Presupuestos::find()
                    ->select([
                        'id',
                        'beneficiario_id',
                        'solicitud_id'
                    ])
                    ->where(['solicitud_id' => $numero])
                    ->all();


        //2do Verifico si cada uno de los ids esta en blanco o tiene un registro
        foreach ($idempresas as $elemento) {

            //3ero si el beneficiario_id esta en blanco devuelvo el caso
            if ($elemento->beneficiario_id == ''){

                Yii::$app->session->setFlash("warning", "El caso no tiene cargada una casa presupuestaria <br> "
                        . "Por favor Verifique el caso <br> "
                        . "Si es un caso de ALMACEN <br> "
                        . "Entre por el Menu de Aprobacion por Almacen");
                return $this->redirect(['ubica']);

            }
            //4to si el caso no tiene un id en la tabla de empresa institucion le creo uno.
            $empresa = Empresainstitucion::findOne(['id' => $elemento->beneficiario_id]);
            if (empty($empresa)) {
                $modelempresa = new Empresainstitucion;
                $modelempresa->id = $elemento->beneficiario_id;
                $modelempresa->save();
            }

            $consultaparaimprimir = Conexionsigesp::findOne(['id_presupuesto' => $elemento->id]);
            if (isset($consultaparaimprimir)) {
                $imprime = true;
            } else {
                $imprime = false;
            }
        }

            $query = \app\models\PresupuestosSearch::find()
                    ->select([
                        "conexionsigesp.req as documento",
                        'presupuestos.montoapr as montopre',
                        'empresa_institucion.nombrecompleto as nombre',
                        "empresa_institucion.nrif as nrif",
                        "empresa_institucion.rif AS rif",
                        "presupuestos.beneficiario_id",
                        "presupuestos.solicitud_id",
                        "presupuestos.id as id"
                    ])
                    ->join(
                        'LEFT JOIN',
                        'conexionsigesp',
                        'conexionsigesp.id_presupuesto = presupuestos.id'
                    )
                    ->join(
                        'LEFT JOIN',
                        'empresa_institucion',
                        'empresa_institucion.id = presupuestos.beneficiario_id'
                    )
                    ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);



            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

            $consulta = Yii::$app->db->createCommand("SELECT "
            ."CONCAT('Caso N°: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT('Solicitante: ' ||ps.nombre || ' ' || ps.apellido || ' C.I.: ' ||ps.ci ) AS solicitante, "
            ."CONCAT('Beneficiario: ' ||pb.nombre || ' ' || pb.apellido || COALESCE(' C.I.: ' || pb.ci || ' ', '') ) AS beneficiario, "
            ."CONCAT('Requerimiento: ' || r1.nombre) AS requerimiento, "
            ."CONCAT('Unidad: ' || r2.nombre) AS unidad, "
            ."CONCAT('Tipo de Ayuda: ' || ta.nombre) AS tipoayuda, "
            ."CONCAT('Area: ' || a1.nombre) AS area, "
            ."CONCAT('Necesidad: ' || s1.necesidad) AS necesidad, "
            ."CONCAT('Descripcion: ' || s1.descripcion) AS descripcion, "
            ."pr1.beneficiario_id as beneficiario_id, "
            ."pr1.montoapr as monto, "
            ."CONCAT('Casa Comercial: ' || ei1.nombrecompleto) AS casacomercial, "
            ."ei1.nombrecompleto AS nombrecasacomercial, "
            ."ei1.nrif AS rif, "
            ."ei1.rif AS tiporif, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."s1.num_solicitud as ndonacion ,"
            ."CONCAT('Telefonos: ' || COALESCE(pb.telefono_otro || ' ', '') || COALESCE(pb.telefono_fijo || ' ', '') || COALESCE(pb.telefono_celular || ' ', '') ) as telefonos "
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
            'numero' => $numero,
            'dataProvider' => $dataProvider,
            'consulta' => $consulta,
            'imprime' => $imprime
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
        $consulta = Yii::$app->db->createCommand("SELECT CONCAT('Caso N: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT('Solicitante: ' ||ps.nombre || ' ' || ps.apellido || ' C.I.: ' ||ps.ci ) AS solicitante, "
            ."CONCAT('Beneficiario: ' ||pb.nombre || ' ' || pb.apellido || COALESCE(' C.I.: ' || pb.ci || ' ', '') ) AS beneficiario, "
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
            ."ei1.rif AS tiporif, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."pr1.id as id, "
            ."s1.num_solicitud as ndonacion, "
            ."CONCAT('Telefonos: ' || COALESCE(pb.telefono_otro || ' ', '') || COALESCE(pb.telefono_fijo || ' ', '') || COALESCE(pb.telefono_celular || ' ', '') ) as telefonos "
            ."FROM solicitudes s1 FULL OUTER JOIN presupuestos pr1 ON pr1.solicitud_id=s1.id "
            ."JOIN personas pb ON s1.persona_beneficiario_id=pb.id "
            ."JOIN personas ps ON s1.persona_solicitante_id=ps.id "
            ."JOIN areas a1 ON a1.id=s1.area_id "
            ."JOIN tipo_ayudas ta ON a1.tipo_ayuda_id= ta.id "
            ."JOIN requerimientos r1 ON pr1.requerimiento_id=r1.id "
            ."JOIN recepciones r2 ON s1.recepcion_id=r2.id "
            ."JOIN empresa_institucion ei1 ON pr1.beneficiario_id = ei1.id "
            ."WHERE pr1.solicitud_id = :id;")
                        ->bindValue(":id", $numero)
                        ->queryAll();

        $fechahoy = Yii::$app->formatter->asDate('now','php:Y-m-d');

        if ($consulta[0]['tiporif']==""||$consulta[0]['rif']==""||$consulta[0]['nombrecasacomercial']==""){

          $query = \app\models\PresupuestosSearch::find()
                      ->select(["conexionsigesp.req as documento",
                              'presupuestos.montoapr as montopre',
                              'empresa_institucion.nombrecompleto as nombre',
                              "empresa_institucion.nrif as nrif",
                              "empresa_institucion.rif as rif",
                              "presupuestos.beneficiario_id",
                              "presupuestos.solicitud_id",
                              "presupuestos.id as id"])
                      ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                      ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                      ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

        Yii::$app->session->setFlash("warning", "El caso no posee rif<br>Por Favor rellene los datos de la casa comercial");
        $imprime = false;
                return $this->render('muestra', [
                'numero' => $numero,
                'dataProvider' => $dataProvider,
                'consulta' => $consulta,
                'imprime' => $imprime
                ]);
        }




        for ($i=0 ; $i<count($consulta); $i++){

        $hayrif = Yii::$app->dbsigesp->createCommand("select count(*) from rpc_beneficiario where ced_bene = '"
                .$consulta[$i]['rif']
                ."';")->queryScalar();

        /**INSERTO O ACTUALIZO EN LA TABLA RPC_BENEFICIARIO DE SIGESP**/

        if ($hayrif == 0){
            Yii::$app->dbsigesp->createCommand("INSERT INTO rpc_beneficiario (codemp, ced_bene, "
                    . "codpai, codest, codmun, codpar, codtipcta, rifben, nombene, apebene, dirbene, "
                    . "telbene, celbene, email, sc_cuenta, codbansig, codban, ctaban, foto, "
                    . "fecregben, nacben, numpasben, tipconben, tipcuebanben, sc_cuentarecdoc) "
                    . "VALUES ('0001', '"
                    . $consulta[$i]['rif']
                    . "', '---', '---', '---', '---', NULL, '"
                    .$consulta[$i]['tiporif']."-".substr(str_pad($consulta[$i]['rif'], 9, "0", STR_PAD_LEFT),0,8)."-".substr(str_pad($consulta[$i]['rif'], 9, "0", STR_PAD_LEFT),-1)
                    ."', '"
                    . iconv("UTF-8", "ISO-8859-1//IGNORE",substr($consulta[$i]['nombrecasacomercial'],100))
                    . "', '"
                    . iconv("UTF-8", "ISO-8859-1//IGNORE",substr($consulta[$i]['nombrecasacomercial'],0,100))
                    . "', 'CARACAS', NULL, NULL, NULL, '21104990001', '---', NULL, NULL, NULL, '"
                    . $fechahoy
                    . "', 'V', NULL, 'F', "
                    . "NULL, NULL);")->execute();
        }else{
             Yii::$app->dbsigesp->createCommand("UPDATE rpc_beneficiario  SET "
                     . "rifben='".$consulta[$i]['tiporif']."-".substr(str_pad($consulta[$i]['rif'], 9, '0', STR_PAD_LEFT),0,8)."-".substr(str_pad($consulta[$i]['rif'], 9, '0', STR_PAD_LEFT),-1)."'"
                    . ", nombene='".iconv("UTF-8", "ISO-8859-1//IGNORE",substr($consulta[$i]['nombrecasacomercial'],100))."'"
                     . ", apebene='". iconv("UTF-8", "ISO-8859-1//IGNORE",substr($consulta[$i]['nombrecasacomercial'],0,100))."'"
                     . " WHERE ced_bene = '".$consulta[$i]['rif']."';")->execute();
        }


        $estructura = ($consulta[$i]['codestpre'] == "0201") ? "0102" : "0102";
        $cuenta = ($consulta[$i]['codestpre'] == "0201") ? "407010201" : "407010401";
        $tiposolicitud = ($consulta[$i]['codestpre'] == "0201") ? "00001" : "00002";

        $haydon = Yii::$app->dbsigesp->createCommand("select count(*) from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();



        /**INSERTO O ACTUALIZO EN LA TABLA SEP_SOLICITUD DE SIGESP**/

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
                . $fechahoy
                . "', "
                . "'E', "
                . "'"
                .iconv("UTF-8", "ISO-8859-1//IGNORE",$consulta[$i]['solicitud']. ' '
                .$consulta[$i]['beneficiario']. ' '
                .$consulta[$i]['descripcion']. ' '
                .$consulta[$i]['necesidad']. ' ')
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
                . "'0000000003', '000000000000000000000AC02', '000000000000000000000"
                . $estructura
                . "', "
                . "'000000000000000000000"
                . $consulta[$i]['codestpre']
                . "', '0000000000000000000000000', "
                . "'0000000000000000000000000', 'A', "
                . "1, '"
                . $fechahoy
                . "', 'ADMINISTRADOR', 0, '1900-1-1', "
                . "'1900-1-1', '', '-', 'ADMINISTRADOR', '', '', '1900-1-1', '---');")->execute();
        } else { if ((Yii::$app->dbsigesp->createCommand("select estsol from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar())=='E')

                {
                Yii::$app->dbsigesp->createCommand("UPDATE sep_solicitud"
                        . " SET "
                . "fecregsol='".$fechahoy. "', "
                . "consol ='" .iconv("UTF-8", "ISO-8859-1//IGNORE",$consulta[$i]['solicitud']. ' '
                .$consulta[$i]['beneficiario']. ' '
                .$consulta[$i]['necesidad']. ' '
                .$consulta[$i]['descripcion']. ' ' )
                . "', "
                . "monto = "
                . $consulta[$i]['monto']
                . ", "
                . "monbasinm = "
                . $consulta[$i]['monto']
                . ", "
                . "ced_bene ='"
                . $consulta[$i]['rif']
                . "', "
                . "fecaprsep = '"
                . $fechahoy
                . "' WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();
        } else {
          $query = \app\models\PresupuestosSearch::find()
                      ->select(["conexionsigesp.req as documento",
                              'presupuestos.montoapr as montopre',
                              'empresa_institucion.nombrecompleto as nombre',
                              "empresa_institucion.nrif as nrif",
                              "empresa_institucion.rif as rif",
                              "presupuestos.beneficiario_id",
                              "presupuestos.solicitud_id",
                              "presupuestos.id as id"])
                      ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                      ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                      ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

                  $dataProvider = new ActiveDataProvider([
                          'query' => $query,
                          'pagination' => [
                          'pageSize' => 10,
                      ],
                      ]);

                  Yii::$app->session->setFlash("warning", "El caso no se puede Aprobar, Ya ha sido procesado<br>Verifique e intente con otro caso");

                  $imprime = false;

                return $this->render('muestra', [
                'numero' => $numero,
                'dataProvider' => $dataProvider,
                'consulta' => $consulta,
                'imprime' => $imprime
                ]);

        }

        }

        $hayconcepto = Yii::$app->dbsigesp->createCommand("select count(*) from sep_dt_concepto where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();

        /**INSERTO O ACTUALIZO EN LA TABLA SEP_DT_CONCEPTO DE SIGESP**/

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
                . "', '000000000000000000000AC02', '000000000000000000000"
                . $estructura
                ."', '000000000000000000000"
                .$consulta[$i]['codestpre']
                . "', '0000000000000000000000000', '0000000000000000000000000', 'A', "
                ."'"
                . $cuenta
                . "', '--', '---', 1, "
                . $consulta[$i]['monto']
                . ", "
                . $consulta[$i]['monto']
                . ", 1);")->execute();
        }else { if ((Yii::$app->dbsigesp->createCommand("select estsol from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar())=='E'){
                Yii::$app->dbsigesp->createCommand("UPDATE sep_dt_concepto "
                ." SET "
                ." monpre = ". $consulta[$i]['monto'].  ","
                ." moncon = ". $consulta[$i]['monto']

                . " WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();
                }

        }

        $hayasiento = Yii::$app->dbsigesp->createCommand("select count(*) from sep_cuentagasto where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar();

        /**INSERTO O ACTUALIZO EN LA TABLA SEP_CUENTA GASTO DE SIGESP**/

        if ($hayasiento == 0){
        Yii::$app->dbsigesp->createCommand("INSERT INTO sep_cuentagasto (codemp, numsol, codestpro1, "
                . "codestpro2, codestpro3, codestpro4, codestpro5, estcla, spg_cuenta, codfuefin, "
                ."codcencos, monto) VALUES ('0001', '"
                . "DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                . "', '000000000000000000000AC02', '000000000000000000000"
                . $estructura
                . "', '000000000000000000000"
                . $consulta[$i]['codestpre']
                . "', '0000000000000000000000000', '0000000000000000000000000', 'A', '"
                . $cuenta
                . "', '--', '---', "
                . $consulta[$i]['monto']
                . ");")->execute();
        }else { if ((Yii::$app->dbsigesp->createCommand("select estsol from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar())=='E'){
                Yii::$app->dbsigesp->createCommand("UPDATE sep_cuentagasto "
                ." SET "
                ." monto =  ". $consulta[$i]['monto']
                . " WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();
                }

        }

        $hayconexionsigesp = Yii::$app->db->createCommand("select count(*) from conexionsigesp where id_presupuesto = "
                .$consulta[$i]['id'].";")->queryScalar();

        /**INSERTO O ACTUALIZO EN LA TABLA CONEXION SIGESP DE GESTION**/
        $fechaconminutos = date('Y-m-d H:i:s');
        $idusuario = Yii::$app->user->id;
        if ($hayconexionsigesp == 0){
           Yii::$app->db->createCommand("INSERT INTO conexionsigesp (id_presupuesto, rif, req, codestpre, cuenta, date, created_at, created_by, estatus_sigesp)"
                ."VALUES ('"
                . $consulta[$i]['id']
                . "', '"
                . $consulta[$i]['rif']
                . "', '"
                . "DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                . "', '"
                . "AE01". $estructura . $consulta[$i]['codestpre']
                . "', '"
                . $cuenta
                . "', '"
                . $fechahoy
                . "', '"
                . $fechaconminutos
                . "', '"
                . $idusuario
                . "', 'ELA"
                . "');")->execute();
        }else{
        Yii::$app->db->createCommand("UPDATE conexionsigesp "
                . "SET "
                . "id_presupuesto = ".$consulta[$i]['id']
                . ", rif = '".$consulta[$i]['rif']
                . "', req = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)
                . "', codestpre = 'AE01". $estructura . $consulta[$i]['codestpre']
                . "', cuenta = '".$cuenta
                . "', date= '".$fechahoy
                . "', updated_at= '".$fechaconminutos
                . "', updated_by= '".$idusuario
                . "' WHERE id_presupuesto = ".$consulta[$i]['id'].";")->execute();


        }

        }

        /** CONSULTO SI EL CASO POSEE UNA GESTION SI NO SE LA REGISTRO **/

        $haygestion = Yii::$app->db->createCommand("select count(*) from gestion where solicitud_id = "
                .$numero.";")->queryScalar();

        if ($haygestion == 0){
        Yii::$app->db->createCommand("INSERT INTO gestion (solicitud_id, estatus3_id) VALUES "
                . "("
                . $numero
                .", 61);")->execute();
        }else{
        Yii::$app->db->createCommand("UPDATE gestion "
                . "SET estatus3_id = 61 WHERE solicitud_id = ".$numero.";")->execute();
        }

        /** CONSULTO SI EL CASO POSEE PUNTO DE CUENTA **/

        $haypunto = Yii::$app->db->createCommand("select num_proc from solicitudes where id = "
                    .$numero.";")->queryScalar();

        /** REGISTRO DEL NUMERO DE PUNTO Y AUMENTO DEL NUMERO DE PUNTO EN EL SIGUIENTE CASO **/

        if($haypunto==""){
                $idmemo =  Yii::$app->db->createCommand("SELECT valor FROM configuraciones "
                ." WHERE id = 9;")->queryOne();

               Yii::$app->db->createCommand("UPDATE solicitudes SET "
                    ." estatus = 'PPA',"
                    . "tipo_proc = 'P',"
                    ."fecha_aprobacion = '".$fechahoy
                    ."', num_proc = ".$idmemo['valor']
                    ." WHERE id = ".$numero.";")->execute();

               $nuevoidmemo = $idmemo['valor']+1;
                    Yii::$app->db->createCommand("UPDATE configuraciones SET "
                    ."valor = '".$nuevoidmemo
                    ."' WHERE id = 9;")->queryOne();
        }

        $query = \app\models\PresupuestosSearch::find()
                    ->select(["conexionsigesp.req as documento",
                            'presupuestos.montoapr as montopre',
                            'empresa_institucion.nombrecompleto as nombre',
                            "empresa_institucion.nrif as nrif",
                            "empresa_institucion.rif as rif",
                            "presupuestos.beneficiario_id",
                            "presupuestos.solicitud_id",
                            "presupuestos.id as id"])
                    ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                    ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                    ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

        Yii::$app->session->setFlash("success", "<br>El caso fue aprobado correctamente<br>");


            $usuarioid = Yii::$app->user->id;
            $modeluser = Trabajador::findOne([
                    'user_id' => $usuarioid
            ]);
            if (isset($modeluser)){
            $trabajador = $modeluser->Trabajadorfps;
            $usuarioparabitacora = $modeluser->users_id;
            } else {
            $trabajador = "";
            $usuarioparabitacora = 1;
            }

            $modelbitacora = new Bitacoras;
            $modelbitacora->solicitud_id = $numero;
            $modelbitacora->fecha = date('Y-m-d');
            $modelbitacora->nota = "El trabajador ".$trabajador. " ha aprobado "
                ."satisfactoriamente el caso el día "
                . date('d/m/Y') . " a las " . date('h:i a');
            $modelbitacora->usuario_id = $usuarioparabitacora;
            $modelbitacora->ind_activo = 1;
            $modelbitacora->ind_alarma = 0;
            $modelbitacora->ind_atendida = 0;
            $modelbitacora->version = 0;
            $modelbitacora->created_at = date('Y-m-d H:i:s');
            $modelbitacora->updated_at = date('Y-m-d H:i:s');
            $modelbitacora->save();

            $imprime = true;

        return $this->render('muestra', [
                'numero' => $numero,
                'dataProvider' => $dataProvider,
                'consulta' => $consulta,
                'imprime' => $imprime
                ]);


        //return $this->redirect('imprimir?numero='.$numero);
    }

    public function actionImprimir($numero){

            $query = \app\models\PresupuestosSearch::find()
                    ->select(["conexionsigesp.req  as documento", 'presupuestos.montoapr as montopre', 'empresa_institucion.nombrecompleto as nombre', "CONCAT(empresa_institucion.rif || '-' || empresa_institucion.nrif) as rif" ])
                    ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                    ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                    ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

            $consulta = Yii::$app->db->createCommand("SELECT CONCAT('Caso N: ' || s1.num_solicitud) AS solicitud, "
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
            ."WHERE pr1.solicitud_id = ".$numero)->queryAll();

            $montototal = Yii::$app->db->createCommand("SELECT SUM(monto)FROM presupuestos where solicitud_id = ".$numero)->queryScalar();
            $montototalenletras = strtoupper($this->Valorenletras($montototal, 'Bolivares'));
            $montoapr = Yii::$app->db->createCommand("SELECT SUM(montoapr)FROM presupuestos where solicitud_id = ".$numero)->queryScalar();
            $montoaprenletras = strtoupper($this->Valorenletras($montoapr, 'Bolivares'));




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
    $content = $this->renderPartial('imprimir', [
//            'searchModel' => $searchModel,
            'numero' => $numero,
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

    public function Valorenletras($x, $Moneda )
    {
        $Void = "";
        $SP = " ";
        $Dot = ".";
        $Zero = "0";
        $Neg = "Menos";
        $s="";
        $Ent="";
        $Frc="";
        $Signo="";

        if(floatVal($x) < 0)
         $Signo = $this->Neg . " ";
        else
         $Signo = "";

        if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
          $s = number_format($x,2,'.','');
        else
          $s = number_format($x,2,'.','');

        $Pto = strpos($s, $this->Dot);

        if ($Pto === false)
        {
          $Ent = $s;
          $Frc = $this->Void;
        }
        else
        {
          $Ent = substr($s, 0, $Pto );
          $Frc =  substr($s, $Pto+1);
        }

        if($Ent == $this->Zero || $Ent == $this->Void)
           $s = "Cero ";
        elseif( strlen($Ent) > 7)
        {
           $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) .
                 "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
        }
        else
        {
          $s = $this->SubValLetra(intval($Ent));
        }

        if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
           $s = $s . "de ";

        $s = $s . $Moneda;

        if($Frc != $this->Void)
        {
           $s = $s; //. " " . $Frc. "/100";
           //$s = $s . " " . $Frc . "/100";
        }
        $letrass=$Signo . $s . " M.N.";
        return ($Signo . $s /*. " M.N."*/);

    }


    public function SubValLetra($numero)
    {
        $Void = "";
        $SP = " ";
        $Dot = ".";
        $Zero = "0";
        $Neg = "Menos";
        $Ptr="";
        $n=0;
        $i=0;
        $x ="";
        $Rtn ="";
        $Tem ="";

        $x = trim("$numero");
        $n = strlen($x);

        $Tem = $this->Void;
        $i = $n;

        while( $i > 0)
        {
           $Tem = $this->Parte(intval(substr($x, $n - $i, 1).
                               str_repeat($this->Zero, $i - 1 )));
           If( $Tem != "Cero" )
              $Rtn .= $Tem . $this->SP;
           $i = $i - 1;
        }


        //--------------------- GoSub FiltroMil ------------------------------
        $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
        while(1)
        {
           $Ptr = strpos($Rtn, "Mil ");
           If(!($Ptr===false))
           {
              If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
                $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
              Else
               break;
           }
           else break;
        }

        //--------------------- GoSub FiltroCiento ------------------------------
        $Ptr = -1;
        do{
           $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
           if(!($Ptr===false))
           {
              $Tem = substr($Rtn, $Ptr + 5 ,1);
              if( $Tem == "M" || $Tem == $this->Void)
                 ;
              else
                 $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
           }
        }while(!($Ptr === false));

        //--------------------- FiltroEspeciales ------------------------------
        $Rtn=str_replace("Diez Un", "Once", $Rtn );
        $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
        $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
        $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
        $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
        $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
        $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
        $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
        $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
        $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
        $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
        $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
        $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
        $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
        $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
        $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
        $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
        $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

        //--------------------- FiltroUn ------------------------------
        If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
        //--------------------- Adicionar Y ------------------------------
        for($i=65; $i<=88; $i++)
        {
          If($i != 77)
             $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
        }
        $Rtn=str_replace("*", "a" , $Rtn);
        return($Rtn);
    }


    public function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
    {
        $Void = "";
        $SP = " ";
        $Dot = ".";
        $Zero = "0";
        $Neg = "Menos";
      $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
    }

    public function Parte($x)
    {
        $Void = "";
        $SP = " ";
        $Dot = ".";
        $Zero = "0";
        $Neg = "Menos";

        $Rtn='';
        $t='';
        $i='';
        Do
        {
          switch($x)
          {
             Case 0:  $t = "Cero";break;
             Case 1:  $t = "Un";break;
             Case 2:  $t = "Dos";break;
             Case 3:  $t = "Tres";break;
             Case 4:  $t = "Cuatro";break;
             Case 5:  $t = "Cinco";break;
             Case 6:  $t = "Seis";break;
             Case 7:  $t = "Siete";break;
             Case 8:  $t = "Ocho";break;
             Case 9:  $t = "Nueve";break;
             Case 10: $t = "Diez";break;
             Case 20: $t = "Veinte";break;
             Case 30: $t = "Treinta";break;
             Case 40: $t = "Cuarenta";break;
             Case 50: $t = "Cincuenta";break;
             Case 60: $t = "Sesenta";break;
             Case 70: $t = "Setenta";break;
             Case 80: $t = "Ochenta";break;
             Case 90: $t = "Noventa";break;
             Case 100: $t = "Cien";break;
             Case 200: $t = "Doscientos";break;
             Case 300: $t = "Trescientos";break;
             Case 400: $t = "Cuatrocientos";break;
             Case 500: $t = "Quinientos";break;
             Case 600: $t = "Seiscientos";break;
             Case 700: $t = "Setecientos";break;
             Case 800: $t = "Ochocientos";break;
             Case 900: $t = "Novecientos";break;
             Case 1000: $t = "Mil";break;
             Case 1000000: $t = "Millón";break;
          }

          If($t == $this->Void)
          {
            $i = $i + 1;
            $x = $x / 1000;
            If($x== 0) $i = 0;
          }
          else
             break;

        }while($i != 0);

        $Rtn = $t;
        Switch($i)
        {
           Case 0: $t = $this->Void;break;
           Case 1: $t = " Mil";break;
           Case 2: $t = " Millones";break;
           Case 3: $t = " Billones";break;
        }
        return($Rtn . $t);
    }


    public function actionDevolver($numero)
    {

        // $imprime variable para que imprima el caso lo coloca falso por defecto para que no imprima en devolver
        $imprime = false;

        $consulta = Yii::$app->db->createCommand(
            "SELECT CONCAT('Caso N: ' || s1.num_solicitud) AS solicitud, "
            ."CONCAT('Solicitante: ' ||ps.nombre || ' ' || ps.apellido || ' C.I.: ' ||ps.ci ) AS solicitante, "
            ."CONCAT('Beneficiario: ' ||pb.nombre || ' ' || pb.apellido || COALESCE(' C.I.: ' || pb.ci || ' ', '') ) AS beneficiario, "
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
            ."ei1.rif AS tiporif, "
            ."s1.estatus, "
            ."s1.fecha_aprobacion as fecha, "
            ."ta.cod_acc_int as codestpre, "
            ."pr1.id as id, "
            ."s1.num_solicitud as ndonacion, "
            ."CONCAT('Telefonos: ' || COALESCE(pb.telefono_otro || ' ', '') || COALESCE(pb.telefono_fijo || ' ', '') || COALESCE(pb.telefono_celular || ' ', '') ) as telefonos "
            ."FROM solicitudes s1 FULL OUTER JOIN presupuestos pr1 ON pr1.solicitud_id=s1.id "
            ."JOIN personas pb ON s1.persona_beneficiario_id=pb.id "
            ."JOIN personas ps ON s1.persona_solicitante_id=ps.id "
            ."JOIN areas a1 ON a1.id=s1.area_id "
            ."JOIN tipo_ayudas ta ON a1.tipo_ayuda_id= ta.id "
            ."JOIN requerimientos r1 ON pr1.requerimiento_id=r1.id "
            ."JOIN recepciones r2 ON s1.recepcion_id=r2.id "
            ."JOIN empresa_institucion ei1 ON pr1.beneficiario_id = ei1.id "
            ."WHERE pr1.solicitud_id = :numero;")
                    ->bindValue(":numero", $numero)
                    ->queryAll();

                    $query = \app\models\PresupuestosSearch::find()
                                ->select(["conexionsigesp.req as documento",
                                        'presupuestos.montoapr as montopre',
                                        'empresa_institucion.nombrecompleto as nombre',
                                        "empresa_institucion.nrif as nrif",
                                        "empresa_institucion.rif as rif",
                                        "presupuestos.beneficiario_id",
                                        "presupuestos.solicitud_id",
                                        "presupuestos.id as id"])
                                ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                                ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                                ->andFilterWhere(['presupuestos.solicitud_id' => $numero]);

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);

        $fechahoy = Yii::$app->formatter->asDate('now','php:Y-m-d');

        for ($i=0 ; $i<count($consulta); $i++){

        /**CONSULTO EN LA TABLA SEP_SOLIICITUD DE SIGESP**/

        if ((Yii::$app->dbsigesp->createCommand("select estsol from sep_solicitud where numsol = '"
                ."DON- "
                . $consulta[$i]['ndonacion']."-"
                . ($i+1)
                ."';")->queryScalar())=='E' and $consulta[$i]['estatus']=='PPA')
        {
            /**DELETE DE LA TABLA SEP_DT_CUENTAGASTO**/

            Yii::$app->dbsigesp->createCommand("DELETE FROM sep_cuentagasto "
            ." WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();

            /**DELETE DE LA TABLA SEP_DT_CONCEPTO**/

            Yii::$app->dbsigesp->createCommand("DELETE FROM sep_dt_concepto "
            ." WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();

            /**DELETE DE LA TABLA SEP_SOLICITUD**/
            Yii::$app->dbsigesp->createCommand("DELETE FROM sep_solicitud"
            . " WHERE numsol = 'DON- ".$consulta[$i]['ndonacion']."-".($i+1)."';")->execute();


            /**DELETE DE LA TABLA CONEXIONSIGESP**/

            Yii::$app->db->createCommand("DELETE FROM conexionsigesp "
            . " WHERE id_presupuesto = ".$consulta[$i]['id'].";")->execute();

            /** ACTUALIZO A CASO POR ESTATUS POR APROBAR **/

            Yii::$app->db->createCommand("UPDATE gestion "
            . "SET estatus3_id = 61 WHERE solicitud_id = ".$numero.";")->execute();

        } elseif ($consulta[$i]['estatus']=='APR') {

          /**DEVUELVO EL CASO PORQUE ESTA APROBADO **/

          Yii::$app->session->setFlash("warning", "El caso no se puede devolver, Tiene estatus Aprobado
          <br> Intente con otro caso");


              return $this->render('muestra', [
              'numero' => $numero,
              'dataProvider' => $dataProvider,
              'consulta' => $consulta,
              'imprime' => $imprime
              ]);

        } else{

            /**DEVUELVO A LA VISTA PORQUE EL CASO NO HA PASADO A SIGESP **/

            Yii::$app->session->setFlash("warning", "El caso no se puede devolver, Ya ha sido procesado<br>Verifique e intente con otro caso");

                return $this->render('muestra', [
                'numero' => $numero,
                'dataProvider' => $dataProvider,
                'consulta' => $consulta,
                'imprime' => $imprime
                ]);

        }

        }

        /** ACTUALIZO A CASO POR ESTATUS POR APROBAR SALUD **/

        if ($consulta[0]['tipoayuda']=='Salud')
        {

            Yii::$app->db->createCommand("UPDATE gestion "
                . "SET estatus3_id = 10 WHERE solicitud_id = ".$numero.";")->execute();

        } else {

            Yii::$app->db->createCommand("UPDATE gestion "
                . "SET estatus3_id = 11 WHERE solicitud_id = ".$numero.";")->execute();

        }


        /** CONSULTO SI EL CASO POSEE PUNTO DE CUENTA **/

        $haypunto = Yii::$app->db->createCommand("select num_proc from solicitudes where id = "
                    .$numero.";")->queryScalar();

        /** ELIMINO EL NUMERO DE PUNTO Y DISMINUYO EL NUMERO DE PUNTO EN EL SIGUIENTE CASO **/

        if($haypunto!=""){
                $idmemo =  Yii::$app->db->createCommand("SELECT valor FROM configuraciones "
                ." WHERE id = 9;")->queryOne();

               Yii::$app->db->createCommand("UPDATE solicitudes SET "
                    ." estatus = 'ACA',"
                    . "tipo_proc = '',"
                    ."fecha_aprobacion = null"
                    .", num_proc = null"
                    ." WHERE id = :numero;")
                    ->bindValue(":numero", $numero)
                    ->execute();

               $nuevoidmemo = $idmemo['valor']-1;
                    Yii::$app->db->createCommand("UPDATE configuraciones SET "
                    ."valor = '".$nuevoidmemo
                    ."' WHERE id = 9;")->queryOne();
        }

        /**DEVUELVO A LA VISTA PORQUE EL CASO NO HA PASADO A SIGESP **/

            Yii::$app->session->setFlash("success", "El caso ha sido devuelto exitosamente");

            $usuarioid = Yii::$app->user->id;
            $modeluser = Trabajador::findOne([
                    'user_id' => $usuarioid
            ]);

            if (isset($modeluser)){
            $trabajador = $modeluser->Trabajadorfps;
            $usuarioparabitacora = $modeluser->users_id;
            } else {
            $trabajador = "";
            $usuarioparabitacora = 1;
            }

            $modelbitacora = new Bitacoras;
            $modelbitacora->solicitud_id = $numero;
            $modelbitacora->fecha = date('Y-m-d');
            $modelbitacora->nota = "El trabajador ".$trabajador. " ha devuelto "
                ."satisfactoriamente el caso, el día "
                . date('d/m/Y') . " a las " . date('h:i a');
            $modelbitacora->usuario_id = $usuarioparabitacora;
            $modelbitacora->ind_activo = 1;
            $modelbitacora->ind_alarma = 0;
            $modelbitacora->ind_atendida = 0;
            $modelbitacora->version = 0;
            $modelbitacora->created_at = date('Y-m-d H:i:s');
            $modelbitacora->updated_at = date('Y-m-d H:i:s');
            $modelbitacora->save();

            return $this->render('muestra', [
                'numero' => $numero,
                'dataProvider' => $dataProvider,
                'consulta' => $consulta,
                'imprime' => $imprime
                ]);

    }

 /**** Cambio de estructura Presupuestaria ****/

    public function actionCambioestructura($numsol=null, $codestpro3=null)
    {
        if ($codestpro3 == '0000000000000000000000201'){
        /** Actualizo la tabla de sepsolicitud  **/
        Yii::$app->dbsigesp->createCommand("UPDATE sep_solicitud
             SET codestpro3='0000000000000000000000203'
             WHERE codemp='0001' AND numsol= :numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
        /** Actualizo sep_dt_concepto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_dt_concepto
             SET codestpro3='0000000000000000000000203'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
         /** Actualizo en la tabla sep_cuentagasto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_cuentagasto
             SET codestpro3='0000000000000000000000203'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();

         Yii::$app->session->setFlash("success", "El caso ha sido Cambiado a la Estructura Presupuestaria <br>"
                    . "AC02-0102-203");

          return $this->redirect('index');

        } elseif ($codestpro3 == '0000000000000000000000203') {

         Yii::$app->dbsigesp->createCommand("UPDATE sep_solicitud
             SET codestpro3='0000000000000000000000201'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
        /** Actualizo sep_dt_concepto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_dt_concepto
             SET codestpro3='0000000000000000000000201'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
         /** Actualizo en la tabla sep_cuentagasto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_cuentagasto
             SET codestpro3='0000000000000000000000201'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();

            Yii::$app->session->setFlash("success", "El caso ha sido Cambiado a la Estructura Presupuestaria <br>"
                    . "AC02-0102-201");

            return $this->redirect('index');
        } elseif ($codestpro3 == '0000000000000000000000202') {

         Yii::$app->dbsigesp->createCommand("UPDATE sep_solicitud
             SET codestpro3='0000000000000000000000204'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
        /** Actualizo sep_dt_concepto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_dt_concepto
             SET codestpro3='0000000000000000000000204'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
         /** Actualizo en la tabla sep_cuentagasto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_cuentagasto
             SET codestpro3='0000000000000000000000204'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();

            Yii::$app->session->setFlash("success", "El caso ha sido Cambiado a la Estructura Presupuestaria <br>"
                    . "AC02-0102-204");

            return $this->redirect('index');
        } elseif ($codestpro3 == '0000000000000000000000204') {

         Yii::$app->dbsigesp->createCommand("UPDATE sep_solicitud
             SET codestpro3='0000000000000000000000202'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
        /** Actualizo sep_dt_concepto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_dt_concepto
             SET codestpro3='0000000000000000000000202'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();
         /** Actualizo en la tabla sep_cuentagasto **/
         Yii::$app->dbsigesp->createCommand("UPDATE sep_cuentagasto
             SET codestpro3='0000000000000000000000202'
             WHERE codemp='0001' AND numsol=:numsol;")
                    ->bindValue (":numsol", $numsol)
                    ->execute();

            Yii::$app->session->setFlash("success", "El caso ha sido Cambiado a la Estructura Presupuestaria <br>"
                    . "AC02-0102-202");

            return $this->redirect('index');
        }

    }

}
