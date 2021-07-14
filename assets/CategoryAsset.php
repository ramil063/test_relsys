<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class CategoryAsset
 * @package app\assets
 */
class CategoryAsset extends AssetBundle
{
    public $sourcePath = 'js';
    public $js = [
        'category.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}