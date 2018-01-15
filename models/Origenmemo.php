<?php
namespace app\models;

use yii\base\Model;

/**
 * Esto es para la busqueda de los Casos por Departamento, Usuario y Estatus para buscar los casos asignados en la unidad. 
 *
 */
class Origenmemo extends Model
{
    /**
     * @inheritdoc
     */
    public $departamento;
    public $unidad;
    public $estatus1;
    public $estatus2;
    public $estatus3; 
    public $usuario;

    
    public function rules()
    {
        return [

            [['departamento', 'unidad', 'estatus1', 'estatus2', 'estatus3', 'usuario' ], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'departamento' => 'Dirección',
            'estatus1' => 'Estatus 1',
            'estatus2' => 'Estatus 2',
            'estatus3' => 'Estatus 3',
            'unidad' => 'Unidad',
            'usuario' => 'Trabajador Final',
        ];
    }
    
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento']);
    }
    
    public function getUnidad()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'unidad']);
    }
    
    public function getEstatus1()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1']);
    }
    
    public function getEstatus2()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2']);
    }
    
    public function getEstatus3()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2']);
    }
    
    public function getUsuario()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'usuario']);
    }
    
}