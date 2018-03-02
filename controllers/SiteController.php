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
                'only' => [
                    'logout',
                    'atencionsoberano',
                    'reportegeneral',
                    'atencioninstitucional',
                    'instruccionpresidencial',
                    'totalnivel1',
                    'totalnivel2',
                    'totalnivel3',
                    'tablaatencionsoberano',
                    'tablareportegeneral',
                    'tablaatencioninstitucional',
                    'tablainstruccionpresidencial',
                    'parteportrabajador',
                    'parteindividual',
                    'pruebas',
                    'contact',
                    'about',
                    'rbac',
                    ],
                'rules' => [
                    [
                        'actions' => [
                            'logout',
                            'contact',
                            'pruebas',
                            'about',
                            'rbac',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'atencionsoberano',
                            'reportegeneral',
                            'atencioninstitucional',
                            'instruccionpresidencial',
                        ],
                        'allow' => true,
                        'roles' => ['ver-reporteunidad'],
                    ],
                    [
                        'actions' => [
                            'tablaatencionsoberano',
                            'tablareportegeneral',
                            'tablareportegeneral18',
                            'tablareportegeneral17',
                            'tablaatencioninstitucional',
                            'tablainstruccionpresidencial',
                        ],
                        'allow' => true,
                        'roles' => ['ver-tablas'],
                    ],
                  [
                        'actions' => [
                            'totalnivel1',
                            'totalnivel2',
                            'totalnivel3',
                        ],
                        'allow' => true,
                        'roles' => ['ver-graficas'],
                    ],
                    [
                        'actions' => [
                            'parteportrabajador',
                            'parteindividual',
                        ],
                        'allow' => true,
                        'roles' => ['ver-reportetrabajador'],
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
//Asi valido con rbac en la vista
//        if(!Yii::$app->user->can('ver-tablas') ){
//            throw new \yii\web\ForbiddenHttpException('No tiene permiso para ver este contenido');
//        }

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

    public function actionReportegeneral18()
    {
        return $this->render('reportegeneral18');
    }

    public function actionReportegeneral17()
    {
        return $this->render('reportegeneral17');
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

    public function actionTablareportegeneral17()
    {
        return $this->render('tablareportegeneral17');
    }

    public function actionTablareportegeneral18()
    {
        return $this->render('tablareportegeneral18');
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
            $partenogestion = Yii::$app->db->createCommand("select u1.nombre, e1.estatus, count(*), string_agg(s1.num_solicitud, ', ') from solicitudes s1 join users u1 on s1.usuario_asignacion_id = u1.id join estatussasyc e1 on s1.estatus = e1.id where s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho ." and not exists (select g1.solicitud_id from gestion g1 where g1.solicitud_id = s1.id and s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho .") group by u1.nombre, e1.estatus order by u1.nombre, e1.estatus")->queryAll();
            $countnogestion = Yii::$app->db->createCommand("select count(*) from solicitudes s1 join users u1 on s1.usuario_asignacion_id = u1.id join estatussasyc e1 on s1.estatus = e1.id where s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho ." and not exists (select g1.solicitud_id from gestion g1 where g1.solicitud_id = s1.id and s1.usuario_asignacion_id = ". $model->trabajador ." and extract(year from s1.created_at)= ". $model->anho .")")->queryScalar();

            // Se puede manipular los datos de $model

        return $this->render('parteindividual', [
            'model' => $model,
            'partetrabajador' => $partetrabajador,
            'partegestion' => $partegestion,
            'counttrabajador' => $counttrabajador,
            'countgestion' => $countgestion,
            'partenogestion' => $partenogestion,
            'countnogestion' => $countnogestion,
            ]);
        } else {
            // Se despliega la pagina inicial o si hay un error de validacion
         return $this->render('parteindividual', ['model' => $model]);
        }
    }

    public function actionRbac(){
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $vertablas = $auth->createPermission('ver-tablas');
        $vertablas->description = 'Permite ver las tablas generales';
        $auth->add($vertablas);

        $verreporteunidad = $auth->createPermission('ver-reporteunidad');
        $verreporteunidad->description = 'Permite ver los reportes por unidad';
        $auth->add($verreporteunidad);

        $verreportetrabajador = $auth->createPermission('ver-reportetrabajador');
        $verreportetrabajador->description = 'Permite ver los reportes por trabajador';
        $auth->add($verreportetrabajador);

        $vergraficas = $auth->createPermission('ver-graficas');
        $vergraficas->description = 'Permite ver las graficas de la unidad';
        $auth->add($vergraficas);

        $creargestion = $auth->createPermission('gestion-crear');
        $creargestion->description = 'Permite insertar el registro de una gestion';
        $auth->add($creargestion);

        $actualizargestion = $auth->createPermission('gestion-actualizar');
        $actualizargestion->description = 'Permite actualizar el registro de una gestion';
        $auth->add($actualizargestion);

        $listargestion = $auth->createPermission('gestion-listar');
        $listargestion->description = 'Permite listar todos los registros de gestion';
        $auth->add($listargestion);

        $eliminargestion = $auth->createPermission('gestion-eliminar');
        $eliminargestion->description = 'Permite eliminar el registro de una gestion';
        $auth->add($eliminargestion);

        $roladministrador = $auth->createRole('administrador');
        $auth->add($roladministrador);

        $rolpresidente = $auth->createRole('presidente');
        $auth->add($rolpresidente);

        $roltrabajador = $auth->createRole('trabajador');
        $auth->add($roltrabajador);

        $rolingreso = $auth->createRole('ingreso');
        $auth->add($rolingreso);

        $rolconsulta = $auth->createRole('consulta');
        $auth->add($rolconsulta);


        $auth->addChild($rolpresidente, $vertablas);
        $auth->addChild($rolpresidente, $verreporteunidad);
        $auth->addChild($rolpresidente, $verreportetrabajador);
        $auth->addChild($rolpresidente, $vergraficas);
        $auth->addChild($roladministrador, $creargestion);
        $auth->addChild($roladministrador, $actualizargestion);
        $auth->addChild($roladministrador, $listargestion);
        $auth->addChild($roladministrador, $eliminargestion);
        $auth->addChild($roladministrador, $vertablas);
        $auth->addChild($roladministrador, $verreporteunidad);
        $auth->addChild($roladministrador, $verreportetrabajador);
        $auth->addChild($roladministrador, $vergraficas);
        $auth->addChild($rolpresidente, $listargestion);

        $auth->addChild($roltrabajador, $vertablas);
        $auth->addChild($roltrabajador, $verreporteunidad);
        $auth->addChild($roltrabajador, $verreportetrabajador);
        $auth->addChild($roltrabajador, $vergraficas);
        $auth->addChild($roltrabajador, $creargestion);
        $auth->addChild($roltrabajador, $actualizargestion);
        $auth->addChild($roltrabajador, $listargestion);


        $auth->addChild($rolingreso, $creargestion);
        $auth->addChild($rolingreso, $listargestion);


        $auth->addChild($rolconsulta, $listargestion);







        $auth->assign($roladministrador, 1);
        $auth->assign($roladministrador, 2);
        $auth->assign($roladministrador, 4);
        $auth->assign($roltrabajador, 3);
        $auth->assign($rolingreso, 6);
        $auth->assign($rolconsulta, 5);


        echo "ok";
    }

    public function actionBulk(){
    $action = Yii::$app->request->post('action');
    $selection=(array)Yii::$app->request->post('selection');
    for ($i = 0; $i<count($selection); $i++) {
        $mensaje = implode($selection);

    }
    Yii::$app->session->setFlash("success", $mensaje);

        ////typecasting
        //foreach($selection as $id){
        //$e=Evento::findOne((int)$id);//make a typecasting
        //do your stuff
        //$e->save();
        //}

     return $this->render('pruebas', ['seleccion'=>$selection]);
    }
}
