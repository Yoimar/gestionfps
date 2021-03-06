<?php
namespace app\models;

use yii\base\Model;

/**
 * Esto es para la busqueda de los Casos por Departamento, Usuario y Estatus para buscar los casos asignados en la unidad. 
 *
 */
class Finalmemo extends Model
{
    /**
     * @inheritdoc
     */
    public $departamentofinal;
    public $unidadfinal;
    public $estatus1final;
    public $estatus2final;
    public $estatus3final; 
    public $usuariofinal;

    
    public function rules()
    {
        return [

            [['departamentofinal', 'unidadfinal', 'estatus1final', 'estatus2final', 'estatus3final', 'usuariofinal'], 'integer'],
            [['departamentofinal', 'unidadfinal', 'estatus3final',], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'departamentofinal' => 'Dirección ',
            'estatus1final' => 'Estatus 1',
            'estatus2final' => 'Estatus 2',
            'estatus3final' => 'Estatus 3',
            'unidadfinal' => 'Unidad',
            'usuariofinal' => 'Trabajador Final',
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
        
}