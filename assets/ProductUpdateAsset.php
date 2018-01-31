<?php

namespace app\assets;

use yii\web\AssetBundle;

class ProductUpdateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/update_page.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}