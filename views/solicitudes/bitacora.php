<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\MaskedInput;
error_reporting(0);
$label = 'style="border-left: solid 1px black;
border-top: solid 1px black;
border-right: solid 1px black;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:10px;"';
$labelbitacoraright = 'style="border-left: solid 1px black;
border-top: solid 1px black;
border-right: none;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:10px;"';
$labelbitacoracenter = 'style="border-left: none;
border-top: solid 1px black;
border-right: none;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:10px;"';
$labelbitacoraleft = 'style="border-left: none;
border-top: solid 1px black;
border-right: solid 1px black;
border-bottom: none;
text-align:right;
margin: 0px; padding: 0px;
font-size:10px;"';
$dato = 'style="border-left: solid 1px black;
border-bottom: solid 1px black;
border-right: solid 1px black;
border-top: none;
text-align:right; margin: 0px; padding: 0px; font-size:10px;"';
$datobitacora = 'style="border-left: solid 1px black;
border-bottom: solid 1px black;
border-right: solid 1px black;
border-top: none;
text-align:right; margin: 0px; padding: 2px; font-size:12px;"';

?>
<div class="row">

<table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 0mm; margin-bottom: 0mm;" >
    <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
            <strong>INFORMACIÓN</strong>
        </td>
    </tr>
    <!-- Linea de Estatus -->
    <tr>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>ESTATUS 1:</strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>ESTATUS 2:</strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>ESTATUS 3:</strong></small>
    </td>
    </tr>
    <tr>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->gestion->estatus3->estatus2->estatus1->nombre) ?>&nbsp;
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->gestion->estatus3->estatus2->nombre) ?>&nbsp;
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->gestion->estatus3->nombre) ?>&nbsp;
    </td>
    </tr>
    <tr>
        <td colspan="6" class="text-center" <?= $label ?> >
            <strong>ACTIVIDAD</strong>
        </td>
    </tr>
    <tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 1px black; border-top:none; text-align:justify; margin: 0px; padding: 2px; font-size:10px;" >
        <?= strtoupper($solicitudessearch->gestion->programaevento->descripcion) ?>&nbsp;
    </td>
    </tr>
    <tr>
        <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $label ?> >
            <small><strong>REFERENCIA:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>OFICIAL A CARGO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>ESTADO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>FECHA:</strong></small>
        </td>
        </tr>
        <tr>
        <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->gestion->programaevento->referencia->nombre) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->gestion->programaevento->trabajador->Trabajadorfps) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->gestion->programaevento->parroquia->estado->nombre) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDate($solicitudessearch->gestion->programaevento->fechaprograma) ?>&nbsp;
        </td>
    </tr>
    <tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $label ?> >
        <small><strong>DESCRIPCION:</strong></small>
    </td>
    </tr>
    <tr>
        <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->descripcion) ?>
        </td>
    </tr>
    <tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $label ?> >
        <small><strong>NECESIDAD:</strong></small>
    </td>
    </tr>
    <tr>
        <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->necesidad) ?>
        </td>
    </tr>
    <tr>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>UNIDAD:</strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>TIPO DE AYUDA:</strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>ÁREA:</strong></small>
    </td>
    </tr>
    <tr>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->recepcion->nombre) ?>&nbsp;
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->area->tipoAyuda->nombre) ?>&nbsp;
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->area->nombre) ?>&nbsp;
    </td>
    </tr>
    
    
    <?php if ($solicitudessearch->personabeneficiario->id!=$solicitudessearch->personasolicitante->id): ?>
        <!-- Primera Linea de Datos -->
        <tr>
        <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
            <small><strong>SOLICITANTE:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>C.I.:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>FECHA DE NAC:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>ESTADO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>TELÉFONO:</strong></small>
        </td>
        </tr>
        <tr>
        <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personasolicitante->nombrecompleto) ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDecimal($solicitudessearch->personasolicitante->ci,0) ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDate($solicitudessearch->personasolicitante->fecha_nacimiento) ?>&nbsp;
            (<?= $solicitudessearch->personasolicitante->edad ?>)&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personasolicitante->parroquia->estado->nombre) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?=
            isset($solicitudessearch->personasolicitante->telefono_fijo)?$solicitudessearch->personasolicitante->telefono_fijo:$solicitudessearch->personasolicitante->telefono_celular
            ?> &nbsp;
        </td>
    </tr>
<?php endif; ?>
    
    <!-- Primera Linea de Datos -->
        <tr>
        <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
            <small><strong>BENEFICIARIO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>C.I.:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>FECHA DE NAC:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>ESTADO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>TELÉFONO:</strong></small>
        </td>
        </tr>
        <tr>
        <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personabeneficiario->nombrecompleto) ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDecimal($solicitudessearch->personabeneficiario->ci,0) ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDate($solicitudessearch->personabeneficiario->fecha_nacimiento) ?>&nbsp;
            (<?= $solicitudessearch->personabeneficiario->edad ?>)&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personabeneficiario->parroquia->estado->nombre) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?=
            isset($solicitudessearch->personabeneficiario->telefono_fijo)?$solicitudessearch->personabeneficiario->telefono_fijo:$solicitudessearch->personabeneficiario->telefono_celular
            ?> &nbsp;
        </td>
    </tr>
    <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
            <strong>SEGUIMIENTO</strong>
        </td>
    </tr>
<?php
$modelosbitacoras = $dataProviderBitacoras->getModels();
        
        foreach ($modelosbitacoras as $bitacoras):
            
?>
    <tr>
        <td colspan="1" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $labelbitacoraright ?>>
        <small>FECHA: <?= Yii::$app->formatter->asDate($bitacoras->fecha) ?></small>
    </td>
    <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $labelbitacoracenter ?> >
        <small><strong></strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $labelbitacoraleft ?> >
        <small><?= strtoupper($bitacoras->usuario->nombre) ?></small>
    </td>
    </tr>
    <tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" <?= $datobitacora ?> >
        <?= strtoupper($bitacoras->nota) ?>&nbsp;
    </td>
    </tr>
            

                
<?php            
        endforeach;
?>

<?php

    $modelos = $dataProvider->getModels();

    if ($dataProvider->getTotalcount()!=0):
        //If para el Data Provider por Estatus APR y Orden de Pago
        if($solicitudessearch->estatus == 'APR' && $modelos[0]['proceso_id']==1):
?>
<tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
</tr>
</table>



<?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
        'layout' => "{items}\n{pager}",

        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        //'caption' => $titulotablacheques,

        'columns' => [
            [
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'tratamiento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'empresaoinstitucion',
             'width'=>'270px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'rif',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'documento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'numop',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'cheque',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'montoapr',
            'label' => 'Monto',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ]

        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



    ]); ?>

    <?php
    //End If si es Aprobado y Es una Orden de Pago
    endif;

    //IF si esta procesado y es una orden de Pago

    if($solicitudessearch->estatus == 'PPA' && $modelos[0]['proceso_id']==1):
    ?>
    <tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
    <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
    </tr>
    </table>



    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,

    'showPageSummary' => true,
    'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
    'layout' => "{items}\n{pager}",

    'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
    'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
    'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    //'caption' => $titulotablacheques,

    'columns' => [
        [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
            'class'=>'kartik\grid\SerialColumn',
            'width'=>'10px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'tratamiento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'empresaoinstitucion',
         'width'=>'270px',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'rif',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'documento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'proceso',
         'pageSummary'=>'Total',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
        'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
        'attribute'=>'montoapr',
        'label' => 'Monto',
        'width'=>'120px',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'format'=>'currency',
        'pageSummary'=>true,
        'pageSummaryFunc'=>GridView::F_SUM,
        'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ]

    ],
    'responsive'=>true,
    'condensed'=>true,
    'bordered'=>true,



    ]); ?>

    <?php
    //End If si PPA Y Es una Orden de Pago
    endif;

    //If para determinar si es una solicitud diferente de Orden de Pago
    if(($solicitudessearch->estatus == 'PPA' || $solicitudessearch->estatus == 'APR' || $solicitudessearch->estatus == 'ACA' ) && $modelos[0]['proceso_id']!=1):
    ?>
    <tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
    <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
    </tr>
    </table>



    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,

    'showPageSummary' => true,
    'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
    'layout' => "{items}\n{pager}",

    'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
    'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
    'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    //'caption' => $titulotablacheques,

    'columns' => [
        [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
            'class'=>'kartik\grid\SerialColumn',
            'width'=>'10px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'tratamiento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'proceso',
         'pageSummary'=>'Total',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
        'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
        'attribute'=>'cantidad',
        'label' => 'Cantidad',
        'width'=>'120px',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'format'=>'decimal',
        'pageSummary'=>true,
        'pageSummaryFunc'=>GridView::F_SUM,
        'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ]

    ],
    'responsive'=>true,
    'condensed'=>true,
    'bordered'=>true,



    ]); ?>

    <?php
    //End If si PPA o APR Y Es diferente de Orden de Pago
    endif;

    //If PARA EL PERRAJE ELA, ACA, EAA, CER, ANU, DEV, ART, ELD Y Es una Orden de Pago
        if((
            $solicitudessearch->estatus == 'ELA'
            || $solicitudessearch->estatus == 'ACA'
            || $solicitudessearch->estatus == 'EAA'
            || $solicitudessearch->estatus == 'CER'
            || $solicitudessearch->estatus == 'ANU'
            || $solicitudessearch->estatus == 'DEV'
            || $solicitudessearch->estatus == 'ART'
            || $solicitudessearch->estatus == 'ELD'
            )  && $modelos[0]['proceso_id']==1 ):
        ?>
        <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>DETALLE DE LA SOLICITUD</strong>
        </td>
        </tr>
        </table>



        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
        'layout' => "{items}\n{pager}",

        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        //'caption' => $titulotablacheques,

        'columns' => [
            [
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'tratamiento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'empresaoinstitucion',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'rif',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

            ],



            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'proceso',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'cantidad',
            'label' => 'Cantidad',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'decimal',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'monto',
            'label' => 'Monto Solicitado',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'montoapr',
            'label' => 'Monto Aprobado',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],


        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



        ]); ?>

        <?php
        //End If si ELA, ACA, EAA, CER, ANU, DEV, ART, ELD Y Es una Orden de Pago
        endif;

    else:
    ?>
    </table>
    <?php
    //End If pertenece al vacio del Gridview
    endif;
    ?>

</div>
