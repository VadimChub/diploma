<?php

namespace app\assets;

use yii\web\AssetBundle;


class ProductAddAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/add_page.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}