<?php

namespace app\assets;

use yii\web\AssetBundle;

class ProductPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/product_style.css',
    ];
    public $js = [
        'js/product_page.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}