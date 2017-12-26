<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

?>


<div class="row">
    <?= Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "160 px", "class" => "pull-left"]) ?>
    <?= Html::img("@web/img/despacho.png", ["alt" => "Logo Fundación", "width" => "500 px", "class" => "pull-right"]) ?>
</div>

<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center"><?= "Caso N° -".$consulta[0]['ndonacion']?></h3>
  </div>
   <ul class="list-group">
    <li class="list-group-item"><?= $consulta[0]['solicitante']?></li>
    <li class="list-group-item"><?= $consulta[0]['beneficiario']?></li>
    <li class="list-group-item"><?= $consulta[0]['requerimiento']?></li>
    <li class="list-group-item"><?= $consulta[0]['tipoayuda']?></li>
    <li class="list-group-item"><?= $consulta[0]['area']?></li>
    <li class="list-group-item"><?= $consulta[0]['necesidad']?></li>
    <li class="list-group-item"><?= $consulta[0]['descripcion']?></li>
  </ul>
</div>




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
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
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
            ]
            
                 
        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,

        
        
    ]); ?>

<br><br>

<center>
<?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>Enviar a SIGESP', ['sepsolicitud/inserta', 'numero' => $numero], ['class' => 'btn btn-primary']) ?>
</center>


