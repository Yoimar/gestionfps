<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "fotos_solicitud".
 *
 * @property int $id
 * @property int $solicitud_id
 * @property string $descripcion
 * @property string $foto
 * @property bool $ind_reporte
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Solicitudes $solicitud
 */
class Fotossolicitud extends \yii\db\ActiveRecord
{
    //Variable para guardar las imagenes Primero simple
    public $imagen;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos_solicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //Atributos de la Imagen para subir archivos
            [['imagen'], 'file',
                'maxSize' => 1024*1024*4, //4 MB
                'tooBig' => 'El tamaño máximo permitido es 4MB', //Error
                'minSize' => 1, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'pdf, txt, doc, jpg, png, gif, pptx',
                'wrongExtension' => 'El archivo {imagen} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 2,
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
            [['solicitud_id', 'descripcion', 'foto', 'created_at', 'updated_at'], 'required'],
            [['solicitud_id'], 'default', 'value' => null],
            [['solicitud_id'], 'integer'],
            [['ind_reporte'], 'boolean'],
            [['created_at', 'imagen' ,'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
            [['foto'], 'string', 'max' => 255],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitudes::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solicitud_id' => 'Solicitud ID',
            'descripcion' => 'Descripcion',
            'foto' => 'Foto',
            'ind_reporte' => 'Ind Reporte',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'solicitud_id']);
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
                'value' => Yii::$app->formatter->asDate('now','php:Y-m-d H:i:s'),
            ],

        ];
    }
    /***   Para revision del Modelo ***/
    public function getImageFile()
    {
        return isset($this->avatar) ? Yii::$app->params['uploadPath'] . $this->avatar : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->avatar) ? $this->avatar : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . $avatar;
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->filename = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->avatar = null;
        $this->filename = null;

        return true;
    }

//Fin de la clase
}
