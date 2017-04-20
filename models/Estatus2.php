<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "estatus2".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dim
 * @property integer $estatus1_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Estatus1 $estatus1
 * @property Estatus3[] $estatus3s
 */
class Estatus2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus1_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['dim'], 'string', 'max' => 5],
            [['estatus1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus1::className(), 'targetAttribute' => ['estatus1_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Estatus Nivel 2',
            'dim' => 'Version Abreviada para Reporte',
            'estatus1_id' => 'Estatus Nivel 1',
            'created_at' => 'Creado el Día',
            'created_by' => 'Creado Por',
            'updated_at' => 'Actualizado el Día',
            'updated_by' => 'Actualizado Por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3s()
    {
        return $this->hasMany(Estatus3::className(), ['estatus2_id' => 'id']);
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
