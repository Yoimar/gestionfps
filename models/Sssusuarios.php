<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sss_usuarios".
 *
 * @property string $codemp
 * @property string $codusu
 * @property string $cedusu
 * @property string $nomusu
 * @property string $apeusu
 * @property string $fecnacusu
 * @property string $pwdusu
 * @property string $telusu
 * @property string $email
 * @property string $nota
 * @property int $actusu
 * @property int $blkusu
 * @property int $estatus
 * @property int $admusu
 * @property string $ultingusu
 * @property string $fecblousu
 * @property string $fotousu
 * @property string $corele
 * @property string $estblocon
 *
 * @property SpgRegmodprogramado[] $spgRegmodprogramados
 * @property SssDerechosUsuarios[] $sssDerechosUsuarios
 * @property SssEnvioCorreo[] $sssEnvioCorreos
 * @property SssSistemasVentanas[] $codses
 * @property SssNivUsuarios[] $sssNivUsuarios
 * @property SigespAsigNivel[] $codemps
 * @property SssPermisosInternos[] $sssPermisosInternos
 * @property SssUsuarioSistema[] $sssUsuarioSistemas
 * @property SssSistemas[] $codses0
 * @property SigespEmpresa $codemp0
 * @property SssUsuariosEnGrupos[] $sssUsuariosEnGrupos
 * @property SssGrupos[] $codemps0
 * @property SssUsuariosdetalle[] $sssUsuariosdetalles
 */
class Sssusuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sss_usuarios';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbsigesp');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codemp', 'codusu', 'nomusu', 'apeusu', 'pwdusu'], 'required'],
            [['fecnacusu', 'ultingusu', 'fecblousu'], 'safe'],
            [['nota'], 'string'],
            [['actusu', 'blkusu', 'estatus', 'admusu'], 'default', 'value' => null],
            [['actusu', 'blkusu', 'estatus', 'admusu'], 'integer'],
            [['codemp'], 'string', 'max' => 4],
            [['codusu'], 'string', 'max' => 30],
            [['cedusu'], 'string', 'max' => 8],
            [['nomusu', 'email', 'corele'], 'string', 'max' => 100],
            [['apeusu', 'pwdusu'], 'string', 'max' => 50],
            [['telusu'], 'string', 'max' => 20],
            [['fotousu'], 'string', 'max' => 254],
            [['estblocon'], 'string', 'max' => 1],
            [['codemp', 'codusu'], 'unique', 'targetAttribute' => ['codemp', 'codusu']],
            [['codemp'], 'exist', 'skipOnError' => true, 'targetClass' => SigespEmpresa::className(), 'targetAttribute' => ['codemp' => 'codemp']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codemp' => 'Codemp',
            'codusu' => 'Codusu',
            'cedusu' => 'Cedusu',
            'nomusu' => 'Nomusu',
            'apeusu' => 'Apeusu',
            'fecnacusu' => 'Fecnacusu',
            'pwdusu' => 'Pwdusu',
            'telusu' => 'Telusu',
            'email' => 'Email',
            'nota' => 'Nota',
            'actusu' => 'Actusu',
            'blkusu' => 'Blkusu',
            'estatus' => 'Estatus',
            'admusu' => 'Admusu',
            'ultingusu' => 'Ultingusu',
            'fecblousu' => 'Fecblousu',
            'fotousu' => 'Fotousu',
            'corele' => 'Corele',
            'estblocon' => 'Estblocon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpgRegmodprogramados()
    {
        return $this->hasMany(SpgRegmodprogramado::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssDerechosUsuarios()
    {
        return $this->hasMany(SssDerechosUsuarios::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssEnvioCorreos()
    {
        return $this->hasMany(SssEnvioCorreo::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodses()
    {
        return $this->hasMany(SssSistemasVentanas::className(), ['codsis' => 'codsis', 'codmenu' => 'codmenu'])->viaTable('sss_envio_correo', ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssNivUsuarios()
    {
        return $this->hasMany(SssNivUsuarios::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps()
    {
        return $this->hasMany(SigespAsigNivel::className(), ['codemp' => 'codemp', 'codasiniv' => 'codasiniv', 'codniv' => 'codniv'])->viaTable('sss_niv_usuarios', ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssPermisosInternos()
    {
        return $this->hasMany(SssPermisosInternos::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssUsuarioSistemas()
    {
        return $this->hasMany(SssUsuarioSistema::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodses0()
    {
        return $this->hasMany(SssSistemas::className(), ['codsis' => 'codsis'])->viaTable('sss_usuario_sistema', ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemp0()
    {
        return $this->hasOne(SigespEmpresa::className(), ['codemp' => 'codemp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssUsuariosEnGrupos()
    {
        return $this->hasMany(SssUsuariosEnGrupos::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodemps0()
    {
        return $this->hasMany(SssGrupos::className(), ['codemp' => 'codemp', 'nomgru' => 'nomgru'])->viaTable('sss_usuarios_en_grupos', ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSssUsuariosdetalles()
    {
        return $this->hasMany(SssUsuariosdetalle::className(), ['codemp' => 'codemp', 'codusu' => 'codusu']);
    }
}
