<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memosgestion".
 *
 * @property integer $id
 * @property integer $dirorigen
 * @property integer $unidadorigen
 * @property integer $trabajadororigen
 * @property integer $estatus1origen
 * @property integer $estatus2origen
 * @property integer $estatus3origen
 * @property integer $dirfinal
 * @property integer $unidadfinal
 * @property integer $trabajadorfinal
 * @property integer $estatus1final
 * @property integer $estatus2final
 * @property integer $estatus3final
 * @property string $fechamemo
 * @property string $asunto
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Departamentos $dirorigen0
 * @property Departamentos $dirfinal0
 * @property Estatus1 $estatus1origen0
 * @property Estatus1 $estatus1final0
 * @property Estatus2 $estatus2origen0
 * @property Estatus2 $estatus2final0
 * @property Estatus3 $estatus3origen0
 * @property Estatus3 $estatus3final0
 * @property Recepciones $unidadorigen0
 * @property Recepciones $unidadfinal0
 * @property Trabajador $trabajadororigen0
 * @property Trabajador $trabajadorfinal0
 */
class Memosgestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $verorpa;
    public $vercheque;
    public $vertelefono;
    public $verunidad;
    
    public static function tableName()
    {
        return 'memosgestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dirorigen', 'unidadorigen', 'trabajadororigen', 'estatus1origen', 'estatus2origen', 'estatus3origen', 'dirfinal', 'unidadfinal', 'trabajadorfinal', 'estatus1final', 'estatus2final', 'estatus3final', 'created_by', 'updated_by'], 'integer'],
            [['fechamemo', 'created_at', 'updated_at'], 'safe'],
            [['fechamemo', 'unidadfinal', 'estatus3final'],'required'],
            [['asunto'], 'string', 'max' => 150],
            [['dirorigen'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['dirorigen' => 'id']],
            [['dirfinal'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['dirfinal' => 'id']],
            [['estatus1origen'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus1::className(), 'targetAttribute' => ['estatus1origen' => 'id']],
            [['estatus1final'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus1::className(), 'targetAttribute' => ['estatus1final' => 'id']],
            [['estatus2origen'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus2::className(), 'targetAttribute' => ['estatus2origen' => 'id']],
            [['estatus2final'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus2::className(), 'targetAttribute' => ['estatus2final' => 'id']],
            [['estatus3origen'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus3::className(), 'targetAttribute' => ['estatus3origen' => 'id']],
            [['estatus3final'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus3::className(), 'targetAttribute' => ['estatus3final' => 'id']],
            [['unidadorigen'], 'exist', 'skipOnError' => true, 'targetClass' => Recepciones::className(), 'targetAttribute' => ['unidadorigen' => 'id']],
            [['unidadfinal'], 'exist', 'skipOnError' => true, 'targetClass' => Recepciones::className(), 'targetAttribute' => ['unidadfinal' => 'id']],
            [['trabajadororigen'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['trabajadororigen' => 'id']],
            [['trabajadorfinal'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['trabajadorfinal' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dirorigen' => 'Direccion de Origen',
            'unidadorigen' => 'Unidad de Origen',
            'trabajadororigen' => 'Trabajador a Cargo',
            'estatus1origen' => 'Estatus1 Origen',
            'estatus2origen' => 'Estatus2 Origen',
            'estatus3origen' => 'Estatus3 Origen',
            'dirfinal' => 'Dirección Final',
            'unidadfinal' => 'Unidad final',
            'trabajadorfinal' => 'Trabajador Final',
            'estatus1final' => 'Estatus1 Final',
            'estatus2final' => 'Estatus2 Final',
            'estatus3final' => 'Estatus3 Final',
            'fechamemo' => 'Fecha',
            'asunto' => 'Asunto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'verorpa' => 'Ver Orden de Pago',
            'vercheque' => 'Ver Cheque',
            'vertelefono' => 'Ver Telefono', 
            'verunidad' => 'Ver Unidad Bienestar Social',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirorigennombre()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'dirorigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirfinalnombre()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'dirfinal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1origennombre()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1finalnombre()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2origennombre()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2finalnombre()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3origennombre()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3finalnombre()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadorigennombre()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'unidadorigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadfinalnombre()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'unidadfinal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadororigennombre()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajadororigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadorfinalnombre()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajadorfinal']);
    }
    
}
