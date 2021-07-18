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
            <div class="main-container">
                <ul>
                    <li class="list-unstyled">
                        <form class="category-form">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Введите имя дочерней категории" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">+</button>
                            </div>
                        </form>
                        <ul class="ul-0">
                            <? foreach ($categories as $category): ?>
                                <li class="list-unstyled">
                                    <h2><?= $category['name']; ?></h2>
                                    <form class="category-form">
                                        <input type="hidden" name="parent_id" value="<?= $category['id'] ?>">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" placeholder="Введите имя дочерней категории" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success">+</button>
                                        </div>
                                    </form>
                                    <button class="btn btn-default show-subcategory" data-id="<?= $category['id'] ?>">
                                        Показать дочерние
                                    </button>
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
