<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Dialog::widget([
            'overrideYiiConfirm' => true,
            'options' => [  // customized BootstrapDialog options
                'size' => Dialog::SIZE_LARGE, // large dialog text
                'type' => Dialog::TYPE_DANGER, // bootstrap contextual color
                'title' => 'Advertencia',
                'message' => '¿Esta Seguro?',
                'btnCancelLabel' => '<i class="glyphicon glyphicon-ban-circle"></i> Volver'
            ],
        ]);
            echo Html::a(
                'Eliminar',
                ['delete', 'id' => $model->id],
                [
                    'data-confirm' => '¿Esta seguro de que desar eliminar este Convenio?',
                    'data-method' => 'post',
                    'class' => 'btn btn-danger',
                ]
            );
        ?>

        <?php
        //echo Html::a('Eliminar', ['delete', 'id' => $model->id], [
        //'class' => 'btn btn-danger',
        //'data' => [
        //'confirm' => 'Esta seguro de que desar eliminar este Convenio?',
        //'method' => 'post',
        //],
        //])
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'dimnombre',
            'tipoconvenio_id',
            'estado_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
