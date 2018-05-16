<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
error_reporting(0);

?>

<div class="row">
    <table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px; text-align: center;">
        <tr>
            <td>
                <h3>Entrega de Solicitud N° <?= $modelsolicitud->num_solicitud ?></h3>
            </td>
        </tr>
    </table>
</div>
<br>
<div class="row">
    <table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px; text-align: center;">
        <tr>
            <td>
                <div>
                <?= Html::img(Yii::getAlias('@web')."/img/adjuntos/".$modelfotossolicitud->solicitud_id.'/'.$modelfotossolicitud->foto, ["alt" => "Imagen Entrega", 'style' => "max-width: 90mm; max-height: 90mm;", "class" => "center-block"]) ?>
                </div>
            </td>
        </tr>
    </table>
</div>
<br>
<div class="row">
    <table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12 negro" style="border-collapse: collapse; margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
        <tr class="negro">
            <td colspan="2" class="table-bordered col-xs-6 col-sm-6 col-md-6 col-lg-6 negro" style="margin: 0px; padding: 0px; font-size:18px; border: solid 2px black; text-align: center;">
                <strong>DESCRIPCIÓN DEL CASO</strong>
            </td>

        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<strong>NECESIDAD</strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?= $modelsolicitud->necesidad;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<strong>DESCRIPCIÓN</strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?= $modelsolicitud->descripcion;?>
            </td>
        </tr>
        <tr>
            <td class="table-bordered col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<strong>BENEFICIARIO</strong>
            </td>
            <td class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?php
                echo $modelbeneficiario->nombre . " " . $modelbeneficiario->apellido;
                ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; ">
                &nbsp;<strong>C.I. BENEFICIARIO </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; ">
                &nbsp;<?= $modelbeneficiario->ci;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
               &nbsp;<strong>DIRECCIÓN DEL BENEFICIARIO </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?= strtoupper($modelestado->nombre);?>
            </td>
        </tr>

        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
               &nbsp;<strong>RETIRADO POR</strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?php
                echo $modelretirado->nombre . " " . $modelretirado->apellido;
                ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<strong>C.I. PERSONA QUE RETIRA </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?= $modelretirado->ci;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<strong>RESPONSABLE DE ENTREGA </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
                &nbsp;<?= strtoupper($modelresponsable->dimprofesion). ' '. strtoupper($modelresponsable->primernombre).' '. strtoupper($modelresponsable->primerapellido) ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<strong>FECHA DE ENTREGA </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<?= Yii::$app->formatter->asDate($model->date_entregado,'php:d/m/Y') ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<strong>REGISTRADO POR </strong>
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black;">
              &nbsp;<?= strtoupper($modelentregado->dimprofesion). ' '. strtoupper($modelentregado->primernombre).' '. strtoupper($modelentregado->primerapellido) ?>
            </td>
        </tr>
    </table>


<?php

if ($dataProvider->getTotalCount()==1){
    $titulotablacheques= "El cheque está emitido a favor de: ";
} else {
    $titulotablacheques= "Los cheques estan emitidos a favor de: ";
}
?>



<?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 2px black; font-size:12px;'],
        'layout' => "{items}\n{pager}",

        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 2px black; font-size:12px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:12px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 2px black; font-size:12px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 2px black; font-size:12px;'],
        'caption' => $titulotablacheques,

        'columns' => [
            [
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF; vertical-align:middle;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; vertical-align:middle;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF; vertical-align:middle;'],
             'attribute'=>'chequeforprint',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; vertical-align:middle;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF; vertical-align:middle;'],
             'attribute'=>'tratamiento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; vertical-align:middle;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF; vertical-align:middle;'],
             'attribute'=>'rif',
             'width'=>'80px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ],


            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; vertical-align:middle;'],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF; vertical-align:middle;'],
             'attribute'=>'empresainstitucion',
             //'width'=>'300px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ],

            //'',
            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; vertical-align:middle; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 2px black!important; font-size:12px; vertical-align:middle;'],
            'attribute'=>'monto',
            //'width'=>'150px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF; vertical-align:middle;'],
            ]


        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



    ]); ?>
</div>
