<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use \Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $img;
    public $attribute = 'img';
    public $model;

    public $directory = 'content';

    
    public function rules()
    {
        return [
            [['img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg',],
        ];
    }

    /**
     * Upload images, if $watermark == true add watermark otherwise without watermark
     * @return bool|string
     * @internal param bool $watermark
     */
    public function upload($flag = true)
    {
        if(empty($this->img->name)){
            return $this->model->{$this->attribute};
        }
        if ($this->validate()) {
            $absoluteDirectory = Yii::$app->params['uploadPath'] . '/' . $this->directory;
            if (!is_dir($absoluteDirectory)){
                mkdir($absoluteDirectory, 0777);
                mkdir($absoluteDirectory . '/original', 0777);
                mkdir($absoluteDirectory . '/thumbs_small', 0777);
                mkdir($absoluteDirectory . '/thumbs_medium', 0777);
                mkdir($absoluteDirectory . '/thumbs_big', 0777);
            }

            $fileName    = substr(md5(md5(microtime(true)) . md5(0, 100)), 0, 10) . '.' . $this->img->extension;
            $absoluteImg = $absoluteDirectory . '/original/' . $fileName;
            $this->img->saveAs($absoluteImg);
            
            $imgDb = '/' . $this->directory . '/original/' . $fileName;
            $image = Yii::$app->image->load($absoluteImg);

            $image->resize(860, FALSE)->save($absoluteDirectory . '/thumbs_big/' . $fileName, 90);
            $image->resize(600, FALSE)->save($absoluteDirectory . '/thumbs_medium/' . $fileName, 90);
            $image->resize(450, FALSE)->save($absoluteDirectory . '/thumbs_small/' . $fileName, 90); 

            return $imgDb;
        } else {
            return false;
        }
    }
}