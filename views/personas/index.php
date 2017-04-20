<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'apellido',
            //'tipo_nacionalidad_id',
            'ci',
            // 'sexo',
            // 'estado_civil_id',
            // 'lugar_nacimiento',
            // 'fecha_nacimiento',
            // 'nivel_academico_id',
            // 'parroquia_id',
            // 'ciudad',
            // 'zona_sector',
            // 'calle_avenida',
            // 'apto_casa',
            // 'telefono_fijo',
            // 'telefono_celular',
            // 'telefono_otro',
            // 'email:email',
            // 'twitter',
            // 'ind_trabaja:boolean',
            // 'ocupacion',
            // 'ingreso_mensual',
            // 'observaciones',
            // 'ind_asegurado:boolean',
            // 'seguro_id',
            // 'cobertura',
            // 'otro_apoyo',
            // 'version',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
