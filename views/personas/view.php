<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'apellido',
            'tipo_nacionalidad_id',
            'ci',
            'sexo',
            'estado_civil_id',
            'lugar_nacimiento',
            'fecha_nacimiento',
            'nivel_academico_id',
            'parroquia_id',
            'ciudad',
            'zona_sector',
            'calle_avenida',
            'apto_casa',
            'telefono_fijo',
            'telefono_celular',
            'telefono_otro',
            'email:email',
            'twitter',
            'ind_trabaja:boolean',
            'ocupacion',
            'ingreso_mensual',
            'observaciones',
            'ind_asegurado:boolean',
            'seguro_id',
            'cobertura',
            'otro_apoyo',
            'version',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
