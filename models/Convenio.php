<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "convenio".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dimnombre
 * @property integer $tipoconvenio_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property TipoConvenio $tipoconvenio
 * @property Gestion[] $gestions
 */
class Convenio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'convenio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoconvenio_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['dimnombre'], 'string', 'max' => 10],
            [['tipoconvenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoConvenio::className(), 'targetAttribute' => ['tipoconvenio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre del Convenio',
            'dimnombre' => 'Abreviatura para el Reporte',
            'tipoconvenio_id' => 'Tipoconvenio ID',
            'created_at' => 'Creado el Día: ',
            'created_by' => 'Created Por:',
            'updated_at' => 'Actualizado el Día:',
            'updated_by' => 'Actualizado Por: ',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoconvenio()
    {
        return $this->hasOne(TipoConvenio::className(), ['id' => 'tipoconvenio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['convenio_id' => 'id']);
    }
}
