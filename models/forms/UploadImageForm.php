<?php

namespace app\models\forms;

use yii\base\Model;

class UploadImageForm extends Model
{
   public $image;
   public function rules()
   {
      return [
         [['image'], 'file', 'maxFile' => 10, 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],

      ];
   }
   public function upload()
   {
      if ($this->validate()) {
         $this->image->saveAs('../img/' . $this->image->baseName . '.' .
            $this->image->extension);
         return true;
      } else {
         return false;
      }
   }
}
