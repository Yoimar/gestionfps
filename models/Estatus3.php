<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "estatus3".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $dim
 * @property integer $estatus2_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Estatus2 $estatus2
 * @property Gestion[] $gestions
 * @property HistorialSolicitudes[] $historialSolicitudes
 */
class Estatus3 extends \yii\db\ActiveRecord
{
    public $estatus1_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estatus3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estatus2_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['dim'], 'string', 'max' => 5],
            [['estatus2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus2::className(), 'targetAttribute' => ['estatus2_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Estatus Nivel 3',
            'dim' => 'Version Abreviada para Reporte',
            'estatus1_id' => 'Estatus Nivel 1',
            'estatus2_id' => 'Estatus Nivel 2',
            'created_at' => 'Creado el Día',
            'created_by' => 'Creado Por',
            'updated_at' => 'Actualizado el Día',
            'updated_by' => 'Actualizado Por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestions()
    {
        return $this->hasMany(Gestion::className(), ['estatus3_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialSolicitudes()
    {
        return $this->hasMany(HistorialSolicitudes::className(), ['estatus3_id' => 'id']);
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
    
    public static function getEstatusn1($estatus1_id) {
        $data=\app\models\Estatus2::find()
       ->where(['estatus1_id'=>$estatus1_id])
       ->select(['id','nombre as name'])->asArray()->all();

            return $data;
        }
    
        public static function getEstatusn2($estatus2_id) {
        $data=\app\models\Estatus3::find()
       ->where(['estatus2_id'=>$estatus2_id])
       ->select(['id','nombre as name'])->asArray()->all();

            return $data;
        }
}
