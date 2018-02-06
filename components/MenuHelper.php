<?php

namespace app\components;

use app\modules\admin\models\Category;

class MenuHelper
{

    public static function getMenu()
    {
        $result = static::getMenuRecrusive();
        return $result;
    }

    private static function getMenuRecrusive()
    {
        $items = Category::getCategories();

        $result = [];

        foreach ($items as $key => $value) {
            $result[] = [
                'label' => $value,
                'url' => ['site/category', 'category' => $value],
            ];
        }
        return $result;
    }

}