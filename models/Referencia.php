<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "referencia".
 *
 * @property integer $id
 * @property integer $autoridad_id
 * @property integer $cargo_id
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Programaevento[] $programaeventos
 * @property Autoridad $autoridad
 * @property Cargo $cargo
 */
class Referencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autoridad_id', 'cargo_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['autoridad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autoridad::className(), 'targetAttribute' => ['autoridad_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::className(), 'targetAttribute' => ['cargo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'autoridad_id' => 'Autoridad ID',
            'cargo_id' => 'Cargo ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaeventos()
    {
        return $this->hasMany(Programaevento::className(), ['referencia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutoridad()
    {
        return $this->hasOne(Autoridad::className(), ['id' => 'autoridad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargo::className(), ['id' => 'cargo_id']);
    }

    //Funcion para obtener el diminutivo de la Autoridad - Mas el Cargo Actual
    public function getNombre()
    {
        return $this->autoridad->nombredim. ' - '.$this->cargo->nombredim;
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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }
}
