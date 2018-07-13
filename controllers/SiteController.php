<?php

namespace app\controllers;

use app\models\LingTerm;
use app\models\LingVar;
use app\models\Object;
use app\models\Belong;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;
use yii\base\Model;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SearchTermForm;
use app\widgets\LoginFormWidget;
use yii\data\Pagination;
use app\models\SearchObjectForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@admin.f';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свой почтовый ящик');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Извините, мы не смогли доставить письмо');
            }
        }

        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новы пароль сохранен');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model,]);
    }


    public function actionAjaxLogin() {
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->redirect($this->getViewPath());
                } else {
                    Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                    return yii\widgets\ActiveForm::validate($model);
                }
            }
        } else {
            throw new HttpException(404 ,'Page not found');
        }
    }

    public function actionSearchForTerm()
    {

        $modelTerms = [];
        $modelObj = new SearchObjectForm();

        $query = Object::find();

        for($i=0; $i<12; $i++)
        {
            $modelTerms[$i] = new SearchTermForm();

        }

        if( SearchTermForm::loadMultiple($modelTerms, Yii::$app->request->post()))
        {
            $modelObj->load(Yii::$app->request->post());
            $sql = "select id from object where type_tread = ". $modelObj->type_tread ;
            if(!empty($modelObj->id_city)) {
                $adsql = " and id_city = " . $modelObj->id_city;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if(!empty($modelObj->id_street)) {
                $adsql = " and id_street = " . $modelObj->id_street;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if($modelObj->amount_room !=0) {
                $adsql = " and amount_room = " . $modelObj->amount_room;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if(!empty($modelObj->num_bathroom)) {
                $adsql = " and num_bathroom = " . $modelObj->num_bathroom;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if($modelObj->type_bathroom !=3) {
                $adsql = " and type_bathroom = " . $modelObj->type_bathroom;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if($modelObj->elevator !=3) {
                $adsql = " and elevator = " . $modelObj->elevator;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            if($modelObj->viev_of_sea !=2) {
                $adsql = " and viev_of_sea = " . $modelObj->viev_of_sea;
                $sql = str_pad($sql, strlen($sql) + strlen($adsql), $adsql);
            }
            $objs = Object::findBySql($sql)->asArray()->all();
            $idObjects = array_column($objs, 'id');



            for($i=0;$i<12;$i++)
            {

                if($modelTerms[$i]->activ !=0 && !Empty($modelTerms[$i]->id_ling_var ) )
                {

                    $id_obj = $modelTerms[$i]->id_for_terms();
                    $idObjects = array_intersect($id_obj, $idObjects);

                }
            }
            $query = Object::find()->where(['id'=> $idObjects]);
        }


        $pages = new Pagination(['totalCount' => $query->count()]);
        $objects = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search-for-term', ['modelTerms' => $modelTerms, 'objects'=>$objects, 'pages'=>$pages,
        'modelObj' => $modelObj,
    ]);

    }

    public function actionListTerms($id)
    {
        $countterms = LingTerm::find()->where(['id_ling_var'=>$id])->count();
        $terms = LingTerm::find()->where(['id_ling_var'=>$id])->orderBy('id DESC')->all();
        if($countterms>0)
        {
            foreach($terms as $result) echo "<option value = '".$result->id."'>".$result->name."</option>";
        }else{
            echo "<option>-</option>";
        }
    }


}
