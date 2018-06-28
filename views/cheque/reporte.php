<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChequeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporte de Cheques para Disponibilidad';
$this->params['breadcrumbs'][] = $this->title;
?>
</div>
<div class="container-fluid">

<div class="cheque-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_searchbusqueda', ['modelcheque' => $searchModel]); ?>

</div>

    <p>
        <?php //echo Html::a('Crear Cheque', ['entregacheque'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="col-lg-12 col-md-12">
        <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'date_cheque',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                'format' => 'date',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_cheque',
                    'name' => 'kartik-date-2',
                    'value' => 'date_cheque',
                    'asyncRequest' => false,
                    'options' => ['layout' => '{input}'],

                    ]),
                ],
                [
                'attribute' => 'cheque',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'beneficiario',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'cibeneficiario',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'telefono',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'monto',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'num_solicitud',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'orpa',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'recepcioninicial',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'rif',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'empresainstitucion',
                'value' => 'empresainstitucion',
                'label' => 'Casa Comercial<br>Empresa o Institución',
                'encodeLabel' => false,
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
                [
                'attribute' => 'estatus_cheque',
                'value' => 'estatus_cheque',
                'format' => 'text',
                'vAlign'=>'middle',
                'hAlign'=>'center',
                ],
        ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'fontAwesome' => true,
            'exportConfig' => [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_PDF => [
                    'label' => 'PDF',
                    'icon' => '<span class="glyphicon glyphicon-file"></span>',
                    'iconOptions' => ['class' => 'text-danger'],
                    'linkOptions' => [],
                    'options' => ['title' => 'Exportar a PDF'],
                    'alertMsg' => 'El pdf será generado para ser descargado.',
                    'mime' => 'application/pdf',
                    'extension' => 'pdf',
                    'useInlineCss' => true,
                    'pdfConfig' => [
                        'mode' => 'c',
                        'format' => 'Letter',
                        'destination' => 'I',
                        'orientation' => 'P',
                        'marginTop' => 45,
                        'marginBottom' => 20,
                        'methods' => [
                            'SetHeader'=>['</h2><center>Relación de Cheques</h2></center>'],
                            'SetFooter'=>['{PAGENO}'],
                        ],
                        'options' => [
                            'title' => $this->title,
                            'subject' => 'PDF export generated by kartik-v/yii2-grid extension',
                            'keywords' => 'krajee, grid, export, yii2-grid, pdf',
                        ],

                    ],

            'dropdownOptions' => [
                'label' => 'Seleccionar Todos',
                'class' => 'btn btn-default'
            ],

        ],
    ],
        ]) . "<hr>\n"; ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'toolbar' =>  [
            ['content' =>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}',
            ],
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
        ]); ?>
    </div>


</div>
