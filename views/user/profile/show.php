<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Partner;
use app\models\User;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $model
 */

$this->title = empty($model->name) ? Html::encode($model->user->username) : Html::encode($model->name);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <?= Html::img($model->getAvatarUrl(230), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => $model->user->username,
                ]) ?>
            </div>
            <div class="col-sm-6 col-md-8">
                <h4><?= $this->title ?></h4>
                <ul style="padding: 0; list-style: none outside none;">
                    <?php if (!empty($model->location)) : ?>
                        <li>
                            <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($model->location) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($model->website)) : ?>
                        <li>
                            <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($model->website), Html::encode($model->website)) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($model->public_email)) : ?>
                        <li>
                            <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($model->public_email), 'mailto:' . Html::encode($model->public_email)) ?>
                        </li>
                    <?php endif; ?>
                    <li>
                        <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $model->user->created_at) ?>
                    </li>
                </ul>
                <?php if (!empty($model->bio)) : ?>
                    <p><?= Html::encode($model->bio) ?></p>
                <?php endif; ?>
            </div>
        </div><!-- .row -->
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-right">
            <?php $model1 = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one() ?>
            <?php if (!empty($model1)) : ?>
                <?= Html::a(\Yii::t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
            <?php else : ?>
                <?= Html::a(\Yii::t('app', "You can only change your profile after creation of a product"), ["can't update", 'id' => $model->user_id], ['class' => 'btn btn-danger disabled']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>