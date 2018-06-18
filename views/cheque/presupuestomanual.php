<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use app\models\Solicitudes;


/* @var $this yii\web\View */
/* @var $model app\models\Sepsolicitud */
/* @var $form yii\widgets\ActiveForm */
?>
<br />
<div class="col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title text-center">Cheque N° <?= ltrim($model->cheque,0)?></h3>
    <h3 class="panel-title text-center">Caso N° <?= Solicitudes::findOne($model->caso)->num_solicitud ?></h3>
    <h3 class="panel-title text-center">Ingrese el Tipo de Presupuesto</h3>
  </div>
    <hr>
    <center>
<!-- Inicio del Panel-->

    <div class="panel-body center-block">
    <div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-3">


        <?php

        $form = ActiveForm::begin();
        $caso = $model->caso;

        ?>
        <!-- Forma de Colocar un valor oculto y pasarlo entre modelos -->
        <?= $form->field($model, 'caso')->hiddenInput(['value'=>$model->caso])->label(false); ?>

        <?=
            $form->field($model, 'cheque')->widget(Select2::classname(), [
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione El Estatus'],
            'pluginOptions' => [
            'disabled' => true,
            ],
        ]);

        ?>

        <?=
            $form->field($model, 'presupuesto')->widget(Select2::classname(), [
            'data' => ArrayHelper::map((new \yii\db\Query())->select([
                "CONCAT( empresa_institucion.nombrecompleto,
                ' Rif: ',
                empresa_institucion.rif,
                '-',
                empresa_institucion.nrif,
                ' Monto: ',
                presupuestos.montoapr ) as nombre",
                "presupuestos.id as id"
            ])
            ->from('presupuestos')
            ->join(
                'LEFT JOIN',
                'empresa_institucion',
                'empresa_institucion.id = presupuestos.beneficiario_id'
            )
            ->andFilterWhere(['presupuestos.solicitud_id' => $caso])
            ->all(),'id','nombre'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione El Presupuesto'],
        ]);

        ?>


    <div class="text-center">
        <div class="text-center">
                        <?= Html::submitButton('Asociar Presupuesto a Cheque', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

        <?php ActiveForm::end(); ?>



</div>

    </center>
    <hr>
<!-- Fin del Panel -->

</div>

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
