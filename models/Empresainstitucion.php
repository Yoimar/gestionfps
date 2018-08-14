<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "empresa_institucion".
 *
 * @property integer $id
 * @property string $nombrecompleto
 * @property string $rif
 * @property string $nrif
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Empresainstitucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa_institucion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'nrif'], 'integer'],
            [['nombrecompleto'], 'string', 'max' => 250],
            //Validación Solo Número y letras
            [['nombrecompleto'], 'match', 'pattern' => '/^[a-zA-Z0-9Z,.\s-]+$/i'],
            [['rif'], 'string', 'max' => 1],
            [['nrif'], 'string', 'max' => 10, 'message' => 'Por favor coloque solo NUMEROS sin ceros a la izquierda'],
            [['nrif'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombrecompleto' => 'Nombrecompleto',
            'rif' => 'Rif',
            'nrif' => 'Nrif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }

}
