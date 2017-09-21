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
//    public $beneficiarios = [];
//    public $beneficiario;
//    public $estructura;
//    public $fecha;
//    public $monto; 
//    public $ids_presupuesto = [];
//    public $id_presupuesto; 

    
    public function rules()
    {
        return [
//            [['beneficiario', 'monto', 'id_presupuesto'], 'integer'],
//            [['fecha', 'estructura', 'beneficiarios', 'beneficiario', 'caso',], 'safe'],
            [['caso'], 'integer'],
//            [['monto'],'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'caso' => 'N° Caso Sasyc',
//            'beneficiario' => 'Casa Comercial',
//            'monto' => 'Monto',
//            'id_presupuesto' => 'Presupuesto',
//            'fecha' => 'Fecha',
//            'estructura' => 'Estructura',
//            'beneficiarios' => 'Beneficiarios',
//            'beneficiario' => 'Beneficiario',
        ];
    }
    
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'caso']);
    }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

