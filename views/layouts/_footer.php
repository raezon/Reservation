<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<section class="mb-0 mt-0">
  <div class="footer">
    <div class="bg-light pt-5 pb-5">
      <div class="container">

        <div class="row">
          <div class="col-xs-6 col-sm-3">
            <a href="#">
                <?= Html::img('logo.png', ['width' => 60]) ?>
            </a>
            <address class="color-light-20">
              Rue 1600 Ville, Dept. 5
              <br>Paris, France
            </address>
            <ul class="list-unstyled list-light">
              <li>
                <a href="#">Disclaimer</a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 col-sm-3">
            <h4 class="my-2">Product</h4>
            <ul class="list-unstyled list-light">
              <li>
                <a href="#">Pricing</a>
              </li>
              <li>
                <a href="<?= Url::to(['site/features']) ?>">Features</a>
              </li>
              <li>
                <a href="#">Customers</a>
              </li>
              <li>
                <a href="#">Store</a>
              </li>
            </ul>
          </div>
          <br style="clear:both" class="hidden-sm-up">
          <div class="col-xs-6 col-sm-3">
            <h4 class="my-2">Company</h4>
            <ul class="list-unstyled list-light">
              <li>
                <a href="<?= Url::to(['site/about']) ?>">About Us</a>
              </li>
              <li>
                <a href="#">Blog</a>
              </li>
              <li>
                <a href="#">Careers</a>
              </li>
              <li>
                <a href="#">Press</a>
              </li>
              <li>
                <a href="#">Events</a>
              </li>
              <li>
                <a href="<?= Url::to(['site/contact']) ?>">Contact</a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 col-sm-3">
            <h4 class="my-2">Connect</h4>
            <ul class="list-unstyled list-light">
              <li>
                <a href="#">Support</a>
              </li>
              <li>
                <a href="#">Social</a>
              </li>
              <li>
                <a href="#">Community</a>
              </li>
            </ul>

          </div>
        </div>
        <hr>
        <div class="row f-flex justify-content-center" style="">
          <div class="col text-center text-secondary my-1">
              <p class="mt-2">Copyright &copy; <?= date('Y')?> All Rights Reserved |
              <a class=" " href="<?= Url::to(['site/disclaimer']) ?>">Disclaimer</a> |
              <a class=" " href="<?= Url::to(['site/contact']) ?>">Contact</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>