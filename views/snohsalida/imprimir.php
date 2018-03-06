<?php
use yii\helpers\Html;
use kartik\grid\GridView;
error_reporting(0);

?>

<?php
foreach ($dataProviderivss as $key => $value) {
    echo $key;
    echo "<br>";
    print_r($value);
    echo "<br>";
}
?>
