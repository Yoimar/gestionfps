<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

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
<body onload="mueveReloj(),//recarga()">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span></span>',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['class' => 'glyphicon glyphicon-home', 'style' => 'margin: 0 auto; border: 0; color: #FFFFFF;'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style' => 'background-color:  #337ab7',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right',
                       'style' => 'background-color:  #337ab7;',
            ],
        'items' => [
            ['label' => 'Gestión', 'url' => ['/gestion'], 'linkOptions' => ['style' => 'color: #FFFFFF;']],
            ['label' => 'Aprobación',
            'items' => [
                 '<li class="dropdown-header">Menu Aprobacion</li>',
                 ['label' => 'Aprobar Caso', 'url' => '@web/sepsolicitud/ubica'],
                ['label' => 'Enviar Caso', 'url' => '@web/gestion/gestiona?precarga=1'],
                 ['label' => 'Crear Localizador', 'url' => '@web/gestion/origenmemo'],
                 ['label' => 'Ver Memorandums', 'url' => '@web/memosgestion/index'],
                ['label' => 'Cambio de estructura', 'url' => '@web/sepsolicitud/index'],
            ],
            'linkOptions' => ['style' => 'color: #FFFFFF;']
            ],
            [
            'label' => 'Reportes',
            'items' => [
                 '<li class="dropdown-header">Tablas Resumen</li>',
                 ['label' => 'Atención al Soberano', 'url' => '@web/site/tablaatencionsoberano'],
                 ['label' => 'Atención Institucional', 'url' => '@web/site/tablaatencioninstitucional'],
                 ['label' => 'Instruccion Presidencial', 'url' => '@web/site/tablainstruccionpresidencial'],
                 ['label' => 'Reporte General 2017', 'url' => '@web/site/tablareportegeneral17'],
                 ['label' => 'Reporte General 2018', 'url' => '@web/site/tablareportegeneral18'],
                 '<li class="divider"></li>',
                '<li class="dropdown-header">Reporte Por Unidad</li>',
                 ['label' => 'Atención al Soberano', 'url' => '@web/site/atencionsoberano'],
                 ['label' => 'Atención Institucional', 'url' => '@web/site/atencioninstitucional'],
                 ['label' => 'Instruccion Presidencial', 'url' => '@web/site/instruccionpresidencial'],
                 ['label' => 'Reporte General 2017', 'url' => '@web/site/reportegeneral17'],
                 ['label' => 'Reporte General 2018', 'url' => '@web/site/reportegeneral18'],
                '<li class="divider"></li>',
                '<li class="dropdown-header">Reporte de Trabajador Social</li>',
                ['label' => 'General Trabajador Social', 'url' => '@web/site/parteportrabajador'],
                ['label' => 'Parte Individual', 'url' => '@web/site/parteindividual'],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Reporte Totales en Gráfica</li>',
                 ['label' => 'Total Nivel 1', 'url' => '@web/site/totalnivel1'],
                 ['label' => 'Total Nivel 2', 'url' => '@web/site/totalnivel2'],
                 ['label' => 'Total Nivel 3', 'url' => '@web/site/totalnivel3'],
            ],
            'linkOptions' => ['style' => 'color: #FFFFFF;'],
            ],
            Yii::$app->user->isGuest ? (['label' => 'Registrarse', 'url' => Url::to(['site/signup']),'linkOptions' => ['style' => 'color: #FFFFFF;'], ]):(""),
            Yii::$app->user->isGuest ? (""):(['label' => 'Ir a Perfil', 'url' => Url::to(['/trabajador/mostrarusuario', 'idgestion' => Yii::$app->user->getId()]),'linkOptions' => ['style' => 'color: #FFFFFF;'], ]),
            Yii::$app->user->isGuest ? (
                ['label' => 'Ingresar', 'url' => ['/site/login'],'linkOptions' => ['style' => 'color: #FFFFFF;'], ]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout',
                     'style' => 'color: #FFFFFF;']
                )
                . Html::endForm()
                . '</li>'
            ),
            array_search('administrador', array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())))!='' ? (
                ['label' => 'Administracion',
                'items' => [
                     '<li class="dropdown-header">Menu Administración</li>',
                     ['label' => 'Pruebas', 'url' => '@web/site/pruebas'],
                     ['label' => 'Trabajadores', 'url' => '@web/trabajador/index'],
                     ['label' => 'Perfiles', 'url' => '@web/authassignment/index'],
                     ['label' => 'Cambio Masivo', 'url' => '@web/gestion/masivo'],
                     ['label' => 'Cambio de Trabajador Social', 'url' => '@web/solicitudes/index'],
                ],
                'linkOptions' => ['style' => 'color: #FFFFFF;']
                ] ): (""),

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

<footer class="footer" style="background-color:#337ab7; color: #FFFFFF; margin: 0 auto; border: 0;" >
    <div class="container" style="background-color:#337ab7; color: #FFFFFF; margin: 0 auto; border: 0; ">
        <center style="background-color:#337ab7; color: #FFFFFF; margin: 0 auto; border: 0; padding: 0;">
        <p style="background-color:#337ab7; color: #FFFFFF; margin: 0 auto; border: 0; padding: 0;" >&copy; Fundación Pueblo Soberano <?= date('Y') ?></p>
        </center>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
