<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
error_reporting(0);

?>

<div class="row">
    <table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px; text-align: center;">
        <tr>
            <td>
                <h3>Entrega de Solicitud N° <?= $modelsolicitud->num_solicitud ?></h3>
            </td>
        </tr>
    </table>
</div>

<br>
<br>


<div class="row">
    <table class="table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0px; padding: 0px; font-size:12px; text-align: center;">
        <tr>
            <td>
                <?= Html::img(Yii::getAlias('@web')."/img/adjuntos/".$modelfotossolicitud->solicitud_id.'/'.$modelfotossolicitud->foto, ["alt" => "Imagen Entrega", "width" => "300", "class" => "img-responsive center-block"]) ?>
            </td>
        </tr>
    </table>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="row">
    <table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12 negro" style="border-collapse: collapse; margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
        <tr class="negro">
            <td class="table-bordered col-xs-6 col-sm-6 col-md-6 col-lg-6 negro" style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Beneficiario
            </td>
            <td class="col-xs-6 col-sm-6 col-md-6 col-lg-6 negro" style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?php 
                echo $modelbeneficiario->nombre . " " . $modelbeneficiario->apellido;
                ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                C.I. Beneficiario
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelbeneficiario->ci;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Necesidad
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelsolicitud->necesidad;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Descripción
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelsolicitud->descripcion;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Cheques
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $cheques ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Retirado Por
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?php 
                echo $modelretirado->nombre . " " . $modelretirado->apellido;
                ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                C.I. Persona que Retira
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelretirado->ci;?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Responsable de Entrega
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelresponsable->dimprofesion. ' '. $modelresponsable->primernombre.' '. $modelresponsable->primerapellido ?>
            </td>
        </tr>
        <tr>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                Registrado Por
            </td>
            <td style="margin: 0px; padding: 0px; font-size:12px; border: solid 2px black; text-align: center;">
                <?= $modelentregado->dimprofesion. ' '. $modelentregado->primernombre.' '. $modelentregado->primerapellido ?>
            </td>
        </tr>
    </table>
</div>



