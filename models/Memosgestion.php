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
            'dirorigen' => 'Dirorigen',
            'unidadorigen' => 'Unidadorigen',
            'trabajadororigen' => 'Trabajadororigen',
            'estatus1origen' => 'Estatus1origen',
            'estatus2origen' => 'Estatus2origen',
            'estatus3origen' => 'Estatus3origen',
            'dirfinal' => 'Dirfinal',
            'unidadfinal' => 'Unidadfinal',
            'trabajadorfinal' => 'Trabajadorfinal',
            'estatus1final' => 'Estatus1final',
            'estatus2final' => 'Estatus2final',
            'estatus3final' => 'Estatus3final',
            'fechamemo' => 'Fechamemo',
            'asunto' => 'Asunto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirorigen0()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'dirorigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirfinal0()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'dirfinal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1origen0()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus1final0()
    {
        return $this->hasOne(Estatus1::className(), ['id' => 'estatus1final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2origen0()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus2final0()
    {
        return $this->hasOne(Estatus2::className(), ['id' => 'estatus2final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3origen0()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3origen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3final0()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3final']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadorigen0()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'unidadorigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadfinal0()
    {
        return $this->hasOne(Recepciones::className(), ['id' => 'unidadfinal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadororigen0()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajadororigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadorfinal0()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajadorfinal']);
    }
}
