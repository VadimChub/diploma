<?php

namespace app\assets;
use yii\web\AssetBundle;

class BlockAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/my_style.css',
    ];
    public $js = [
    ];
    public $depends = [

    ];

}