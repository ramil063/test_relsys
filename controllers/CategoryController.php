<?php

namespace app\controllers;

use app\models\dto\Category;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Class CategoryController
 * @package app\controllers
 */
class CategoryController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays all parent categories.
     *
     * @return string
     * @throws Exception
     */
    public function actionCreate()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(405, 'Only for ajax');
        }
        $post = Yii::$app->request->post();
        $category = new Category();
        $category->setAttributes($post);
        if (!$category->validate()) {
            throw new HttpException(400, 'Request isn\'t valid' );
        }
        if (!$category->save(false)) {
            throw new HttpException(500, 'Entity not saved' );
        }
        return $this->asJson($category);
    }

    /**
     * Displays all parent categories.
     *
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionSubcategories($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(405, 'Only for ajax');
        }

        $category = Category::findOne(intval($id));
        if (!$category) {
            throw new HttpException(404, 'Entity not found' );
        }
        return $this->asJson($category);
    }
}