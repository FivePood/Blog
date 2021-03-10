<?php

namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use frontend\models\LoginForm;
use frontend\models\SignupForm;


class UserController extends Controller
{
    public function actionLogin()  //Апи для авторизации пользователя
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($modelQuery = $model->login()) {
            return [
                $modelQuery->accessToken,
            ];
        } else {
            return [
                'error' => $model->getErrors(),
            ];
        }
    }

    public function actionSignup() //Апи для регистрации пользователя
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new SignupForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->signup()) {
            return $token;
        } else {
            return [
                'error' => $model->getErrors(),
            ];
        }
    }
}