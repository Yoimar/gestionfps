<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use app\models\Solicitudes;
use app\models\Estatus1;
use app\models\Estatus2;
use app\models\Estatus3;
use app\models\Trabajador;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use app\models\Programaevento;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */



?>
<div class="row" style="font-size: 0.8 em;" >
    <div class="col-lg-12">
        <div class="box">
<div class="box-header">
    <h5>
        <?php
        $usuarioid = Yii::$app->user->id;
        $modeltrabajador = Trabajador::findOne([
            'user_id' => $usuarioid
        ]);
        $counttrabajador = Yii::$app->db->createCommand("select count(*) from solicitudes s1 join users u1 on s1.usuario_asignacion_id = u1.id join estatussasyc e1 on s1.estatus = e1.id where e1.id in ('ACA', 'EAA', 'DEV') and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").")")->queryScalar();
        $countgestion = Yii::$app->db->createCommand("select count(*) from gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").")")->queryScalar();
        $countnogestion = $counttrabajador - $countgestion;
        ?>
 </h5>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-lg-12">
            <div>
<?php

$estatus2= Yii::$app->db->createCommand("select e2.nombre from gestion g1 join solicitudes s1 on g1.solicitud_id = s1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").") group by e2.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus2); $j++)
    {
        $sql="select count(*) from gestion g1 join solicitudes s1 on g1.solicitud_id = s1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e2.nombre = '". $estatus2[$j]['nombre']."' and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").")";
        $valoresdata2[$k]['name']= $estatus2[$j]['nombre'];
        $valoresdata2[$k]['y']= (int)Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata2[$k]["drilldown"]= $estatus2[$j]['nombre'];

    $k=$k + 1;

}

$estatus2= Yii::$app->db->createCommand("select e2.nombre from gestion g1 join solicitudes s1 on g1.solicitud_id = s1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").") group by e2.nombre")->queryAll();

$k=0;
for ($j = 0; $j < count($estatus2); $j++)
    {

        $valoresdata1[$k]['name']= $estatus2[$j]['nombre'];
        $valoresdata1[$k]['id']= $estatus2[$j]['nombre'];
        $estatus3= Yii::$app->db->createCommand("select e3.nombre from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join solicitudes s1 on g1.solicitud_id = s1.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and e2.nombre = '". $estatus2[$j]['nombre']."' and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").") group by e3.nombre")->queryAll();
        $kf=0;
        for ($jf = 0; $jf < count($estatus3); $jf++)
            {
                $sql="select count(*) from gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id join solicitudes s1 on g1.solicitud_id = s1.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where e1.id = 1 and e3.nombre = '". $estatus3[$jf]['nombre']."' and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").")";
                $valoresdata1[$k]['data'][$kf][0]= $estatus3[$jf]['nombre'];
                $valoresdata1[$k]['data'][$kf][1]= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;

            $kf=$kf + 1;

        }


    $k=$k + 1;

}

echo Highcharts::widget([

    'scripts' => [
        'modules/column',
        'modules/drilldown',
        'modules/exporting',
        'themes/default',

    ],

    'options' => [

            'title' => ['text' => $countgestion.' Casos con gestión por trabajador(a) '.$modeltrabajador->Trabajadorfps],
            'chart' => [
                    'type' => 'column',
                    'height' => 350,
            ],
            'xAxis' => [
                'type' => 'category',
                'title' => ['text' => ' '],
            ],
            'yAxis' => [
                    'title' => ['text' => ' '],
            ],

            'legend' => [
                'enable' => true,
            ],

            'lang' => [
                'drillUpText' => 'Regresar',
            ],


            'plotOptions' => [
                'series' => [
                    'borderWidth' => 0,
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => '{point.y}'
                    ],
                ],
            ],

            'series' => [[
                    'name' => 'Casos',
                    'colorByPoint' => true,
                    'data' => $valoresdata2,
                    ]
            ],
            "drilldown" => [
                'series' => $valoresdata1,

            ],

],

]);

?>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>




<div class="col-lg-12 col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center"><?= $countnogestion; ?> Casos a los que no se le han colocado gestión </h3>
  </div>
    <hr>
    <center>
<!-- Inicio del Panel-->

    <div class="panel-body center-block">
	<div class="col-lg-10 col-md-10 col-md-offset-1 col-lg-offset-1">


        <?php $form = ActiveForm::begin(); ?>

        <?=
        $form->field($model, 'caso')->widget(Select2::classname(),
            [
            'name' => 'caso',
            'maintainOrder' => false,
            'options' => [
            'placeholder' => 'Seleccione los Casos',
            'multiple' => true,
            'showToggleAll' => false,
            'toggleAllSettings' => [
                'selectLabel' => '',
                'unselectLabel' => '',
                'selectOptions' => ['class' => 'text-success'],
                'unselectOptions' => ['class' => 'text-danger'],
              ],],
            'pluginOptions' => [
            'tags' => false,
            'maximumInputLength' => 10,
            'allowClear' => true,
            'minimumInputLength' => 4,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
            ],
            'ajax' => [
                'url' => Url::to(['numsolicitudxtrabajador']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(solicitudes) { return solicitudes.text; }'),
            'templateSelection' => new JsExpression('function (solicitudes) { return solicitudes.text; }'),
            ],

        ]);
        ?>
        </div>
        <div class="col-lg-4 col-md-4">
        <?=
        /* Estatus 1 con Select2 de kartik*/
            $form->field($model, 'estatus1')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Estatus1::find()->orderBy('nombre')->all(), 'id', 'nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Estatus Nivel 1'],
            'pluginOptions' => [
            'allowClear' => true
            ],
        ]);

        ?>
        </div>
        <div class="col-lg-4 col-md-4">

        <?=
        /* Estatus 2 con depdrop de kartik*/
        $form->field($model, 'estatus2')->widget(DepDrop::classname(), [
        'data' => ArrayHelper::map(Estatus2::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'estatus2', 'placeholder'=>'Seleccione el Estatus Nivel 2'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'placeholder' => 'Seleccione el Estatus Nivel 2',
            'depends'=>['multiplessolicitudes-estatus1'],
            'url'=>Url::to(['/estatus3/estatus1']),
        ]
        ]);
        ?>

        </div>
        <div class="col-lg-4 col-md-4">
        <?=
        /* Estatus 3 con depdrop de kartik*/
        $form->field($model, 'estatus3')->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'estatus3', 'placeholder'=>'Seleccione el Estatus Nivel 3'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'placeholder' => 'Seleccione el Estatus Nivel 3',
            'depends'=>['estatus2'],
            'url'=>Url::to(['/estatus3/estatus2']),
        ]
        ]);
        ?>
        </div>

        <div class="col-lg-4 col-md-4 col-md-offset-4 col-lg-offset-4">


        <?=
            $form->field($model, 'actividad')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Programaevento::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Programa Evento o Actividad'],
            'pluginOptions' => [
            'allowClear' => true
            ],
        ]);

        ?>

        </div>

  <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2">
                        <?= Html::submitButton('Cambiar Todos', ['class' => 'btn btn-primary']) ?>
    </div>

        <?php ActiveForm::end(); ?>

</div>

    </center>
    <hr>


<!-- Fin del Panel -->

</div>

<div class="row" style="font-size: 0.8 em;" >
    <div class="col-lg-12">
        <div class="box">
<div class="box-header">
    <h5>

 </h5>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-lg-12">
            <div>
<?php

$estatussasyc= Yii::$app->db->createCommand("select es.estatus from solicitudes s1 join estatussasyc es on s1.estatus = es.id where es.id in ('ACA', 'EAA', 'DEV') and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").") and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." group by es.estatus")->queryAll();

$k=0;
for ($j = 0; $j < count($estatussasyc); $j++)
    {
        $sql="select count(*) from solicitudes s1 join estatussasyc es on s1.estatus = es.id where es.estatus = '". $estatussasyc[$j]['estatus']."' and s1.usuario_asignacion_id = ".$modeltrabajador->users_id." and extract(year from s1.created_at) in (".(date("Y")-1). ', ' . date("Y").")";
        $valoresdata3[$k]['name']= $estatussasyc[$j]['estatus'];
        $valoresdata3[$k]['y']= Yii::$app->db->createCommand($sql)->queryscalar();// Su valor;
        $valoresdata3[$k]['drilldown']= $estatussasyc[$j]['estatus'];

    $k=$k + 1;

}

echo Highcharts::widget([

    'scripts' => [
        'modules/column',
        'modules/drilldown',
        'modules/exporting',
        'themes/default',

    ],

    'options' => [

            'title' => ['text' => $counttrabajador.' Casos Pendientes por el trabajador(a) '.$modeltrabajador->Trabajadorfps],
            'chart' => [
                    'type' => 'column',
                    'height' => 350,
            ],
            'xAxis' => [
                'type' => 'category',
                'title' => ['text' => ' '],
            ],
            'yAxis' => [
                    'title' => ['text' => ' '],
            ],

            'legend' => [
                'enable' => false,
            ],


            'plotOptions' => [
                'series' => [
                    'borderWidth' => 0,
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => '{point.y}'
                    ],
                ],
            ],



            'series' => [[
                    'name' => 'Casos',
                    'colorByPoint' => true,
                    'data' => new SeriesDataHelper($valoresdata3,['name','y:int','drilldown']),

                    ]
            ],



],

]);

?>
            </div>
        </div>
    </div>
</div>
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

</div>
