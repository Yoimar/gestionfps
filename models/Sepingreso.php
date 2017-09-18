<?php
namespace app\models;

use yii\base\Model;

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
class Parteindividual extends Model
{
    /**
     * @inheritdoc
     */
    public $trabajador;
    public $anho;
    
    public function rules()
    {
        return [
            [['trabajador', 'anho'], 'integer'],
            [['trabajador'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['trabajador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trabajador' => 'Trabajador Social',
            'anho' => 'Año',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'trabajador']);
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

