<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\db\Expression;

/**
 * This is the model class for table "docs".
 *
 * @property integer $id
 * @property string $title
 * @property string $docs
 * @property string $covenant
 * @property string $ref
 * @property string $expdate
 */
class Docs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const UPLOAD_FOLDER = 'mydocs';
    public static function tableName()
    {
        return 'docs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expdate','createdate'], 'safe'],
            [['title', 'docs', 'covenant'], 'string', 'max' => 255],
            [['ref'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
            
            [['covenant'],'file','maxFiles'=>1,'skipOnEmpty'=>true],
            [['docs'],'file','maxFiles'=>3,'skipOnEmpty'=>true], 
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'เนื้อหา',
            'docs' => 'เอกสาร',
            'covenant' => 'รูปภาพ',
            'ref' => 'อ้างอิง',
            'expdate' => 'สิ้นสุด',
            'description' => 'รายละเอียด',
            'createdate' => 'วันบันทึก',
        ];
    }
    
    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function listDownloadFiles($type){
     $docs_file = '';
     if(in_array($type, ['docs','covenant'])){         
             $data = $type==='docs'?$this->docs:$this->covenant;
             $files = Json::decode($data);
            if(is_array($files)){
                 $docs_file ='<ul>';
                 foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['/docs/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
                 }
                 $docs_file .='</ul>';
            }
     }
     
     return $docs_file;
    }

    public function initialPreview($data,$field,$type='file'){
            $initial = [];
            $files = Json::decode($data);
            if(is_array($files)){
                 foreach ($files as $key => $value) {
                    if($type=='file'){
                        $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                    }elseif($type=='config'){
                        $initial[] = [
                            'caption'=> $value,
                            'width'  => '70px',
                            'url'    => Url::to(['/docs/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                            'key'    => $key
                        ];
                    }
                    else{
                        $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'name'=>$model->file_name]);
                    }
                 }
         }
        return $initial;
    }
}
