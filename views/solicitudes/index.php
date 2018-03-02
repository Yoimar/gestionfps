<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Personas;
use app\models\Solicitudes;
use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHml;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitudes Sasyc';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="solicitudes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    </div>

    </div>
    <div class="container-fluid" style="text-align: center;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div align='center'>{pager}</div>",
        'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'max-width: 80px; margin-left: auto; margin-right: auto;'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'descripcion',
            'num_solicitud',
            //'persona_beneficiario_id',
            [
            'attribute' => 'persona_beneficiario_nombre',
            'value' => 'personabeneficiario.nombre',
            'format' => 'text',
            'label' => 'Nombre Beneficiario'
            ],
            [
            'attribute' => 'persona_beneficiario_apellido',
            'value' => 'personabeneficiario.apellido',
            'format' => 'text',
            'label' => 'Apellido Beneficiario'
            ],
            [
            'attribute' => 'persona_beneficiario_ci',
            'value' => 'personabeneficiario.ci',
            'label' => 'CI Beneficiario'
            ],
            [
            'attribute' => 'persona_solicitante_nombre',
            'value' => 'personasolicitante.nombre',
            'format' => 'text',
            'label' => 'Nombre Solicitante'
            ],
            [
            'attribute' => 'persona_solicitante_apellido',
            'value' => 'personasolicitante.apellido',
            'format' => 'text',
            'label' => 'Apellido Solicitante'
            ],
            [
            'attribute' => 'persona_solicitante_ci',
            'value' => 'personasolicitante.ci',
            'format' => 'text',
            'label' => 'CI Solicitante'
            ],

            //'persona_solicitante_id',
            //'area_id',
            // 'referente_id',
            // 'recepcion_id',
            // 'organismo_id',
            // 'ind_mismo_benef:boolean',
            // 'ind_inmediata:boolean',
            // 'ind_beneficiario_menor:boolean',
            // 'actividad',
            // 'referencia',
            // 'referencia_externa',
            // 'accion_tomada',
            // 'necesidad',
            // 'tipo_proc',
            // 'num_proc',
            // 'facturas',
            // 'observaciones',
            // 'moneda',
            //'estatus',
            [
            'attribute' => 'estatus',
            'value' => 'estatussasyc.estatus',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'estatus',
                        'data' => ArrayHelper::map(app\models\Estatussasyc::find()->orderBy('estatus')->all(), 'id', 'estatus'),
                        'options' =>
                            ['placeholder' => '¿Estatus?'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],

            [
            'attribute' => 'usuario_asignacion_id',
            'value' => 'users.nombre',
            'format' => 'text',
            'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'usuario_asignacion_id',
                        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
                        'options' =>
                            ['placeholder' => '¿Trabajador Asignado?'],
                        'pluginOptions' => [ 'allowClear' => true ],
                ]),
            ],
            //'usuario_asignacion_id',
            // 'usuario_autorizacion_id',
            // 'fecha_asignacion',
            // 'fecha_aceptacion',
            // 'fecha_aprobacion',
            // 'fecha_cierre',
            // 'tipo_vivienda_id',
            // 'tenencia_id',
            // 'departamento_id',
            // 'memo_id',
            // 'informe_social:ntext',
            // 'total_ingresos',
            // 'beneficiario_json:ntext',
            // 'solicitante_json:ntext',

            // 'version',
            // 'created_at',
            // 'updated_at',

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{cambiotrabajador}',
            'buttons' => [
            'cambiotrabajador' => function($url, $model){
                                return Html::a('<span class="glyphicon glyphicon-arrow-right"></span>CambTrab.',
                                    yii\helpers\Url::to(['solicitudes/cambiotrabajador', 'id' => $model->id, ]),
                                    [
                                        'title' => 'Cambio de Trabajador',
                                    ]
                                    );
                                }

                              ],
            ],
          ],
        ]);

        ?>
    </div>
    </div>
</div>
