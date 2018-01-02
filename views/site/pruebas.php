<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
echo AlertBlock::widget([ 
   'type' => AlertBlock::TYPE_ALERT,
   'useSessionFlash' => true,
]);

if(Yii::$app->request->post()){
    
}else {
    $seleccion =0;
}
echo Yii::$app->formatter->asCurrency("80");
$fechahoy = Yii::$app->formatter->asDate('now','php:d/m/Y');
echo "<br>".$fechahoy."<br>";
$consultaestatus = Yii::$app->db->createCommand("SELECT estatus "
                    ."FROM solicitudes "
                    ."WHERE id = 90034")->queryScalar();
print_r($consultaestatus);
echo $consultaestatus;
    
echo DateTimePicker::widget([
    'name' => 'dp_2',
    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
    'value' => Yii::$app->formatter->asDate('now','php:d/m/Y'),
    'pluginOptions' => [
        'autoclose'=>true,
        'viewSelect' => 'day',
        'format' => 'dd/mm/yyyy',
    ]
]);
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

<?= Html::endForm();?> 
 <div class="row">
<?php
echo Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left"]);
echo Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "450", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"]);
?>
  </div>'
.'<div class="row"><table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px;">'
.'    <tr>'
.'     <td colspan="4" class="text-center col-xs-8 col-sm-8 col-md-8 col-lg-8" style="font-size:12px;">'
.'        mas izquierda'
.'          mas centro'
.'     </td>'
.'     <td colspan="2" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4" style="font-size:12px;">'
.'         fecha del carajo <br>  '
.'         Relacion N° 125455'
.'      </td>'
.'      </tr>'
.'        <tr>'
.'         <td  colspan="6" class="text-center col-xs-4 col-sm-4 col-md-4 col-lg-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4 col-lg-offset-4" style="font-size:18px;">'
.'          RELACIÓN DE CASOS'
.'         </td >'
.'        </tr>'
.'        <tr>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
.'             Enviado Por:'
.'            </td>'
.'          <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
.'               Pedro Perez <br>'
.'               Unidad de Atención Al Soberano<br>'
.'              Direccion de Bienestar Social '
.'         </td>'
.'         <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'        </tr>'
.'        <tr>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'          <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
.'         Recibido Por:'
.'          </td>'
.'          <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
.'                Lic. Miley Carrillo <br>'
.'               Unidad de Contabilidad <br>'
.'        Direccion de Administración '
.'            </td>'
.'             <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'        </tr>'
.'        <tr>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
.'            Estatus Actual:'
.'            </td>'
.'            <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
.'              Por Aprobación Contable'
.'            </td>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'        </tr>'
.'        <tr>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2" style="font-size:14px;">'
.'            Asunto:'
.'            </td>'
.'            <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="font-size:14px;">'
.'                Envio de 1 Caso por Instrucciones del Mayor Zambrano'
.'            </td>'
.'            <td class="text-center col-xs-2 col-sm-2 col-md-2 col-lg-2"></td>'
.'             </tr>'
.'</table>'
.'</div>';


 <?php



$this->registerJs(<<<JS
    
   $('#myButton').on('click', function() { alert( 'Hola' ); });
   
   $('#laprueba').on('click', function() { alert( 'Que mas Como esta la vaina' ); }); 
JS

);


