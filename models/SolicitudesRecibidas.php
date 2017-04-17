<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitudes_recibidas".
 *
 * @property integer $id
 * @property integer $programaevento_id
 * @property integer $area_id
 * @property integer $cantidad
 * @property integer $created_by
 * @property integer $version
 * @property string $updated_at
 * @property string $created_at
 * @property integer $updated_by
 *
 * @property Areas $area
 * @property Programaevento $programaevento
 */
class SolicitudesRecibidas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'solicitudes_recibidas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programaevento_id', 'area_id', 'cantidad', 'created_by', 'version', 'updated_by'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['programaevento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programaevento::className(), 'targetAttribute' => ['programaevento_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programaevento_id' => 'Programaevento ID',
            'area_id' => 'Area ID',
            'cantidad' => 'Cantidad',
            'created_by' => 'Created By',
            'version' => 'Version',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaevento()
    {
        return $this->hasOne(Programaevento::className(), ['id' => 'programaevento_id']);
    }
}
