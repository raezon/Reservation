<?php 
//use \yii\helpers\Html;
//vars:
//$page: page index
//$partners: array of Partner
//$perPage: nbr of partner per slide
//$mod: module of count($partners) % $perPage
?>
<div class="carousel-item row <?= $page==0?' active':'' ?>">
    <?php
    for ($i = 0; $i < $perPage; $i++){
        $index = $i + ($page * $perPage);
       
            $this->render('_partner_card', [
               'model1' => $model1[$index], 
               'perPage' => $perPage
           ]);
        
    }
    ?>
</div>
