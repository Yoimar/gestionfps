<?php
namespace app\models;

use yii\base\Model;

/**
 * Esto es para la conexion con la base de datos del SIGESP
 *
 */
class Sepingreso extends Model
{
    /**
     * @inheritdoc
     */
    public $caso;

    
    public function rules()
    {
        return [

            [['caso'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'caso' => 'N° Caso Sasyc'
        ];
    }
    
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'caso']);
    }
        
}


