<?php
use yii\helpers\Html;
use kartik\grid\GridView;
error_reporting(0);

?>
<p style="font-size:13px; text-align:justify;">
    Tengo el honor de dirigirme a usted en la oportunidad de saludarlo y a su
    vez solicitar el pago de los siguientes aportes y retenciones.
</p>

<center>
<table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 2px black;">
    <tr>
    <td style="font-size:13px; text-align:center;">N°</td>
    <td style="font-size:13px; text-align:center;">RIF</td>
    <td style="font-size:13px; text-align:center;">NOMBRE COMPLETO</td>
    <td style="font-size:13px; text-align:center;">TIPO DE EMPLEADO</td>
    <td style="font-size:13px; text-align:center;">APORTE</td>
    <td style="font-size:13px; text-align:center;">RETENCIÓN</td>
    <td style="font-size:13px; text-align:center;">TOTAL</td>
    </tr>
<?php
foreach ($consultaivss as $id => $valores) {
    echo "<tr>";
    echo "<td>";
    echo $id+1;
    echo "</td>";
        foreach ($valores as $key => $value) {
        echo "<td>";
        if (is_numeric($value)) {
            echo Yii::$app->formatter->asCurrency($value);
        }else{
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
                    Cap. Enmanuel Gonzalez
                    <br>
                    Director de la Oficina de Gestión Humana
                    <br>
                </strong>
            </td>
        </tr>
</table>

</center>