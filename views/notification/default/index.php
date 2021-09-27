<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('modules/notifications', 'Notifications');

?>

<div class="page-header">
    <div class="buttons">
        <a class="btn btn-danger" href="<?= Url::toRoute(['/notifications/default/delete-all']) ?>"><?= Yii::t('modules/notifications', 'Suprimer tous'); ?></a>
    </div>

    <h1>
        <span class="icon icon-bell"></span>
        <span>Messages</span>
    </h1>
</div>

<div class="page-content">

    <ul id="notifications-items">
        <?php if ($notifications) : ?>
            <?php foreach ($notifications as $notif) : ?>
                <li class="notification-item<?php if ($notif['read']) : ?> <?php endif; ?>" data-id="<?= $notif['id']; ?>" data-key="<?= $notif['key']; ?>">
                    <!--<a href="// $notif['url'] ?>">-->
                    <div>
                      
                        <span class="message"><?= Html::encode($notif['key']); ?></span>
                    </div>

                    <!-- </a>-->
                    <small class="timeago"><?= $notif['timeago']; ?></small>
                   

                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li class="empty-row"><?= Yii::t('modules/notifications', 'Il n\'y a aucune notification à afficher') ?></li>
        <?php endif; ?>
    </ul>

    <?= LinkPager::widget(['pagination' => $pagination]); ?>

</div>