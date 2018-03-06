<?php
namespace app\models;

use yii\base\Model;

/**
 * This is the model para la verificacion de los casos de los Usuarios.
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
    public $mes;
    public $tipoempleado;

    public function rules()
    {
        return [
            [['trabajador', 'anho', 'mes', 'tipoempleado'], 'integer'],
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
            'mes' => 'Mes',
            'tipoempleado' => 'Tipo de Empleado',
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
