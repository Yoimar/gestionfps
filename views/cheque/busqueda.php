<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChequeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Busqueda de Caso para cheques';
$this->params['breadcrumbs'][] = ['label' => 'Reiniciar Busqueda', 'url' => ['busqueda']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="cheque-index">
    <?php echo $this->render('_searchbusqueda', ['modelcheque' => $searchModel]); ?>
</div>
    <br><br><br>
    <p>
        <?= Html::a('Agregar Cheque', ['entregacheque'], ['class' => 'btn btn-primary']) ?>
    </p>
    
</div>

<div class="container-fluid" style="text-align: center;">
    
    <div class="col-lg-12 col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'num_solicitud',
                'beneficiario',
                'cibeneficiario',
                'solicitante',
                'cisolicitante',
                'rif',
                'empresainstitucion',
                'cheque',
                'monto',
                
                [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{cambiotrabajador}',
                'buttons' => [
                'cambiotrabajador' => function($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-log-in"></span>',
                                        yii\helpers\Url::to(['cargarfoto', 'cheque' => $model->cheque, ]),
                                        [
                                            'title' => 'Entregar Cheque',
                                        ]
                                        );
                                    }

                                  ],
                ],
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
        ]); ?>
    </div>
        

</div>