<?php

use yii\helpers\Html;
use kartik\grid\GridView;

?>
<div class="row">
    
<table table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black;">
        <tr>
            <td style="background:#d8d8d8; border: solid 2px black; font-size:13px;"> 
                <strong>5- Asunto: Solicitud de ayuda económica</strong>
            </td>
        </tr>
        <tr>
            <td class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
<!-- Aqui empieza el punto, lo hare con if pegado para evitar errores -->
        
        <?php if (!$consulta[0]['ind_mismo_benef']): ?>
           Se somete a la consideración y aprobación del Presidente de la Fundación Pueblo Soberano, 
        el otorgamiento de ayuda económica solicitada al <strong>Presidente de la República Bolivariana de Venezuela Nicolás Maduro Moros</strong> 
        por <strong><?= strtoupper($consulta[0]['solicitante']) ?></strong> de <strong><?= $consulta[0]['edadsolicitante'] ?></strong> años de edad,  
        <?php if($consulta[0]['tiponacsolic']==2&&$consulta[0]['cisolicitante']>0){ echo "titular de la cédula de identidad <strong> E-".$consulta[0]['cisolicitante'].",</strong>";} ?>
        <?php if($consulta[0]['cisolicitante']>0){ echo "titular de la cédula de identidad <strong> V-".$consulta[0]['cisolicitante'].",</strong>";} ?>
        por la cantidad de <strong><?= $montototalenletras?>. (<?= Yii::$app->formatter->asCurrency($montototal)?>)</strong> a favor del ciudadano(a) 
        <strong><?= strtoupper($consulta[0]['beneficiario']) ?></strong> de <strong><?= $consulta[0]['edadbeneficiario'] ?></strong> años de edad,   
        <?php if($consulta[0]['tiponacbenef']==2&&$consulta[0]['cibeneficiario']>0){ echo "titular de la cédula de identidad <strong> E-".$consulta[0]['beneficiario'].",</strong>";} ?>
        <?php if($consulta[0]['cibeneficiario']>0){ echo "titular de la cédula de identidad <strong> V-".$consulta[0]['cibeneficiario'].",</strong>";} ?>
        quien en virtud del analisis de la documentación  presentada por parte de las Direcciones de Bienestar Social y Administración y Finanzas, 
        requiere ayuda para cubrir y/o tratar la siguiente necesidad <strong> <?= $consulta[0]['necesidad'] ?>.</strong> En tal sentido, la ayuda
        económica va dirigida a cubrir gastos inherentes a los siguientes requerimientos y/o necesidades:
        <strong>
        <?php 
        for ($i=0;$i<count($consulta);$i++)
        {
            echo strtoupper($consulta[$i]['requerimiento']);
            if ($i<count($consulta)-1) { echo ",";}
        }
        echo ".";
        ?>
        </strong>
        <br><br>
        De allí que, en vista de las condiciones socio-económicas del solicitante y de la disponibilidad presupuestaria correspondiente, 
        se recomienda la aprobación para otorgar la ayuda económica, por la cantidad de: <strong><?= $montoaprenletras ?>.</strong>
       <br><br>
       
        <?php else: ?>
        
           Se somete a la consideración y aprobación del Presidente de la Fundación Pueblo Soberano, 
        el otorgamiento de ayuda económica solicitada al <strong>Presidente de la República Bolivariana de Venezuela Nicolás Maduro Moros</strong> 
        por <strong><?= strtoupper($consulta[0]['solicitante']) ?></strong> de <strong><?= $consulta[0]['edadsolicitante'] ?></strong> años de edad,  
        <?php if($consulta[0]['tiponacsolic']==2&&$consulta[0]['cisolicitante']>0){ echo "titular de la cédula de identidad <strong> E-".$consulta[0]['cisolicitante'].",</strong>";} ?>
        <?php if($consulta[0]['cisolicitante']>0){ echo "titular de la cédula de identidad <strong> V-".$consulta[0]['cisolicitante'].",</strong>";} ?>
        por la cantidad de <strong><?= $montototalenletras?>. (<?= Yii::$app->formatter->asCurrency($montototal)?>)</strong> que en virtud del 
        analisis de la documentación  presentada por parte de las Direcciones de Bienestar Social y Administración y Finanzas, 
        requiere ayuda para cubrir y/o tratar la siguiente necesidad <strong> <?= $consulta[0]['necesidad'] ?>.</strong> En tal sentido, la ayuda
        económica va dirigida a cubrir gastos inherentes a los siguientes requerimientos y/o necesidades: 
        <strong>
        <?php 
        for ($i=0;$i<count($consulta);$i++)
        {
            echo strtoupper($consulta[$i]['requerimiento']);
            if ($i<count($consulta)-1) { echo ",";}
        }
        echo ".";
        ?>
        </strong>
        <br><br>
        De allí que, en vista de las condiciones socio-económicas del solicitante y de la disponibilidad presupuestaria correspondiente, 
        se recomienda la aprobación para otorgar la ayuda económica, por la cantidad de: <strong><?= $montoaprenletras ?> (<?= Yii::$app->formatter->asCurrency($montoapr)?>).</strong>
       <br><br>
       
       <?php endif; ?>
        
<!-- Aqui termina el punto -->
         
        </td>
        </tr>
        <tr>
            <td style="border: solid 2px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
                <strong>Observaciones: <?= $consulta[0]['observaciones'] ?></strong>
            </td>
        </tr>
    </table>

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
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;'],
        'layout' => "{items}\n{pager}",
        
        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:12px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;'],
        'caption' => $titulotablacheques,
    
        'columns' => [
            [
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF;'],  
            ],
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF;'],
             'attribute'=>'documento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummary'=>'Cuenta Presupuestaria',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; background: #FFFFFF;'],  
            ],       
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF;'],
             'attribute'=>'nombre',
             'width'=>'300px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummary'=> $estructuraparaimprimir,
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; background: #FFFFFF;'],  
            ],
            
            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black!important; font-size:12px; background: #FFFFFF;'],
             'attribute'=>'rif',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px;'],  
            ],
            
            
            //'',
            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 2px black!important; font-size:12px;'],
            'attribute'=>'montopre',
            'width'=>'150px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_AVG,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 2px black; font-size:12px; #FFFFFF;'],  
            ]
            
                 

            
//           'rif',
//            'req',
//            'codestpre',
            // 'cuenta',
            // 'date',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

//            [
//                'class' => 'yii\grid\ActionColumn',

//            ],
        ],
        'responsive'=>false,
        'condensed'=>true,
        'bordered'=>true,

        
        
    ]); ?>
</div>
