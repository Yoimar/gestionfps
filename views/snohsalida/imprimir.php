<?php
use yii\helpers\Html;
use kartik\grid\GridView;
error_reporting(0);

?>
<p style="font-size:13px; text-align:justify;">
    &nbsp; &nbsp; &nbsp; &nbsp; Tengo el agrado de dirigirme a usted en la oportunidad de saludarlo y a su
    vez solicitar el pago de los siguientes aportes y retenciones laborales correspondientes al <strong>
    <?= $mesnombre ?></strong>, así mismo solicito que se emitan los siguientes cheques de gerencia según la tabla anexa.
</p>

<center>
<table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 1px black;">
    <tr>
    <td style="font-size:13px; text-align:center; border: solid 1px black; height: 40px;">N°</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">RIF</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">NOMBRE COMPLETO</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">TIPO DE EMPLEADO</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">APORTE</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">RETENCIÓN</td>
    <td style="font-size:13px; text-align:center; border: solid 1px black;">TOTAL</td>
    </tr>
<?php
foreach ($consultaivss as $id => $valores) {
    echo "<tr>";
    echo "<td style='text-align:center; height: 40px; border: solid 1px black;'>";
    echo $id+1;
    echo "</td>";
        foreach ($valores as $key => $value) {

        if (is_numeric($value)) {
            echo "<td  style='font-size:12px; text-align:right; border: solid 1px black;'>";
            echo Yii::$app->formatter->asCurrency($value);
        }else{
            echo "<td  style='font-size:12px; text-align:center; border: solid 1px black;'>";
            echo $value;
        }
        echo "</td>";

        }
    echo "</tr>";
}
?>
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
                    ___________________________________
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
