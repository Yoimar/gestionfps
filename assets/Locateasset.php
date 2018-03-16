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
class Locateasset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
      'js/locate.js',
      'js/geoPosition.js',
      //'http://maps.google.com/maps/api/js?sensor=false',
      'https://maps.googleapis.com/maps/api/js?key=AIzaSyBzyQHuP5O9RW7Ep87OPJqC2RqtzxpAPXo&callback=initMap'
    ];
    public $depends = [
    ];
}