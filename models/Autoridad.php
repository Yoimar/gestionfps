<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autoridad".
 *
 * @property integer $id
 * @property string $nombredim
 * @property string $nombrecompleto
 * @property string $created_at
 * @property integer $created_by
 * @property integer $version
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Referencia[] $referencias
 */
class Autoridad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autoridad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_by', 'version', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombredim'], 'string', 'max' => 30],
            [['nombrecompleto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombredim' => 'Nombredim',
            'nombrecompleto' => 'Nombrecompleto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'version' => 'Version',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferencias()
    {
        return $this->hasMany(Referencia::className(), ['autoridad_id' => 'id']);
    }
}
