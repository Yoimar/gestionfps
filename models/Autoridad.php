<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "autoridad".
 *
 * @property integer $id
 * @property string $nombredim
 * @property string $nombrecompleto
 * @property string $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Referencia[] $referencias
 */
class Autoridad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autoridad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nombredim'], 'string', 'max' => 30],
            [['nombrecompleto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombredim' => 'Nombre Abreviado',
            'nombrecompleto' => 'Nombre Completo de la Autoridad o Personalidad',
            'created_at' => 'Creado el Día',
            'created_by' => 'Creado Por',
            'updated_at' => 'Actualizado el Día',
            'updated_by' => 'Actualizado Por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferencias()
    {
        return $this->hasMany(Referencia::className(), ['autoridad_id' => 'id']);
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
