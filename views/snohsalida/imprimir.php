<?php
use yii\helpers\Html;
use kartik\grid\GridView;
error_reporting(0);

?>
<p style="font-size:13px; text-align:justify;">
    &nbsp; &nbsp; &nbsp; &nbsp; Tengo el agrado de dirigirme a usted en la oportunidad de saludarlo y a su
    vez solicitar el pago de los siguientes aportes y retenciones laborales correspondientes al <strong>
    <?= $mesnombre ?></strong>, así mismo solicito que se emitan los siguientes cheques de gerencia según la tabla anexa:
</p>

<center>
<table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 1px black;">
<tr>
    <th style="font-size:13px; text-align:center; border: solid 1px black; height: 40px;">N°</td>
    <th style="font-size:13px; text-align:center; border: solid 1px black;">RIF</td>
    <th style="font-size:13px; text-align:center; border: solid 1px black;">NOMBRE COMPLETO</td>
    <th style="font-size:13px; text-align:center; border: solid 1px black;">CONCEPTO</td>
    <th width="80px" style="font-size:13px; text-align:center; border: solid 1px black;">TIPO DE EMPLEADO</td>
    <th width="90px" style="font-size:13px; text-align:center; border: solid 1px black;">RETENCIÓN</td>
    <th width="90px" style="font-size:13px; text-align:center; border: solid 1px black;">APORTE</td>
    <th width="100px" style="font-size:13px; text-align:center; border: solid 1px black;">TOTAL</td>
</tr>

<tr>
    <td style='text-align:center; height: 40px; border: solid 1px black; font-size:10px;'>
        1
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[0]['rifben']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[0]['nombene']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[0]['nomcon']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[0]['tipo'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[0]['retencion'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[0]['aporte'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[0]['total'])?>
    </td>
</tr>

<tr>
    <td rowspan="2" style='text-align:center; height: 80px; border: solid 1px black; font-size:10px;'>
        2
    </td>
    <td rowspan="2" style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[1]['rifben']?>
    </td>
    <td rowspan="2" style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[1]['nombene']?>
    </td>
    <td style='border: solid 1px black; height: 40px; text-align:center; font-size:10px;'>
        <?= $consultaivss[1]['nomcon']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[1]['tipo'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[1]['retencion'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[1]['aporte'])?>
    </td>
    <td rowspan="2" style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[1]['total'] + $consultaivss[2]['total'])?>
    </td>
</tr>

<tr>
    <td style='border: solid 1px black; height: 40px; text-align:center; font-size:10px;'>
        <?= $consultaivss[2]['nomcon']?>
    </td>
    <td style='border: solid 1px black; height: 40px; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[2]['tipo'])?>
    </td>
    <td style='border: solid 1px black; height: 40px; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[2]['retencion'])?>
    </td>
    <td style='border: solid 1px black; height: 40px; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[2]['aporte'])?>
    </td>
</tr>

<tr>
    <td style='text-align:center; height: 40px; border: solid 1px black; font-size:10px;'>
        3
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[3]['rifben']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[3]['nombene']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[3]['nomcon']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[3]['tipo'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[3]['retencion'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[3]['aporte'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[3]['total'])?>
    </td>
</tr>

<tr>
    <td style='text-align:center; height: 40px; border: solid 1px black; font-size:10px;'>
        4
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[4]['rifben']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[4]['nombene']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[4]['nomcon']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[4]['tipo'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[4]['retencion'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[4]['aporte'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[4]['total'])?>
    </td>
</tr>

<tr>
    <td style='text-align:center; height: 40px; border: solid 1px black; font-size:10px;'>
        5
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[5]['rifben']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[5]['nombene']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= $consultaivss[5]['nomcon']?>
    </td>
    <td style='border: solid 1px black; text-align:center; font-size:10px;'>
        <?= strtoupper($consultaivss[5]['tipo'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[5]['retencion'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[5]['aporte'])?>
    </td>
    <td style='border: solid 1px black; text-align:right; font-size:10px;'>
        <?= Yii::$app->formatter->asCurrency($consultaivss[5]['total'])?>
    </td>
</tr>

</table>
</center>



<center>
<table class="table table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <tr>
            <td style="font-size:13px; text-align:center;">
                <strong>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    _____________________________________________________
                    <br>
                    Cap. Enmanuel Félix González Hernández
                    <br>
                    Director de la Oficina de Gestión Humana
                    <br>
                </strong>
            </td>
        </tr>
</table>

</center>
