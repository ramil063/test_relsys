<?php

use app\assets\CategoryAsset;

/* @var $this yii\web\View */
/* @var $categories array */
$this->title = 'Категории';
CategoryAsset::register($this)
?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="main-container col-lg-6">
                <ul>
                    <li>
                        <form class="category-form">
                            <label for="name">
                                Добавить дочерний
                                <input type="text" name="name">
                            </label>
                            <button class="btn btn-success add-category">+</button>
                        </form>
                        <ul class="ul-0">
                            <? foreach ($categories as $category): ?>
                                <li>
                                    <h2><?= $category['name']; ?></h2>
                                    <form class="category-form">
                                        <input type="hidden" name="parent_id" value="<?= $category['id'] ?>">
                                        <label for="name">
                                            Добавить дочерний
                                            <input type="text" name="name">
                                        </label>
                                        <button class="btn btn-success">+</button>
                                    </form>
                                    <button class="btn btn-default show-subcategory" data-id="<?= $category['id'] ?>">v</button>
                                    <ul class="ul-<?= $category['id'] ?>"></ul>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="form modal" style="display: none">
    <form class="category-form">
        <input type="hidden" name="parent_id" value="0">
        <input type="text" name="name">
    </form>
</div>
