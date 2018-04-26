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
                'cheque',
                'beneficiario',
                'cibeneficiario',
                'telefono',
                'monto',
                'num_solicitud',
                'orpa',
                'recepcioninicial',
                'rif',
                'empresainstitucion',
                'estatus_cheque'
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
        ]); ?>
    </div>
        

</div>