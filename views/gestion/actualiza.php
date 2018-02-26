<?php
$fechaconminutos = Yii::$app->formatter->asDatetime('now','php:Y-m-d H:i:s');
echo $fechaconminutos;
echo "<br><hr><br>";
echo date('Y-m-d H:i:s');
echo "<br><hr><br>";
print_r($modelgestion);
echo "<br><hr><br>";
print_r($modelsolicitudes);
echo "<br><hr><br>";
print_r($modelpresupuesto);
echo "<br><hr><br>";
print_r($modelconexionsigesp);
echo "<br><hr><br>";
echo "<br><hr><br>";
$i = 0;
while ($i<11){
    switch($i){
        case 5:
            echo "He llegado a 5 </br>";
            break 1; // Aquí sólo saldría del switch
        case 10:
            echo "He llegado a 10 </br>";
            break 1; // Sale del switch y del while
        default:
            break;
    }
    ++$i;
}


/* 
 * Documento Realizado por Ing. Yoimar Urbina
 */

