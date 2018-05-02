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
            'dropdownOptions' => [
                'label' => 'Export All',
                'class' => 'btn btn-default'
            ]
        ]) . "<hr>\n"; ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
        ]); ?>
    </div>


</div>
