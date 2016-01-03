<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets\MainLayout;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Asset extends AssetBundle
{
    public $sourcePath = '@app/assets/MainLayout/source';
    public $css = [
        'css/bootstrap.min.css',
        'css/grayscale.css',
        'font-awesome/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic',
        'http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.easing.min.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false',
        'js/grayscale.js',
        'js/tg.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
//        'yii\bootstrap\BootstrapThemeAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
