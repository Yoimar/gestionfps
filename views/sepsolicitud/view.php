<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */

$this->title = $model->codemp;
$this->params['breadcrumbs'][] = ['label' => 'Sepsolicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sepsolicitud-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codemp' => $model->codemp, 'numsol' => $model->numsol], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codemp' => $model->codemp, 'numsol' => $model->numsol], [
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
            'codemp',
            'numsol',
            'codtipsol',
            'codfuefin',
            'fecregsol',
            'estsol',
            'consol:ntext',
            'monto',
            'monbasinm',
            'montotcar',
            'tipo_destino',
            'cod_pro',
            'ced_bene',
            'coduniadm',
            'codestpro1',
            'codestpro2',
            'codestpro3',
            'codestpro4',
            'codestpro5',
            'estcla',
            'estapro',
            'fecaprsep',
            'codaprusu',
            'numpolcon',
            'fechaconta',
            'fechaanula',
            'nombenalt',
            'tipsepbie',
            'codusu',
            'numdocori',
            'conanusep:ntext',
            'feccieinv',
            'codcencos',
        ],
    ]) ?>

</div>
