<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tenencias".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 */
class Tenencias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tenencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'created_at', 'updated_at'], 'required'],
            [['version'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 200],
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
            'version' => 'Version',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
