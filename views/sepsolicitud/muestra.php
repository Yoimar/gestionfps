<pre>
Jesus Ayudame
</pre>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

if(Yii::$app->request->post()){


}else {
    $numero =0;
    $prueba =0;
}

Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_presupuesto',
            'rif',
            'req',
            'codestpre',
            // 'cuenta',
            // 'date',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
