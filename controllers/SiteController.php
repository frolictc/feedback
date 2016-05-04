<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\FeedbackThemes;
use app\models\FeedbackMessages;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {	
        $cache =Yii::$app->cache;
		
		if ($cache->get('date') === false) 
			 $cache->set('date', Date('d.m.Y h:i:s'));	

		return $this->render('index', ['date' => $cache->get('date')]);
    }
	
	 public function actionFlush()
    {	
        $cache =Yii::$app->cache;

		$cache->flush();
		$cache->set('date', Date('d.m.Y h:i:s'));	

		return $this->render('index', ['date' => $cache->get('date')]);
    }
}
