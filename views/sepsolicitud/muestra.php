<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

?>

<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center"><?= "Caso N° -".$consulta[0]['ndonacion']?></h3>
  </div>
<div class="panel-body">
    <div class="col-lg-6 col-md-6">
        <?= $consulta[0]['solicitante']?> 
        <br>
        <?= $consulta[0]['beneficiario']?>
        <br>    
        <?= $consulta[0]['requerimiento']?>
    </div>
    <div class="col-lg-6 col-md-6">
        <?= $consulta[0]['tipoayuda']?>
        <br>
        <?= $consulta[0]['area']?>
        <br>
        <?= $consulta[0]['necesidad']?>
    </div>
    <div class="col-lg-12 col-md-12">
        <hr><center>
        <?= $consulta[0]['descripcion']?>
        <hr></center>
    

<?php if ($consulta[0]['codestpre'] == 0201){
    $estructuraparaimprimir= "407010201";
} else {
    $estructuraparaimprimir= "407010401";
}
if (count($consulta)<=1){
    $titulotablacheques= "El cheque esta emitido a favor de: ";
} else {
    $titulotablacheques= "Los cheques serán emitidos a favor de: ";
}
?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center',],
        'layout' => "{items}\n{pager}",
        
        'options' => ['class' => 'text-center primary', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:16px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
        'caption' => $titulotablacheques,
    
        'columns' => [
            [
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
            ],
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
             'attribute'=>'documento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummary'=>'Cuenta Presupuestaria',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
            ],       
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
             'attribute'=>'nombre',
             'width'=>'500px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummary'=> $estructuraparaimprimir,
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
            ],
             
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
             'attribute'=>'rif',
             'label' => 'TIPO RIF',
             'pageSummary'=>'',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
            ],
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
             'attribute'=>'nrif',
             'label' => 'RIF',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
            ],
            
            
            //'',
            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center;  font-size:16px;'],
            'attribute'=>'montopre',
            'width'=>'150px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
            ],
            
            [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                    yii\helpers\Url::to(['empresainstitucion/updates', 'id' => $model->beneficiario_id, 'volver' => $model->solicitud_id]),
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                );
                }
            ],
            ],
            
                 
        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,

        
        
    ]); ?>

<br>

<center>
<?= Html::a('<span class="glyphicon glyphicon-remove"></span>Devolver de SIGESP', ['sepsolicitud/devolver', 'numero' => $numero], ['class' => 'btn btn-danger']) ?>

<?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>Enviar a SIGESP', ['sepsolicitud/inserta', 'numero' => $numero], ['class' => 'btn btn-primary']) ?>
</center>

<center>
    
<?= Html::a('<span class="glyphicon glyphicon-print"></span>', ['sepsolicitud/imprimir', 'numero' => $numero], ['class' => 'btn btn-info', 'target'=>'_blank']) ?>    
    
</center>

</div>

</div>
   
</div>

<center>
<div class="col-lg-12 col-md-12">

     <div>
         <?php
            echo AlertBlock::widget([
                    'useSessionFlash' => true,
                    'type' => AlertBlock::TYPE_GROWL,
                    'delay' => 0,
                    'alertSettings' => [
                        'success' => ['type' => Growl::TYPE_SUCCESS, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]], 
                        'danger' => ['type' => Growl::TYPE_DANGER, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]], 
                        'warning' => ['type' => Growl::TYPE_WARNING, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]], 
                        'info' => ['type' => Growl::TYPE_INFO, 'pluginOptions' => ['placement' => ['from' => 'top', 'align' => 'center']]]
                        ],
                     ])
         ?>
        </div>
</div>
</center>


