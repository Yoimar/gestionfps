<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\Progress;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
use app\models\Presupuestos;

 //creo la direccion para guardar la imagen que se llama adjuntos

$aliasyii = Yii::getAlias('@yii');
$aliasapp = Yii::getAlias('@app');
$aliasruntime = Yii::getAlias('@runtime');
$aliasweb = Yii::getAlias('@web');
$aliaswebroot = Yii::getAlias('@webroot');
$aliasvendor = Yii::getAlias('@vendor');
$aliasbower = Yii::getAlias('@bower');
$aliasnpm = Yii::getAlias('@npm');
$path = Yii::getAlias('@app').'\web\img\adjuntos';
$prueba1 = Yii::getAlias('@web').'/img/MarkerMapHospital.png';

echo "<br>".$prueba1."<br>";

            //$path =  Yii::getAlias('@app')."/nombre" ;
            $prueba = Url::home();

 echo "<br>".$path."<br>";
 echo $prueba;
 echo $aliasyii . "<br>";
 echo $aliasapp . "   <- app<br>";
 echo $aliasruntime . "<br>";
 echo $aliasweb . "<br>";
 echo $aliaswebroot . "<br>";
 echo $aliasvendor . "<br>";
 echo $aliasbower . "<br>";
 echo $aliasnpm . "<br>";
/* @var $this yii\web\View */
echo AlertBlock::widget([
   'type' => AlertBlock::TYPE_ALERT,
   'useSessionFlash' => true,
]);
// default with label
echo Progress::widget([
    'percent' => 60,
    'label' => 'test',
]);

// styled
echo Progress::widget([
    'percent' => 65,
    'barOptions' => ['class' => 'progress-bar-info'],
    'label' => '70%',
]);

// striped
echo Progress::widget([
    'percent' => 70,
    'barOptions' => ['class' => 'progress-bar-warning'],
    'options' => ['class' => 'progress-striped'],
    'label' => '70%',
]);

// striped animated
echo Progress::widget([
    'percent' => 70,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);

// stacked bars
echo Progress::widget([
    'bars' => [
        ['percent' => 30, 'options' => ['class' => 'progress-bar-danger']],
        ['percent' => 30, 'label' => 'test', 'options' => ['class' => 'progress-bar-success']],
        ['percent' => 35, 'options' => ['class' => 'progress-bar-warning']],
    ]
]);

echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur 12cliche...',
            // open its content by default
            'contentOptions' => ['class' => 'in']
        ],
        // another group item
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cl2123iche...',
            'contentOptions' => ['class' => 'in'],
//            'options' => [...],
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Collapsible Group Item #1',
            'content' => [
                'Anim pariatur cliche...',
                'Anim pariatur cliche...'
            ],
//            'contentOptions' => [...],
//            'options' => [...],
            'footer' => 'Footer' // the footer label in list-group
        ],
    ]
]);
// creates a URL to a route: /index.php?r=post%2Findex
echo Url::to(['post/index']);

// creates a URL to a route with parameters: /index.php?r=post%2Fview&id=100
echo Url::to(['post/view', 'id' => 100]);

// creates an anchored URL: /index.php?r=post%2Fview&id=100#content
echo Url::to(['post/view', 'id' => 100, '#' => 'content']);

// creates an absolute URL: http://www.example.com/index.php?r=post%2Findex
echo Url::to(['post/index'], true);

// creates an absolute URL using the https scheme: https://www.example.com/index.php?r=post%2Findex
echo Url::to(['post/index'], 'https');
$haynumproc = Yii::$app->db->createCommand("select num_proc from solicitudes where id = 90026;")->queryScalar();
echo $haynumproc;
echo Tabs::widget([
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur c1111111111111111liche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatu231321323122222222222222r cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Example',
            'url' => 'http://www.example.com',
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                 [
                     'label' => 'DropdownA',
                     'content' => 'DropdownA, Anim paaaaaaaaaaaaaaariatur cliche...',
                 ],
                 [
                     'label' => 'DropdownB',
                     'content' => 'DropdownB, Anim paribbbbbbbbbbbbbbbbbbbbatur cliche...',
                 ],
                 [
                     'label' => 'External Link',
                     'url' => 'http://www.example.com',
                 ],
            ],
        ],
    ],
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


echo Carousel::widget([
    'items' => [
        // the item contains only the image
        '<img src="https://cdn.pixabay.com/photo/2018/01/01/20/07/soap-bubble-3054875_960_720.jpg"/>',
        // equivalent to the above
        ['content' => '<img src="https://cdn.pixabay.com/photo/2018/01/01/20/07/soap-bubble-3054875_960_720.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<img src="https://images.pexels.com/photos/67636/rose-blue-flower-rose-blooms-67636.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
//            'options' => [...],
        ],
    ]
]);
?>
<div class="container">
    <div class="panel panel-primary" >
        <div class="panel-body">
            <form id="form1" name="form1" method="post" action="" class="form-horizontal"><!-- START THE FORM -->
                <div class="col-sm-6"> <!-- FIRST COLUMN -->
                    <div class="form-group">
                        <label for="inputFirstname" class="col-sm-4 control-label">First Name</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputFirstname" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastname" class="col-sm-4 control-label">Last Name</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputLastname" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"> <!-- SECOND COLUMN -->
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUsername" class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username">
                        </div>
                    </div>
                </div>
        </form> <!-- END THE FORM -->
        </div>
    </div><!-- END PANEL -->
</div>
<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
  Popover on left
</button>

<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
  Popover on top
</button>

<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus.">
  Popover on bottom
</button>

<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
  Popover on right
</button>


<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>

<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>

<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>

<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>

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
//echo Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left"]);
//echo Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "450", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"]);
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

<?php $footer = '<div class="row">'
                .Html::img("@web/img/logo_fps.jpg", ["alt" => "Logo Fundación", "width" => "150", "class" => "pull-left", "style" =>"margin-top: 0px; margin-bottom: 0px;"])
                .Html::img("@web/img/despacho.png", ["alt" => "Despacho", "width" => "300", "style" =>"margin-top: 10px; margin-bottom: 10px;", "class" => "pull-right"])
                . '<center><h3>Relación de Casos</h3></center>'
                .'</div>';
echo $footer;
                    ?>



 <?php



$this->registerJs(<<<JS

   $('#myButton').on('click', function() { alert( 'Hola' ); });

   $('#laprueba').on('click', function() { alert( 'Que mas Como esta la vaina' ); });

   $(function () {
   $('[data-toggle="tooltip"]').tooltip()
   })

    $(function () {
    $('[data-toggle="popover"]').popover()
    })

JS

);
