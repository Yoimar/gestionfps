<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memos".
 *
 * @property integer $id
 * @property string $fecha
 * @property string $numero
 * @property string $asunto
 * @property integer $origen_id
 * @property integer $destino_id
 * @property integer $usuario_id
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $usuario
 */
class Memos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'memos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'numero', 'asunto', 'origen_id', 'destino_id', 'created_at', 'updated_at'], 'required'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['origen_id', 'destino_id', 'usuario_id', 'version'], 'integer'],
            [['numero'], 'string', 'max' => 32],
            [['asunto'], 'string', 'max' => 100],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'numero' => 'Numero',
            'asunto' => 'Asunto',
            'origen_id' => 'Origen ID',
            'destino_id' => 'Destino ID',
            'usuario_id' => 'Usuario ID',
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'usuario_id']);
    }
}
