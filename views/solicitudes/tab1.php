<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Personas;
use yii\web\JsExpression;
use \yii\helpers\Url;
use app\models\Users;
use yii\widgets\Pjax;

/*
 * Proyecto Hecho Por Yoimar Urbina
 */
if(Yii::$app->request->post()){
    
}else {

}
?>
<?php Pjax::begin() ?>
<?=Html::beginForm(['solicitudes/tab1', 'id' => $model->id],'post');?>
<div class="row">
<div class="solicitudes-form col-md-12">

    <?php $form = ActiveForm::begin();?>
    
    <?php echo $form->field($model, 'num_solicitud')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'ind_mismo_benef')->checkbox(); ?>

    <?= $form->field($model, 'ind_beneficiario_menor')->checkbox(); ?>
    
    <?= 
        $form->field($model, 'persona_beneficiario_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_beneficiario_id) ? '' : Personas::findOne($model->persona_beneficiario_id)->Personacompleta, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Beneficiario ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);
    
    ?>
    
    <?= 
        $form->field($model, 'persona_solicitante_id')->widget(Select2::classname(), [
        'initValueText' => empty($model->persona_solicitante_id) ? '' : Personas::findOne($model->persona_solicitante_id)->Personacompleta, // set the initial display text
        'options' => ['placeholder' => 'Ingrese el Solicitante ...'],
        'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 5,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Esperando los resultados...'; }"),
        ],
        'ajax' => [
            'url' => Url::to(['listapersonas']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(personas) { return personas.text; }'),
        'templateSelection' => new JsExpression('function (personas) { return personas.text; }'),
        ],
        ]);
    
    ?>
    
    <?= 
        $form->field($model, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Areas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Area'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'referente_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Referentes::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Referente'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= 
        $form->field($model, 'recepcion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Recepciones::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione la Recepción'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>
    
    <?= 
        $form->field($model, 'organismo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Organismos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione El Organismo'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?= $form->field($model, 'referencia_externa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necesidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_proc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_proc')->textInput() ?>

    <?= $form->field($model, 'facturas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moneda')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <div class="form-group">

    </div>

    <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> Enviar e Imprimir Memorandum', ['class' => 'btn btn-primary btn-lg']) ?>
    
    <?php ActiveForm::end(); ?>
    
    <?php Pjax::end() ?>
</div>
</div>