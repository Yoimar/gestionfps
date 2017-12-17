<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
echo AlertBlock::widget([ 
   'type' => AlertBlock::TYPE_ALERT,
   'useSessionFlash' => true,
]);

if(Yii::$app->request->post()){
    
}else {
    $seleccion =0;
}

print_r($seleccion);
?>

<?=Html::beginForm(['site/bulk'],'post');?>
<?=Html::dropDownList('action','',['Holassss'=>'Mark selected as: ','Hello'=>'Confirmed','Hi'=>'No Confirmed'],['class'=>'dropdown',])?>
<?=Html::submitButton('Send', ['class' => 'btn btn-info',]);?>

    
<?php
$query = \app\models\PresupuestosSearch::find()
                    ->select(["CONCAT(conexionsigesp.req || ' // ' || presupuestos.documento_id) as documento", 'presupuestos.montoapr as montopre', 'empresa_institucion.nombrecompleto as nombre', "empresa_institucion.nrif as rif" ])
                    ->join('LEFT JOIN', 'conexionsigesp', 'conexionsigesp.id_presupuesto = presupuestos.id')
                    ->join('LEFT JOIN', 'empresa_institucion', 'empresa_institucion.id = presupuestos.beneficiario_id')
                    ->andFilterWhere(['presupuestos.solicitud_id' => 89660]);

            $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            ]);
            
echo GridView::widget([
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
        'caption' => 'Cheques',
    
        'columns' => [
//            [
//             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
//             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
//             'attribute'=>'rif',
//             'pageSummary'=>'Total',
//             'hAlign'=>'center',
//             'vAlign'=>'middle',
//             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
//            ],
            
//            [
//                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
//                'class'=>'kartik\grid\SerialColumn',
//                'width'=>'10px',
//                'hAlign'=>'center',
//                'vAlign'=>'middle',
//                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
//            ],
//            
//            [
//             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
//             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
//             'attribute'=>'documento',
//             'hAlign'=>'center',
//             'vAlign'=>'middle',
//             'pageSummary'=>'Cuenta Presupuestaria',
//             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
//            ],       
//            
//            [
//             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
//             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px;'],
//             'attribute'=>'nombre',
//             'width'=>'500px',
//             'hAlign'=>'center',
//             'vAlign'=>'middle',
//             'pageSummary'=> '401010101',
//             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
//            ],
//            
//            
//            
//            
//            //'',
//            [
//            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; '],
//            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center;  font-size:16px;'],
//            'attribute'=>'montopre',
//            'width'=>'150px',
//            'hAlign'=>'center',
//            'vAlign'=>'middle',
//            'format'=>'currency',
//            'pageSummary'=>true,
//            'pageSummaryFunc'=>GridView::F_AVG,
//            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px;  font-size:16px; background: #FFFFFF;'],  
//            ],
//            
                 

           'id',
           'rif',
//            'req',
//            'codestpre',
            // 'cuenta',
            // 'date',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
            'class' => '\kartik\grid\CheckboxColumn',
            'checkboxOptions' => function($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },

            ],
            ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,

        
        
    ]); ?>

<br><br>

<center>
<?= Html::button('<span class="glyphicon glyphicon-ok-sign"></span>SIGESP',  ['class' => 'btn btn-primary', 'id' => 'myButton']) ?>
    
<?= Html::button('<span class="glyphicon glyphicon-ok-sign"></span>Prueba',  ['class' => 'btn btn-primary', 'id' => 'laprueba']) ?>
</center>

?>
<?= Html::endForm();?> 
<?php



$this->registerJs(<<<JS
    
   $('#myButton').on('click', function() { alert( 'Hola' ); });
   
   $('#laprueba').on('click', function() { alert( 'Que mas Como esta la vaina' ); }); 
JS

);


