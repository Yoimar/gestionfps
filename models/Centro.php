<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro".
 *
 * @property int $id
 * @property string $nombre
 * @property int $centro_tipo_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Centrotipo $centroTipo
 * @property User $createdBy
 * @property User $updatedBy
 * @property CentroClasificacion[] $centroClasificacions
 */
class Centro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'centro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'centro_tipo_id'], 'required'],
            [['centro_tipo_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['centro_tipo_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['centro_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Centrotipo::className(), 'targetAttribute' => ['centro_tipo_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'nombre' => 'Nombre del Centro',
            'centro_tipo_id' => 'Tipo de Centro',
            'created_at' => 'Creado el:',
            'created_by' => 'Creado por:',
            'updated_at' => 'Actualizado el:',
            'updated_by' => 'Actualizado por:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroTipo()
    {
        return $this->hasOne(CentroTipo::className(), ['id' => 'centro_tipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroClasificacions()
    {
        return $this->hasMany(CentroClasificacion::className(), ['centro_id' => 'id']);
    }
}
