<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

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
     * @return string
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
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Signs user up.
     *
     * @return mixed
     */
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
     * Displays contact page.
     *
     * @return string
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
    
    public function actionAtencionsoberano()
    {
        return $this->render('atencionsoberano');
    }
    
    public function actionAtencioninstitucional()
    {
        return $this->render('atencioninstitucional');
    }
    
    public function actionInstruccionpresidencial()
    {
        return $this->render('instruccionpresidencial');
    }
    
    public function actionReportegeneral()
    {
        return $this->render('reportegeneral');
    }
    
    public function actionAtencionsoberano1()
    {
        return $this->render('atencionsoberano1');
    }
    
    public function actionPruebas()
    {
        return $this->render('pruebas');
    }
    
    public function actionTotalnivel3()
    {
        return $this->render('totalnivel3');
    }
    
    public function actionTotalnivel2()
    {
        return $this->render('totalnivel2');
    }
    
    public function actionTotalnivel1()
    {
        return $this->render('totalnivel1');
    }
    
    public function actionTablareportegeneral()
    {
        return $this->render('tablareportegeneral');
    }
    
    public function actionTablaatencionsoberano()
    {
        return $this->render('tablaatencionsoberano');
    }
    
    public function actionTablaatencioninstitucional()
    {
        return $this->render('tablaatencioninstitucional');
    }
    
    public function actionTablainstruccionpresidencial()
    {
        return $this->render('tablainstruccionpresidencial');
    }
    
    public function actionParteportrabajador()
    {
        return $this->render('parteportrabajador');
    }
    
    public function actionParteindividual()
    {
        $model = new \app\models\Parteindividual;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Valida los datos recibidos en $model
            $partetrabajador = Yii::$app->db->createCommand("select u1.nombre, e1.estatus, count(*), string_agg(s1.num_solicitud, ', ')  from solicitudes s1 join users u1 on s1.usuario_asignacion_id = u1.id join estatussasyc e1 on s1.estatus = e1.id where s1.usuario_asignacion_id =". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho ." group by u1.nombre, e1.estatus order by u1.nombre, e1.estatus")->queryAll();
            $partegestion = Yii::$app->db->createCommand("select e1.nombre as estatus1, e2.nombre as estatus2, e3.nombre as estatus3, count(*), string_agg(s1.num_solicitud, ', ') from gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at) = ". $model->anho ." group by e1.nombre, e2.nombre, e3.nombre order by e1.nombre, e2.nombre, e3.nombre")->queryAll();
            $counttrabajador = Yii::$app->db->createCommand("select count(*) from solicitudes s1 join users u1 on s1.usuario_asignacion_id = u1.id join estatussasyc e1 on s1.estatus = e1.id where s1.usuario_asignacion_id =". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho)->queryScalar();
            $countgestion = Yii::$app->db->createCommand("select count(*) from gestion g1 join solicitudes s1 on s1.id = g1.solicitud_id join users u1 on s1.usuario_asignacion_id = u1.id join estatus3 e3 on g1.estatus3_id = e3.id join estatus2 e2 on e3.estatus2_id = e2.id join estatus1 e1 on e2.estatus1_id = e1.id where s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at) = ". $model->anho)->queryScalar();

            // Se puede manipular los datos de $model

        return $this->render('parteindividual', ['model' => $model, 'partetrabajador' => $partetrabajador, 'partegestion' => $partegestion, 'counttrabajador' => $counttrabajador, 'countgestion' => $countgestion ]);
        } else {
            // Se despliega la pagina inicial o si hay un error de validacion
         return $this->render('parteindividual', ['model' => $model]);
        }
    }
    
}
