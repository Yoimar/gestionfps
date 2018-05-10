<?php
namespace app\models;

use yii\base\Model;
use app\models\Recepciones;
use app\models\Programaevento;

/**
 * Esto es para la busqueda de los Casos por Departamento, Usuario y Estatus para buscar los casos asignados en la unidad.
 *
 */
class Reportes extends Model
{
    /**
     * @inheritdoc
     */
    public $mes;
    public $ano;
    public $actividad;
    public $fechadesde;
    public $fechahasta;
    public $recepcioninicial;
    public $tiporeporte;


    public function rules()
    {
        return [

            [['mes', 'ano', 'tiporeporte', 'recepcioninicial', 'actividad'], 'integer'],
            [['fechadesde', 'fechahasta',], 'safe'],
            [['ano'], 'required', 'on' => 'crear'],
            [['actividad'], 'required', 'on' => 'actividad'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mes' => 'Mes',
            'ano' => 'Año',
            'tiporeporte' => 'Tipo de Reporte',
            'fechadesde' => 'Fecha desde',
            'fechahasta' => 'Fecha Hasta',
            'recepcioninicial' => 'Unidad',
        ];
    }

    public function getRecepcioninicial()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'recepcioninicial']);
    }

    public function getActividad()
    {
        return $this->hasOne(Programaevento::className(), ['id' => 'actividad']);
    }


}
