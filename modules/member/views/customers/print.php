<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
?> 
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">

<tr>
    <td></td>
    <td>&nbsp;</td>
<td></td></tr>



</head>
<body>
    <div style="padding-left:20px;"><h1>ประชุมเชิงปฏิบัติการ การเขียนโปรแกรมด้วย PHP Yii Framework</h1></div> 
  
    <div style="padding-left:80px;"><h2>ห้องประชุมชั้น 2 รพ.ศรีวิไล จ.บึงกาฬ วันที่ 16 -18 มค. 2560</h2></div>    
    
<h3>
    ผู้เข้าอบรม : <?= $model->name; ?> 
</h3>

<p>
<h4>
    รูปถ่ายหลักฐานการชำระ | วันที่ชำระ : <?= $model->paydate; ?>
</h4>
<div class="head">
    <?= Html::img('img/'.$model->slip,['class'=>'thumbnail img-responsive center','style'=>'widht: 250 px; height: 300px;'])?></p>

</div><br><br><br><br><br>
<div>
    <strong><h2>ติดต่อผู้จัดอบรม : คุณไอน้ำ เรืองโพน ( น้ำ ) Tel 091-3638928 </h2>
        
        <h2>ID FB : เป็นดั่ง พรุ    | หรือ ID Line : inamjung</h2> 
    
    
    </strong>
  
</div>

</body>
</html>
