<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Mapasset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/crearlugar.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyBzyQHuP5O9RW7Ep87OPJqC2RqtzxpAPXo&libraries=places&callback=initMap'
    ];
    public $depends = [
    ];

}
