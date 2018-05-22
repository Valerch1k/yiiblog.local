<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.09.2017
 * Time: 11:55
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public  $image;

    // валидация , разрешаем загружать только jpg,png
    public function rules()
    {
        return [
            [['image'],'required'],
            [['image'],'file','extensions'=>'jpg,png']
        ];
    }

    //сохраняет файл картинки на сервер
    public function uploadFile(UploadedFile $file,$currentImage)
    {
        $this->image = $file;

        if($this->validate())
        {
            // если  картинка  существует , то удаляем
            $this->deleteCurrentImage($currentImage);
            // меняем имя на уникальное , чтобы не было повторов
            $filename = $this->generateFilename();
            // сохраняем файл на се6рвер
            $file->saveAs($this->getFolder().$filename);
            // возвращаем имя сохраненного файла
            return $filename;
        }

    }

    private  function  getFolder()
    {
        return Yii::getAlias('@web').'uploads/';
    }

    private  function  generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)).'.'.$this->image->extension);
    }

    public  function deleteCurrentImage($currentImage)
    {
        // если  картинка  существует , то  удаляем
        if($this->fileExists($currentImage))
        {
            unlink($this->getFolder().$currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        if(!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder().$currentImage);
        }
    }


}