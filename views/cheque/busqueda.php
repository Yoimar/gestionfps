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
<div class="cheque-index">

</div>
</div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_searchbusqueda', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cheque', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


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
            ['class'=>'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
