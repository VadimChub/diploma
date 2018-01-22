<?php

namespace app\assets;

use yii\web\AssetBundle;


class ConversationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/conversation_style.css',
    ];
    public $js = [
        'js/conversation_page.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}