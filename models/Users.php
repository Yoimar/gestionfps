<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $nombre
 * @property boolean $activated
 * @property string $activation_code
 * @property string $activated_at
 * @property string $last_login
 * @property string $persist_code
 * @property string $reset_password_code
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 * @property integer $departamento_id
 *
 * @property Bitacoras[] $bitacoras
 * @property Memos[] $memos
 * @property Solicitudes[] $solicitudes
 * @property Solicitudes[] $solicitudes0
 * @property Throttle[] $throttles
 * @property Trabajador[] $trabajadors
 * @property UsersGroups[] $usersGroups
 * @property Groups[] $groups
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'created_at', 'updated_at', 'departamento_id'], 'required'],
            [['activated'], 'boolean'],
            [['activated_at', 'last_login', 'created_at', 'updated_at'], 'safe'],
            [['version', 'departamento_id'], 'integer'],
            [['email', 'password', 'activation_code', 'persist_code', 'reset_password_code'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'nombre' => 'Nombre',
            'activated' => 'Activated',
            'activation_code' => 'Activation Code',
            'activated_at' => 'Activated At',
            'last_login' => 'Last Login',
            'persist_code' => 'Persist Code',
            'reset_password_code' => 'Reset Password Code',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'departamento_id' => 'Departamento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoras()
    {
        return $this->hasMany(Bitacoras::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemos()
    {
        return $this->hasMany(Memos::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['usuario_asignacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes0()
    {
        return $this->hasMany(Solicitudes::className(), ['usuario_autorizacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThrottles()
    {
        return $this->hasMany(Throttle::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadors()
    {
        return $this->hasMany(Trabajador::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGroups()
    {
        return $this->hasMany(UsersGroups::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['id' => 'group_id'])->viaTable('users_groups', ['user_id' => 'id']);
    }

    public function getDepartamentos()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento_id']);
    }

    public function getTrabajador()
    {
        return $this->hasOne(Trabajador::className(), ['users_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

        ];
    }
}
