<pre>
Jesus Ayudame
</pre>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

if(Yii::$app->request->post()){


}else {
    $numero =0;
    $prueba =0;
}


echo GridView::widget([
        'dataProvider' => $prueba,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'version',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
]); 

print_r($prueba);
?>

