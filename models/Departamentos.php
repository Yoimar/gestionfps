<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property integer $id
 * @property integer $supervisor_id
 * @property string $nombre
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supervisor_id', 'nombre', 'created_at', 'updated_at'], 'required'],
            [['supervisor_id', 'version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supervisor_id' => 'Supervisor ID',
            'nombre' => 'Nombre',
            'version' => 'Version',
            'created_at' => 'Creado el Día:',
            'updated_at' => 'Actualizado el Día',
        ];
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
    /*public function getUsers()
    {
        return $this->hasMany(Users::className(), ['departamento_id' => 'id']);
    }*/
    
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'supervisor_id']);
    }
}
