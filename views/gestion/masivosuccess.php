<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = 'Los siguientes casos fueron actualizados:';


$columns = [
//            [
//            'class'=>'kartik\grid\CheckboxColumn',
//            'headerOptions'=>['class'=>'kartik-sheet-style'],
//            'rowSelectedClass' => GridView::TYPE_INFO,
//            'checkboxOptions' => function($model, $key, $index, $column) {
//                    return ['value' => $model->id];
//                },
//
//            ],

            [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'#',
            ],

            [
            'attribute' => 'solicitud_id',
            'value' => 'num_solicitud',
            'label' => 'N°<br>Solicitud',
            'encodeLabel' => false,
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'solicitante',
            'value' => 'solicitante',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'cisolicitante',
            'value' => 'cisolicitante',
            'format' => 'text',
            'label' => '<center>C.I.<br>Beneficiario</center>',
            'encodeLabel' => false,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'beneficiario',
            'value' => 'beneficiario',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'cibeneficiario',
            'value' => 'cibeneficiario',
            'format' => 'text',
            'label' => '<center>C.I.<br>Beneficiario</center>',
            'encodeLabel' => false,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'attribute' => 'necesidad',
            'value' => 'necesidad',
            'format' => 'text',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            ],

            [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{update} {solicitante} {beneficiario} {bitacora} {presupuesto} {solicitud} {informesocial}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updateajax', 'id' => $model->id]),
                        'data-pjax' => '0',
                    ]);
                },
                'solicitante' => function ($url, $model, $key) {
                    return Html::a('S<span class="glyphicon glyphicon-user"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Solicitante',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatepersona', 'id' => $model->persona_solicitante_id]),
                        'data-pjax' => '0',
                    ]);
                },
                'beneficiario' => function ($url, $model, $key) {
                    return Html::a('B<span class="glyphicon glyphicon-user"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Beneficiario',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatepersona', 'id' => $model->persona_beneficiario_id]),
                        'data-pjax' => '0',
                    ]);
                },
                'bitacora' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-bold"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Bitacora',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatebitacora', 'id' => $model->solicitud_id]),
                        'data-pjax' => '0',
                    ]);
                },
                'presupuesto' => function ($url, $model, $key) {
                    return Html::a('B<span class="glyphicon glyphicon-user"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Beneficiario',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatepersona', 'id' => $model->persona_beneficiario_id]),
                        'data-pjax' => '0',
                    ]);
                },
                'solicitud' => function ($url, $model, $key) {
                    return Html::a('B<span class="glyphicon glyphicon-user"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Beneficiario',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatepersona', 'id' => $model->persona_beneficiario_id]),
                        'data-pjax' => '0',
                    ]);
                },
                'informesocial' => function ($url, $model, $key) {
                    return Html::a('B<span class="glyphicon glyphicon-user"></span>', '#', [
                        'id' => 'update-gestion',
                        'title' => 'Actualizar Beneficiario',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['updatepersona', 'id' => $model->persona_beneficiario_id]),
                        'data-pjax' => '0',
                    ]);
                },
            ]

            ],

        ];

?>

<h4><?= Html::encode($this->title) ?></h4>
<?php Pjax::begin() ?>
<?php

echo   GridView::widget([
        'id' => 'gestion-grid-masivoxtrabajador',
        'dataProvider' => $dataProvider,
        'columns' => $columns, // check the configuration for grid columns by clicking button above
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'layout' => "{items}\n{pager}",
        'pjax' => false,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'toolbar' =>  [
        ],
    ]);

?>
<?php Pjax::end() ?>

<?php
//código para la ventana modal de update
$this->registerJs(
    "$(document).on('click', '#update-gestion', (function() {
        $.get(
            $(this).data('url'),
            function (data) {
                $('.modal-body').html(data);
                $('#modal').modal();
            }
        );
    }));"
); ?>

<?php
Modal::begin([
    'id' => 'modal',
    'options' => [
        'tabindex' => false,
    ],
    //'header' => '<h4 class="modal-title">Actualizar</h4>',
    //'footer' => '<div class"text-center"><a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a></div>',
]);

echo "<div class='well'></div>";

Modal::end();
?>
