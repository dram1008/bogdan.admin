<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets\SlideShow;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Asset extends AssetBundle
{
    public $sourcePath = '@app/assets/SlideShow/source/highslide';
    public $css = [
        'highslide.css'
    ];
    public $js = [
        'highslide.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function register($view)
    {
        $o = parent::register($view);
        \Yii::$app->view->registerJs("hs.graphicsDir = '{$o->baseUrl}/graphics/';");
        \Yii::$app->view->registerJs("hs.outlineType = 'outer-glow';");
    }
}
