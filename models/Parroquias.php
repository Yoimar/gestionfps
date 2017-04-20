<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "parroquias".
 *
 * @property integer $id
 * @property integer $municipio_id
 * @property string $nombre
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Municipios $municipio
 * @property Personas[] $personas
 * @property Programaevento[] $programaeventos
 */
class Parroquias extends \yii\db\ActiveRecord
{
    public $estado_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parroquias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['municipio_id', 'nombre', 'created_at', 'updated_at'], 'required'],
            [['municipio_id', 'version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['municipio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::className(), 'targetAttribute' => ['municipio_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'municipio_id' => 'Municipio ID',
            'estado_id' => 'Estado ID',
            'nombre' => 'Nombre',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipios::className(), ['id' => 'municipio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Personas::className(), ['parroquia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaeventos()
    {
        return $this->hasMany(Programaevento::className(), ['parroquia_id' => 'id']);
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
    
    public static function getEstadon($estado_id) {
        $data=\app\models\Municipios::find()
       ->where(['estado_id'=>$estado_id])
       ->select(['id','nombre as name'])->asArray()->all();

            return $data;
        }
        
    public static function getMunicipon($municipio_id) {
        $data=  \app\models\Parroquias::find()
       ->where(['municipio_id'=>$municipio_id])
       ->select(['id','nombre as name'])->asArray()->all();

            return $data;
        }
}
