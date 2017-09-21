<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conexionsigesp".
 *
 * @property integer $id
 * @property integer $id_presupuesto
 * @property integer $rif
 * @property string $req
 * @property string $codestpre
 * @property string $cuenta
 * @property string $date
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Presupuestos $idPresupuesto
 */
class Conexionsigesp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conexionsigesp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_presupuesto', 'rif', 'created_by', 'updated_by'], 'integer'],
            [['codestpre'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['req'], 'string', 'max' => 15],
            [['cuenta'], 'string', 'max' => 25],
            [['id_presupuesto'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuestos::className(), 'targetAttribute' => ['id_presupuesto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_presupuesto' => 'Id Presupuesto',
            'rif' => 'Rif',
            'req' => 'Req',
            'codestpre' => 'Codestpre',
            'cuenta' => 'Cuenta',
            'date' => 'Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPresupuesto()
    {
        return $this->hasOne(Presupuestos::className(), ['id' => 'id_presupuesto']);
    }
}
