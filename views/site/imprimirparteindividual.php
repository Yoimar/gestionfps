<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="container">
        <center><h5 class="display-3"><?= $counttrabajador;?> SOLICITUDES ASIGNADAS AL TRABAJADOR</button></h5></center>

    </div>


<div class="row">
					<div class="col-xs-12">
						<div>
							<table class="table table-bordered table-hover table-striped table-condensed">
								<thead>
									<tr>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="100" nowrap>Estatus</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="30">Total</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;">Casos Asignados</th>
									</tr>
								</thead>

								<tbody>
									<?php for ($i = 0; $i < count($partetrabajador); $i ++) : ?>
										<tr>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partetrabajador[$i]['estatus'];?></td>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;" class="info"><?= $partetrabajador[$i]['count'];?></td>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partetrabajador[$i]['string_agg'];?></td>

										</tr>
									<?php endfor; ?>

								</tbody>
							</table>
						</div>
					</div>
</div>
      <div class="container">
          <center><h5 class="display-3"><?= $countgestion;?> SOLICITUDES CON GESTIÓN </h5></center>

      </div>

<div class="row">
					<div class="col-xs-12">
						<div>
							<table class="table table-bordered table-hover table-striped table-condensed">
								<thead>
									<tr>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="100" nowrap>Estatus 1</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="100" nowrap>Estatus 2</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="100" nowrap>Estatus 3</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="30">Total</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;">Casos Asignados</th>
									</tr>
								</thead>

								<tbody>
									<?php for ($i = 0; $i < count($partegestion); $i ++) : ?>
										<tr>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;" ><?= $partegestion[$i]['estatus1'];?></td>
                                            <td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partegestion[$i]['estatus2'];?></td>
                                            <td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partegestion[$i]['estatus3'];?></td>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;" class="info"><?= $partegestion[$i]['count'];?></td>
											<td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partegestion[$i]['string_agg'];?></td>

										</tr>
									<?php endfor; ?>

								</tbody>
							</table>
						</div>
					</div>
</div>
</div>
<div class="container">
        <center><h5 class="display-3"><?= $countnogestion;?> SOLICITUDES QUE NO TIENEN GESTION</h5></center>

    </div>


<div class="row">
                    <div class="col-xs-12">
                        <div>
                            <table class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="100" nowrap>Estatus</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;" width="30">Total</th>
                                                                            <th style="text-align:center; margin: 0px; padding: 0px; font-size:10px;; vertical-align:middle; font-weight: bold; font-size: 0.8em; background-color: #585858; color: white;">Casos Asignados</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php for ($i = 0; $i < count($partenogestion); $i ++) : ?>
                                        <tr>
                                            <td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partenogestion[$i]['estatus'];?></td>
                                            <td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;" class="info"><?= $partenogestion[$i]['count'];?></td>
                                            <td style="text-align:center; margin: 0px; padding: 0px; font-size:10px;"><?= $partenogestion[$i]['string_agg'];?></td>

                                        </tr>
                                    <?php endfor; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
</div>
