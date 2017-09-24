<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<h1 class="display-3">
    <?= "La solicitud con el numero  ".$consulta[0]['ndonacion']." del Sistema de la Fundación Pueblo Soberano tiene los Siguientes Presupuestos:<br>"; ?>
</h1>


<?php 

echo $consulta[0]['solicitud'];
echo "<br>";
echo $consulta[0]['solicitante'];
echo "<br>";
echo $consulta[0]['beneficiario'];
echo "<br>";
echo $consulta[0]['requerimiento'];
echo "<br>";
echo $consulta[0]['tipoayuda'];
echo "<br>";
echo $consulta[0]['area'];
echo "<br>";
echo $consulta[0]['necesidad'];
echo "<br>";
echo $consulta[0]['descripcion'];

?>


<?php 
$index = $numero;
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'montoapr',
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
//                'template' => '{inserta}',
//                'buttons' => [
//                    'inserta' => function($url, $model) {
//                        return Html::a(
//                                '<span class="glyphicon glyphicon-ok-sign"></span>SIGESP', 
//                                $url, 
//                                [
//                                    'title' => 'Enviar A SIGESP',
//                                ]
//                        );
//                    },    
//                ], 
//                'urlCreator' => function($action, $model, $key, $index){
//                        if ($action == 'inserta') {
//                            return \yii\helpers\Url::to(['sepsolicitud/inserta', 'id' => $key, 'numero' => $model->solicitud_id]);
//                        }
//                }
//            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<center>
<?= Html::a('<span class="glyphicon glyphicon-ok-sign"></span>SIGESP', ['sepsolicitud/inserta', 'numero' => $numero], ['class' => 'btn btn-primary']) ?>
</center>
</div>
