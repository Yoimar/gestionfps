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
    public $cheque;

    
    public function rules()
    {
        return [

            [['caso'], 'integer'],
            [['cheque'], 'safe'],
            [['caso'], 'required']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'caso' => 'N° Solicitud'
        ];
    }
    
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'caso']);
    }
        
}


