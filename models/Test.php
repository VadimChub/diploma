<?php
/**
 * Created by PhpStorm.
 * User: vadimchub
 * Date: 08.12.2017
 * Time: 18:01
 */

namespace app\models;

use Yii;

class Test
{
    public static function getNews ()
    {
        $sql = "SELECT * FROM news";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}