<?php
namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use common\models\LoginForm;
use common\models\User;


class UserController extends Controller
{
    public function actionLogin()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($model = $model->login()) {
            return [
                $model->accessToken,
            ];
        } else {
            return [
                'error' => $model,
            ];
        }
    }

    public function actionSignup()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request->bodyParams;

        $model = new User();
        $model->username = $request['username'];
        $model->email = $request['email'];
        $model->setPassword($request['password']);
        $model->generateAuthKey();
        $model->generateEmailVerificationToken();
        $model->status = User::STATUS_ACTIVE;

        if ($model->save()) {
            $load = new LoginForm();
            $load->email=$request['email'];
            $load->password=$request['password'];
            if ($token = $load->login()) {
                return [
                    $token->accessToken,
                ];
            } else {
                return [
                    'error' => $model,
                ];
            }
        } else {
            return [
                'error' => $model,
            ];
        }
    }

}