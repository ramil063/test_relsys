<?php

namespace app\models\dto;

/**
 * Class Category
 * @package app\models\dto
 */
class Category extends \app\models\Category
{
    public function fields()
    {
        return [
            'id',
            'parent_id',
            'name',
            'subcategories' => function (self $q) {
                return $q->getSubcategories()->orderBy(['id' => SORT_ASC])->all();
            }
        ];
    }
}