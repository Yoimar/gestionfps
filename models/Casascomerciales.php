<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "casascomerciales".
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
class Casascomerciales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casascomerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nombrecompleto'], 'string', 'max' => 250],
            [['rif'], 'string', 'max' => 1],
            [['nrif'], 'string', 'max' => 9],
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
}
