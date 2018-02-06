<?php

namespace app\components;

use app\modules\admin\models\Category;

class MenuHelper
{
    /**
     * @return array
     */
    public static function getMenu()
    {
        $result = static::getMenuRecrusive();
        return $result;
    }

    /**
     * @return array of menu items
     */
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