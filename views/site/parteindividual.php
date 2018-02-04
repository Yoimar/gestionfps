<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


if(Yii::$app->request->post()){
    
}else {
    $partetrabajador =0;
    $partegestion =0;
    $counttrabajador = 0;
    $countgestion = 0;
    $partenogestion = 0;
    $countnogestion = 0;
}
/* @var $this yii\web\View */
/* @var $model app\models\Procesos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parteindividual-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=
    /* Formu con Select2 de kartik*/
        $form->field($model, 'trabajador')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Users::find()->where(['activated' => 'TRUE'])->orderBy('nombre')->all(), 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Trabajador Social'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    
    ?>

    <?=
    /* Formu con Select2 de kartik*/
        $form->field($model, 'anho')->widget(Select2::classname(), [
        'data' => ArrayHelper::map([['id' => '2018', 'nombre' => '2018'],['id' => '2017', 'nombre' => '2017'],['id' => '2016', 'nombre' => '2016']], 'id', 'nombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione el Trabajador Social'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
    

    ?>

    <div class="form-group">
        <?= Html::submitButton('Generar Parte', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <div class="container">
        <center><h3 class="display-3">Parte Por trabajador SASYC <button type="button" class="btn btn-primary display-3"><?= $counttrabajador;?></button></h3></center>
          
    </div>

    
<div class="row">
					<div class="col-xs-12">
						<div>
							<table class="table table-bordered table-hover table-striped table-condensed">
								<thead>
									<tr>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Estatus</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Total</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Casos Asignados</th>    
									</tr>
								</thead>

								<tbody>
									<?php for ($i = 0; $i < count($partetrabajador); $i ++) : ?>
										<tr>
											<td><?= $partetrabajador[$i]['estatus'];?></td>
											<td style="text-align:center" class="info"><p  style="margin: 0;"><?= $partetrabajador[$i]['count'];?></p></td>
											<td style="text-align:center"><p style="margin: 0;"><?= $partetrabajador[$i]['string_agg'];?></p></td>
									
										</tr>
									<?php endfor; ?>
                                                                                
								</tbody>
							</table>
						</div>
					</div>
</div>
      <div class="container">
          <center><h3 class="display-3">Parte Por trabajador Gestión <button type="button" class="btn btn-primary"><?= $countgestion;?></button></h3></center>
        
      </div>
    
<div class="row">
					<div class="col-xs-12">
						<div>
							<table class="table table-bordered table-hover table-striped table-condensed">
								<thead>
									<tr>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Estatus 1</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Estatus 2</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Estatus 3</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Total</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Casos Asignados</th>    
									</tr>
								</thead>

								<tbody>
									<?php for ($i = 0; $i < count($partegestion); $i ++) : ?>
										<tr>
											<td><?= $partegestion[$i]['estatus1'];?></td>
                                                                                        <td><?= $partegestion[$i]['estatus2'];?></td>
                                                                                        <td><?= $partegestion[$i]['estatus3'];?></td>
											<td style="text-align:center" class="info"><p  style="margin: 0;"><?= $partegestion[$i]['count'];?></p></td>
											<td style="text-align:center"><p style="margin: 0;"><?= $partegestion[$i]['string_agg'];?></p></td>
									
										</tr>
									<?php endfor; ?>
                                                                                
								</tbody>
							</table>
						</div>
					</div>
</div>    
</div>
<div class="container">
        <center><h3 class="display-3">Parte que no tienen gestión <button type="button" class="btn btn-primary display-3"><?= $countnogestion;?></button></h3></center>
          
    </div>

    
<div class="row">
                    <div class="col-xs-12">
                        <div>
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;" width="200" nowrap>Estatus</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Total</th>
                                                                            <th style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.2em; background-color: #585858; color: white;">Casos Asignados</th>    
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php for ($i = 0; $i < count($partenogestion); $i ++) : ?>
                                        <tr>
                                            <td><?= $partenogestion[$i]['estatus'];?></td>
                                            <td style="text-align:center" class="info"><p  style="margin: 0;"><?= $partenogestion[$i]['count'];?></p></td>
                                            <td style="text-align:center"><p style="margin: 0;"><?= $partenogestion[$i]['string_agg'];?></p></td>
                                    
                                        </tr>
                                    <?php endfor; ?>
                                                                                
                                </tbody>
                            </table>
                        </div>
                    </div>
</div>
