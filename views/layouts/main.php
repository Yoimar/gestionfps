<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo_fps2.jpg', ['alt' => 'Logo Fundación', 'height' => '25 px', 'style' => 'margin: 0 auto; border: 0;' ]),
        //'brandLabel' => 'Fundación Pueblo Soberano Gestión',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['style' => 'margin: 0 auto; border: 0;'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Gestión', 'url' => ['/gestion']],
            [
            'label' => 'Reportes',
            'items' => [
                 '<li class="dropdown-header">Reporte Individuales</li>',
                 ['label' => 'Atención al Soberano', 'url' => '@web/site/atencionsoberano'],
                 ['label' => 'Atención Institucional', 'url' => '@web/site/atencioninstitucional'],
                 ['label' => 'Instruccion Presidencial', 'url' => '@web/site/instruccionpresidencial'],
                 ['label' => 'Reporte General', 'url' => '@web/site/reportegeneral'],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Reporte Totales</li>',
                 ['label' => 'Total Nivel 1', 'url' => '#'],
                 ['label' => 'Total Nivel 2', 'url' => '#'],
                 ['label' => 'Total Nivel 3', 'url' => '#'],
            ],
            ],
            ['label' => 'Registrarse', 'url' => ['/site/signup']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Ingresar', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Fundación Pueblo Soberano <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
