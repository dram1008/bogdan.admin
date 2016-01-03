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
class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/style.css',
        'style/css/media-queries.css',
        'style/js/player/mediaelementplayer.css',
        '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,700,700italic|Open+Sans+Condensed:300,700',
    ];
    public $js = [
        'js/tg.js',
        'style/js/jquery-1.7.2.min.js',
        'style/js/ddsmoothmenu.js',
        'style/js/retina.js',
        'style/js/selectnav.js',
        'style/js/jquery.masonry.min.js',
        'style/js/jquery.fitvids.js',
        'style/js/jquery.backstretch.min.js',
        'style/js/mediaelement.min.js',
        'style/js/mediaelementplayer.min.js',
        'style/js/jquery.dcflickr.1.0.js',
        'style/js/twitter.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapThemeAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
