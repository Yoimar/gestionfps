<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "instruccion".
 *
 * @property integer $id
 * @property string $instruccion
 * @property integer $created_by
 * @property string $updated_at
 * @property string $created_at
 * @property integer $updated_by
 *
 * @property Gestion[] $gestions
 */
class Instruccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instruccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['instruccion'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instruccion' => 'Instruccion',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['instruccion_id' => 'id']);
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
