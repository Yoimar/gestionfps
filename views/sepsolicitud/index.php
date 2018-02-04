<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SepsolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cambio de Estructura Presupuestaria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sepsolicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                ],

            //'codemp',
            //'numsol',
            [
            'attribute' => 'numsol',
            'value' => 'numsol',
            'hAlign'=>'center', 
            'vAlign'=>'middle',
            ],
            //'codtipsol',
            //'codfuefin',
            [
            'attribute' => 'fecregsol',
            'value' => 'fecregsol',
            'hAlign'=>'center', 
            'vAlign'=>'middle',
            ],
            //'ced_bene',
            // 'estsol',
            [ 
            'attribute' => 'rifbeneficiario', 						
            'value' => 'rifbeneficiario', 
            'hAlign'=>'center', 
            'vAlign'=>'middle',
            ],
            [ 
            'attribute' => 'nombrebeneficiario', 						
            'value' => 'nombrebeneficiario', 
            'hAlign'=>'center', 
            'vAlign'=>'middle',
            'width'=>'350px',
            ],
            [ 
            'attribute' => 'monto', 						
            'value' => 'monto', 
            'hAlign'=>'right', 
            'vAlign'=>'middle',
            'width'=>'150px',
            'format'=>'currency',
            'pageSummary'=>true,
            'visible'=> true,
            ],
            [
            'attribute' => 'estructura',
            'value' => 'Estructuracaso',
            'hAlign'=>'center', 
            'vAlign'=>'middle',
            ],
            // 'monbasinm',
            // 'montotcar',
            // 'tipo_destino',
            //'cod_pro',
            
            // 'coduniadm',
            // 'codestpro1',
            // 'codestpro2',
            // 'codestpro3',
            // 'codestpro4',
            // 'codestpro5',
            // 'estcla',
            // 'estapro',
            // 'fecaprsep',
            // 'codaprusu',
            // 'numpolcon',
            // 'fechaconta',
            // 'fechaanula',
            // 'nombenalt',
            // 'tipsepbie',
            // 'codusu',
            // 'numdocori',
            // 'conanusep:ntext',
            // 'feccieinv',
            // 'codcencos',

            [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function($url, $model){
                                if ($model->codestpro3 == '0000000000000000000000201' && $model->estsol == 'E' && $model->estcla == 'A' ) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-right"></span>203',
                                    yii\helpers\Url::to(['sepsolicitud/cambioestructura', 'numsol' => $model->numsol, 'codestpro3' => $model->codestpro3]),
                                    [
                                        'title' => 'Cambio de Estructura',
                                    ]
                                    );
                                } elseif ($model->codestpro3 == '0000000000000000000000203' && $model->estsol == 'E' && $model->estcla == 'A' ) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-left"></span>201',
                                    yii\helpers\Url::to(['sepsolicitud/cambioestructura', 'numsol' => $model->numsol, 'codestpro3' => $model->codestpro3]),
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                    );
                                } elseif ($model->codestpro3 == '0000000000000000000000202' && $model->estsol == 'E' && $model->estcla == 'A' ) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-right"></span>204',
                                    yii\helpers\Url::to(['sepsolicitud/cambioestructura', 'numsol' => $model->numsol, 'codestpro3' => $model->codestpro3]),
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                    );
                                } elseif ($model->codestpro3 == '0000000000000000000000204' && $model->estsol == 'E' && $model->estcla == 'A' ) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-left"></span>202',
                                    yii\helpers\Url::to(['sepsolicitud/cambioestructura', 'numsol' => $model->numsol, 'codestpro3' => $model->codestpro3]),
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                    );
                                }
                }
            ],
            ],
        ],
    ]); ?>
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
