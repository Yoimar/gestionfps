<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "personas".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property integer $tipo_nacionalidad_id
 * @property string $ci
 * @property string $sexo
 * @property integer $estado_civil_id
 * @property string $lugar_nacimiento
 * @property string $fecha_nacimiento
 * @property integer $nivel_academico_id
 * @property integer $parroquia_id
 * @property string $ciudad
 * @property string $zona_sector
 * @property string $calle_avenida
 * @property string $apto_casa
 * @property string $telefono_fijo
 * @property string $telefono_celular
 * @property string $telefono_otro
 * @property string $email
 * @property string $twitter
 * @property boolean $ind_trabaja
 * @property string $ocupacion
 * @property string $ingreso_mensual
 * @property string $observaciones
 * @property boolean $ind_asegurado
 * @property integer $seguro_id
 * @property string $cobertura
 * @property string $otro_apoyo
 * @property integer $version
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FamiliaPersona[] $familiaPersonas
 * @property FamiliaPersona[] $familiaPersonas0
 * @property Personas[] $personaBeneficiarios
 * @property Personas[] $personaFamilias
 * @property EstadosCiviles $estadoCivil
 * @property NivelesAcademicos $nivelAcademico
 * @property Parroquias $parroquia
 * @property TipoNacionalidades $tipoNacionalidad
 * @property Solicitudes[] $solicitudes
 * @property Solicitudes[] $solicitudes0
 */
class Personas extends \yii\db\ActiveRecord
{
    public $estado_id;
    public $municipio_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'ind_asegurado',], 'required'],
            [['tipo_nacionalidad_id', 'ci', 'estado_civil_id', 'nivel_academico_id', 'parroquia_id', 'seguro_id', 'version'], 'integer'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['ind_trabaja', 'ind_asegurado'], 'boolean'],
            [['ingreso_mensual', 'cobertura'], 'number'],
            [['tipo_nacionalidad_id'], 'default', 'value' => 1],
            [['nombre', 'apto_casa'], 'string', 'max' => 50],
            [['apellido'], 'string', 'max' => 30],
            [['sexo'], 'string', 'max' => 1],
            [['lugar_nacimiento'], 'string', 'max' => 500],
            [['ciudad'], 'string', 'max' => 15],
            [['zona_sector', 'calle_avenida'], 'string', 'max' => 250],
            [['telefono_fijo', 'telefono_celular', 'telefono_otro'], 'string', 'max' => 12],
            [['email', 'twitter', 'ocupacion'], 'string', 'max' => 100],
            [['observaciones'], 'string', 'max' => 1500],
            [['otro_apoyo'], 'string', 'max' => 200],
            [['estado_civil_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosCiviles::className(), 'targetAttribute' => ['estado_civil_id' => 'id']],
            [['nivel_academico_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelesAcademicos::className(), 'targetAttribute' => ['nivel_academico_id' => 'id']],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquias::className(), 'targetAttribute' => ['parroquia_id' => 'id']],
            [['tipo_nacionalidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoNacionalidades::className(), 'targetAttribute' => ['tipo_nacionalidad_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'tipo_nacionalidad_id' => 'Tipo de Nacionalidad',
            'ci' => 'Ci',
            'sexo' => 'Sexo',
            'estado_civil_id' => 'Estado Civil',
            'lugar_nacimiento' => 'Lugar de Nacimiento',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'nivel_academico_id' => 'Nivel Academico',
            'estado_id'=> 'Estado',
            'municipio_id'=> 'Municipio',
            'parroquia_id' => 'Parroquia ID',
            'ciudad' => 'Ciudad',
            'zona_sector' => 'Zona Sector',
            'calle_avenida' => 'Calle Avenida',
            'apto_casa' => 'Apto Casa',
            'telefono_fijo' => 'Telefono Fijo',
            'telefono_celular' => 'Telefono Celular',
            'telefono_otro' => 'Telefono Otro',
            'email' => 'Email',
            'twitter' => 'Twitter',
            'ind_trabaja' => 'Ind Trabaja',
            'ocupacion' => 'Ocupacion',
            'ingreso_mensual' => 'Ingreso Mensual',
            'observaciones' => 'Observaciones',
            'ind_asegurado' => 'Ind Asegurado',
            'seguro_id' => 'Seguro ID',
            'cobertura' => 'Cobertura',
            'otro_apoyo' => 'Otro Apoyo',
            'version' => 'Version',
            'created_at' => 'Creado el Día',
            'updated_at' => 'Actualizado el Día',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliaPersonas()
    {
        return $this->hasMany(FamiliaPersona::className(), ['persona_familia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliaPersonas0()
    {
        return $this->hasMany(FamiliaPersona::className(), ['persona_beneficiario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaBeneficiarios()
    {
        return $this->hasMany(Personas::className(), ['id' => 'persona_beneficiario_id'])->viaTable('familia_persona', ['persona_familia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaFamilias()
    {
        return $this->hasMany(Personas::className(), ['id' => 'persona_familia_id'])->viaTable('familia_persona', ['persona_beneficiario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCivil()
    {
        return $this->hasOne(EstadosCiviles::className(), ['id' => 'estado_civil_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelesAcademicos()
    {
        return $this->hasOne(NivelesAcademicos::className(), ['id' => 'nivel_academico_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquias::className(), ['id' => 'parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoNacionalidades()
    {
        return $this->hasOne(TipoNacionalidades::className(), ['id' => 'tipo_nacionalidad_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes()
    {
        return $this->hasMany(Solicitudes::className(), ['persona_beneficiario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudes0()
    {
        return $this->hasMany(Solicitudes::className(), ['persona_solicitante_id' => 'id']);
    }
    
    public function getNombrecompleto() 
    {
        return $this->nombre." ".$this->apellido;
    }
    
    public function getPersonacompleta() 
    {
        return "C.I.: ".$this->ci." // ".$this->nombre." ".$this->apellido;
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

        ];
    }
    
}
