<?php
namespace app\models;

use yii\base\Model;

/**
 * Esto es para la conexion con la base de datos del SIGESP
 *
 */
class Multiplessolicitudes extends Model
{
    /**
     * @inheritdoc
     */
    public $caso;
    public $estatus1;
    public $estatus2;
    public $estatus3;
    public $actividad;


    public function rules()
    {
        return [

            [['caso', 'estatus3', ], 'required'],
            [['estatus3', 'actividad'], 'integer'],


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
