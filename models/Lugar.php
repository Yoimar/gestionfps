<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "lugar".
 *
 * @property int $id
 * @property string $nombre
 * @property int $centro_clasificacion_id
 * @property double $lat
 * @property double $lng
 * @property string $nombre_slug
 * @property int $parroquia_id
 * @property string $direccion
 * @property string $telefono1
 * @property string $telefono2
 * @property string $telefono3
 * @property string $notas
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property CentroClasificacion $centroClasificacion
 * @property Parroquias $parroquia
 * @property User $createdBy
 * @property User $updatedBy
 */
class Lugar extends \yii\db\ActiveRecord
{
    public $estado_id;
    public $municipio_id;
    public $searchbox;
    public $centro;
    public $centro_tipo;
    public $tipo_reporte;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lugar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'centro_clasificacion_id', 'lat', 'lng', 'parroquia_id'], 'required'],
            [['centro_clasificacion_id', 'parroquia_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['centro_clasificacion_id', 'parroquia_id', 'created_by', 'updated_by', 'tipo_reporte', 'centro', 'centro_tipo', 'estado_id', 'municipio_id' ], 'integer'],
            [['lat', 'lng'], 'number'],
            [['nombre_slug', 'notas'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
            [['direccion'], 'string', 'max' => 500],
            [['telefono1', 'telefono2', 'telefono3'], 'string', 'max' => 12],
            [['nombre_slug'], 'unique'],
            [['centro_clasificacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Centroclasificacion::className(), 'targetAttribute' => ['centro_clasificacion_id' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'centro_clasificacion_id' => 'Clasificacion del Centro',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'tipo_reporte' => 'Tipo de Reporte',
            'nombre_slug' => 'Nombre',
            'parroquia_id' => 'Parroquia',
            'direccion' => 'Direccion',
            'telefono1' => 'Telefono1',
            'telefono2' => 'Telefono2',
            'telefono3' => 'Telefono3',
            'notas' => 'Notas',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroclasificacion()
    {
        return $this->hasOne(Centroclasificacion::className(), ['id' => 'centro_clasificacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquias::className(), ['id' => 'parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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
                'value' => Yii::$app->formatter->asDate('now','php:m-d-Y H:i:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
            'class' => SluggableBehavior::className(),
            'attribute' => 'nombre',
            'slugAttribute' => 'nombre_slug',
            ],
        ];
    }

}
