<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Este nombre de Usuario no esta disponible'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Esta dirección de correo ya existe por favor coloque su correo personal'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $rolconsulta = $auth->getRole('consulta');
            $auth->assign($rolconsulta, $user->getId());

            return $user;
        }

        return null;
    }
}