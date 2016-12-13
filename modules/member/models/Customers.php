<?php

namespace app\modules\member\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $addr
 * @property integer $t
 * @property integer $a
 * @property integer $c
 * @property string $p
 * @property string $tel
 * @property string $work
 * @property string $pos
 * @property string $interest
 * @property string $money
 * @property integer $pay
 * @property string $slip
 * @property string $fb
 * @property string $line
 * @property string $email
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $slip_img;
    
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','addr','work','t', 'a', 'c','tel'], 'required'],
            [['t', 'a', 'c', 'pay'], 'integer'],
            [['money'], 'number'],
            [['createdate','paydate'],'safe'],
            [['name'], 'string', 'max' => 150],
            [['addr', 'fb', 'line', 'email'], 'string', 'max' => 100],
            [['p', 'tel', 'work', 'pos', 'interest', 'slip'], 'string', 'max' => 255],
            [['slip_img'],'file','skipOnEmpty'=>'true','on'=>'update','extensions'=>'jpg,png']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ - สกุล',
            'addr' => 'ที่อยู่ ',
            't' => 'ตำบล',
            'a' => 'อำเภอ',
            'c' => 'จังหวัด',
            'p' => 'รหัสไปรษณีย์',
            'tel' => 'โทรศัพท์',
            'work' => 'สถานที่ทำงาน',
            'pos' => 'ตำแหน่ง',
            'interest' => 'ความสนใจ',
            'money' => 'ยอดโอน',
            'pay' => 'การชำระ',
            'slip' => 'รูปถ่ายหลักฐาน',
            'fb' => 'Facebook',
            'line' => 'Line',
            'email' => 'Email',
            'paydate' => 'วันที่ชำระ',
            'createdate'=>'วันที่ลงทะเบียน'
        ];
    }
     public function getChwt(){
        return $this->hasOne(\app\models\Chw::className(), ['id'=>'c']);
    }
    public function getAmpur(){
        return $this->hasOne(\app\models\Amp::className(), ['id'=>'a']);
    }
    public function getTmbon(){
        return $this->hasOne(\app\models\Tmb::className(), ['id'=>'t']);
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
                    $docs_file .= '<li>'.Html::a($value,['/riskreports/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
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
                            'url'    => Url::to(['/riskreports/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
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
