<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trabajador".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $users_id
 * @property string $primernombre
 * @property string $segundonombre
 * @property string $primerapellido
 * @property string $segundoapellido
 * @property integer $ci
 * @property string $telfextension
 * @property string $telfpersonal
 * @property string $telfpersonal2
 * @property string $telfcasa
 * @property string $dimprofesion
 * @property string $profesion
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property ConvenioTrabajador[] $convenioTrabajadors
 * @property Gestion[] $gestions
 * @property Programaevento[] $programaeventos
 * @property User $user
 * @property Users $users
 */
class Trabajador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trabajador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'users_id', 'ci', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['primernombre', 'segundonombre', 'primerapellido', 'segundoapellido'], 'string', 'max' => 20],
            [['telfextension', 'telfpersonal', 'telfpersonal2', 'telfcasa'], 'string', 'max' => 12],
            [['dimprofesion'], 'string', 'max' => 8],
            [['profesion'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'users_id' => 'Users ID',
            'primernombre' => 'Primernombre',
            'segundonombre' => 'Segundonombre',
            'primerapellido' => 'Primerapellido',
            'segundoapellido' => 'Segundoapellido',
            'ci' => 'Ci',
            'telfextension' => 'Telfextension',
            'telfpersonal' => 'Telfpersonal',
            'telfpersonal2' => 'Telfpersonal2',
            'telfcasa' => 'Telfcasa',
            'dimprofesion' => 'Dimprofesion',
            'profesion' => 'Profesion',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvenioTrabajadors()
    {
        return $this->hasMany(ConvenioTrabajador::className(), ['trabajador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['trabajador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaeventos()
    {
        return $this->hasMany(Programaevento::className(), ['trabajadoracargo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }
}
