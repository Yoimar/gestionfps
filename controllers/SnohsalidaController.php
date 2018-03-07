<?php

namespace app\controllers;

use Yii;
use app\models\Snohsalida;
use app\models\SnohsalidaSearch;
use app\models\Snohsalidaaportes;
use app\models\Parteindividual;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Html;

/**
 * SnohsalidaController implements the CRUD actions for Snohsalida model.
 */
class SnohsalidaController extends Controller
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
     * Lists all Snohsalida models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SnohsalidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Snohsalida model.
     * @param string $codemp
     * @param string $codnom
     * @param string $codper
     * @param string $anocur
     * @param string $codperi
     * @param string $codconc
     * @param string $tipsal
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal)
    {
        return $this->render('view', [
            'model' => $this->findModel($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal),
        ]);
    }

    /**
     * Creates a new Snohsalida model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Snohsalida();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'codnom' => $model->codnom, 'codper' => $model->codper, 'anocur' => $model->anocur, 'codperi' => $model->codperi, 'codconc' => $model->codconc, 'tipsal' => $model->tipsal]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Snohsalida model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $codemp
     * @param string $codnom
     * @param string $codper
     * @param string $anocur
     * @param string $codperi
     * @param string $codconc
     * @param string $tipsal
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal)
    {
        $model = $this->findModel($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemp' => $model->codemp, 'codnom' => $model->codnom, 'codper' => $model->codper, 'anocur' => $model->anocur, 'codperi' => $model->codperi, 'codconc' => $model->codconc, 'tipsal' => $model->tipsal]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Snohsalida model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $codemp
     * @param string $codnom
     * @param string $codper
     * @param string $anocur
     * @param string $codperi
     * @param string $codconc
     * @param string $tipsal
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal)
    {
        $this->findModel($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Snohsalida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $codemp
     * @param string $codnom
     * @param string $codper
     * @param string $anocur
     * @param string $codperi
     * @param string $codconc
     * @param string $tipsal
     * @return Snohsalida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codemp, $codnom, $codper, $anocur, $codperi, $codconc, $tipsal)
    {
        if (($model = Snohsalida::findOne(['codemp' => $codemp, 'codnom' => $codnom, 'codper' => $codper, 'anocur' => $anocur, 'codperi' => $codperi, 'codconc' => $codconc, 'tipsal' => $tipsal])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReporteaportes()
    {
        $model = new Parteindividual();

        $searchModel = new Snohsalidaaportes();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $vistaimprimir = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            switch ($model->anho) {
                case '2018':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.anocur'=> $model->anho,
                    ]);
                    break;

                default:
                    break;
            }

            switch ($model->mes) {
                case '1':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['001', '002'],
                    ]);
                    break;
                case '2':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['003', '004'],
                    ]);
                    break;
                case '3':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['005', '006'],
                    ]);
                    break;
                case '4':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['007', '008'],
                    ]);
                    break;
                case '5':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['009', '010'],
                    ]);
                    break;
                case '6':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['011', '012'],
                    ]);
                    break;
                case '7':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['013', '014'],
                    ]);
                    break;
                case '8':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['015', '016'],
                    ]);
                    break;
                case '9':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['017', '018'],
                    ]);
                    break;
                case '10':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['019', '020'],
                    ]);
                    break;
                case '11':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['021', '022'],
                    ]);
                    break;
                case '12':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codperi'=> ['023', '024'],
                    ]);
                    break;

                default:
                    break;
            }
            switch ($model->tipoempleado) {
                //Empleado
                case '1':
                    $dataProvider->query->andWhere([
                        'not in',
                        'sno_hsalida.codnom',
                        ['0400', '0600']
                    ]);
                    break;
                //Obrero
                case '2':
                    $dataProvider->query->andWhere([
                        'sno_hsalida.codnom' => ['0400', '0600'],
                    ]);
                    break;
                //Todos
                default:
                    break;
            }
            $vistaimprimir = true;
        }
        return $this->render('reporteaportes', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vistaimprimir' => $vistaimprimir,
        ]);
    }

    public function actionImprimir($ano=null,$mes=null)
    {
        switch ($mes) {
            case '1':
                $mesnombre = "mes de enero del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('001', '002')";
                break;
            case '2':
                $mesnombre = "mes de febrero del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('003', '004')";
                break;
            case '3':
                $mesnombre = "mes de marzo del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('005', '006')";
                break;
            case '4':
                $mesnombre = "mes de abril del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('007', '008')";
                break;
            case '5':
                $mesnombre = "mes de mayo del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('009', '010')";
                break;
            case '6':
                $mesnombre = "mes de junio del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('011', '012')";
                break;
            case '7':
                $mesnombre = "mes de julio del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('013', '014')";
                break;
            case '8':
                $mesnombre = "mes de agosto del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('015', '016')";
                break;
            case '9':
                $mesnombre = "mes de septiembre del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('017', '018')";
                break;
            case '10':
                $mesnombre = "mes de octubre del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('019', '020')";
                break;
            case '11':
                $mesnombre = "mes de noviembre del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('021', '022')";
                break;
            case '12':
                $mesnombre = "mes de diciembre del Año ".$ano;
                $filtrosql = "and sno_hsalida.codperi in ('023', '024')";
                break;
        }


        $consultaivss = Yii::$app->dbsigesp->createCommand("select rifben, nombene, tipo, sum(retencion) as retencion, sum(aporte) as aporte, sum(aporte+retencion) as total
from
(select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'todos' as tipo,
-sno_hsalida.valsal as retencion,
0 as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P1'
and sno_hsalida.codconc <> '0000000053' "
.$filtrosql
." union all
select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'todos' as tipo,
0 as retencion,
-sno_hsalida.valsal as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P2'
and sno_hsalida.codconc <> '0000000053' "
.$filtrosql
."
union all
select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'empleado' as tipo,
-sno_hsalida.valsal as retencion,
0 as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P1'
and sno_hsalida.codconc = '0000000053'
and sno_hsalida.codnom in ('0100', '0200', '0300', '0500', '0700', '0800')
"
.$filtrosql
."
union all
select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'empleado' as tipo,
0 as retencion,
-sno_hsalida.valsal as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P2'
and sno_hsalida.codconc = '0000000053'
and sno_hsalida.codnom in ('0100', '0200', '0300', '0500', '0700', '0800')
 "
.$filtrosql
."
union all
select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'obrero' as tipo,
-sno_hsalida.valsal as retencion,
0 as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P1'
and sno_hsalida.codconc = '0000000053'
and sno_hsalida.codnom in ('0400', '0600')
 "
.$filtrosql
."
union all
select
rpc_beneficiario.rifben,
rpc_beneficiario.nombene,
rpc_beneficiario.apebene,
sno_hconcepto.nomcon,
'obrero' as tipo,
0 as retencion,
-sno_hsalida.valsal as aporte
from
sno_hsalida
join sno_hconcepto
on sno_hsalida.anocur = sno_hconcepto.anocur
and sno_hsalida.codperi = sno_hconcepto.codperi
and sno_hsalida.codconc = sno_hconcepto.codconc
and sno_hsalida.codnom = sno_hconcepto.codnom
join rpc_beneficiario
on rpc_beneficiario.ced_bene = sno_hconcepto.cedben
where
sno_hsalida.tipsal = 'P2'
and sno_hsalida.codconc = '0000000053'
and sno_hsalida.codnom in ('0400', '0600')
 "
.$filtrosql
." ) as w
group by rifben, nombene, tipo
order by rifben;")->queryAll();


        $usuarioorigen = 'Cap. Enmanuel Gonzalez<br>';
        $direccionorigen = 'Director de la Oficina de Gestión Humana <br>';
        $usuariofinal = 'Ptte. Miguel Castillo <br>';
        $direccionfinal = 'Direccion de Administración y Finanzas<br>';

        $headerHtml = '<div class="row">'
        .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left"])
        .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "450", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"])
        .'</div>'
                .'<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px;">'
        .'    <tr>'
        .'     <td colspan="4" class="text-center col-xs-8 col-sm-8 col-md-8 col-lg-8" style="font-size:12px;">'
        .'     </td>'
        .'     <td colspan="2" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4" style="font-size:12px;">'
        .'<br>  '
        . date('d/m/Y').'<br> '
        .'      </td>'
        .'      </tr>'
        .'        <tr>'
        .'         <td  colspan="6" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4 col-lg-offset-4" style="font-size:18px;">'
        .'REMISIÓN DE PAGOS DE APORTES PATRONALES'
        .'         </td >'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .'Enviado por:'
        .'            </td>'
        .'          <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        .$usuarioorigen
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
        . $direccionfinal
        .'            </td>'
        .'             <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'        </tr>'
        .'        <tr>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
        .'            Asunto:'
        .'            </td>'
        .'            <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
        .'Pagos de Aportes y Retenciones Laborales correspondientes al '.$mesnombre
        .'            </td>'
        .'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
        .'             </tr>'
        .'</table>'
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
       .'</div></center>'
       .'<p style="text-align:right;"><small> Documento Impreso el dia {DATE j/m/Y}</small></p>';
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('imprimir', [
                'consultaivss' => $consultaivss,
                'mesnombre' => $mesnombre,

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
            'options' => ['title' => 'Memorrhh'],
             // call mPDF methods on the fly
            'marginTop' => '80',

            'methods' => [
                'SetHTMLHeader'=>[$headerHtml, [ 'E', [TRUE]]],
                'SetHTMLFooter'=>[$footerHtml, [ 'E', [TRUE]]],
            ],

        ]);

            // return the pdf output as per the destination setting
            return $pdf->render();

        }
}
