<?php

use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\helpers\HtmlPurifier;

/**
 * model: Partner object
 */
Yii::setAlias('@productImgUrl', 'img/products');
//Getting Detail of the products
$detail = $model1->detail($model1->product_id, $model1->partner_category);
$totalPrice= $model1->totalPrice($model1->description, $model1->partner_category, $model1->price, $model1->quantity, $qte_search, $model1->people_number,$model1->checkbox, $_SESSION['subcategory']);
if($totalPrice>0){?>



<div class="col-sm-12  float-right">
  <div class="card mb-12">
    <?php
    if ($model1->partner_category == 1) {
      $deliveryPrice = 0;
    }
    if ($model1->partner_category == 3)
      $name = $model1->name;
    else
      $name = $model1->OldAttributes['name'];
    $currencies = "";
    if (!empty($model1->OldAttributes['currencies_symbol']))
      $currencies = $model1->OldAttributes['currencies_symbol'];
    if (!empty($model1->currencies_symbol))
      $currencies = $model1->currencies_symbol;

    ?>
    <div class="card-body">
      <!--Partie Company Name-->
      <div id="photo" class="col-sm-12 float-left" style="text-align: left">
        <span style="vertical-align:left;font-size:40px;text-decoration:underline;"><?= '<b>' . $detail[0]->name . '</b>' ?></span>
        <span class="float-sm-right"><?= $model1->distance . 'km' ?></span>
      </div>
      <!--Partie Address                                                 -->
      <div id="photo" class="col-sm-12 float-left" style="text-align: left">
        <img style="vertical-align:left" width="20px" height="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTQwNy41NzkgODcuNjc3Yy0zMS4wNzMtNTMuNjI0LTg2LjI2NS04Ni4zODUtMTQ3LjY0LTg3LjYzNy0yLjYyLS4wNTQtNS4yNTctLjA1NC03Ljg3OCAwLTYxLjM3NCAxLjI1Mi0xMTYuNTY2IDM0LjAxMy0xNDcuNjQgODcuNjM3LTMxLjc2MiA1NC44MTItMzIuNjMxIDEyMC42NTItMi4zMjUgMTc2LjEyM2wxMjYuOTYzIDIzMi4zODdjLjA1Ny4xMDMuMTE0LjIwNi4xNzMuMzA4IDUuNTg2IDkuNzA5IDE1LjU5MyAxNS41MDUgMjYuNzcgMTUuNTA1IDExLjE3NiAwIDIxLjE4My01Ljc5NyAyNi43NjgtMTUuNTA1LjA1OS0uMTAyLjExNi0uMjA1LjE3My0uMzA4bDEyNi45NjMtMjMyLjM4N2MzMC4zMDQtNTUuNDcxIDI5LjQzNS0xMjEuMzExLTIuMzI3LTE3Ni4xMjN6bS0xNTEuNTc5IDE0NC4zMjNjLTM5LjcwMSAwLTcyLTMyLjI5OS03Mi03MnMzMi4yOTktNzIgNzItNzIgNzIgMzIuMjk5IDcyIDcyLTMyLjI5OCA3Mi03MiA3MnoiIGZpbGw9IiM2MjU1YTAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcGF0aD48L2c+PC9nPjwvc3ZnPg==" />
        <?php if ($model1->partner_category == 1) { ?>
          <?php $addres_room_tental = json_decode($model1->languages, true);
          $addres_room_tental = $addres_room_tental['address']; ?>
          <span style="vertical-align:left" class=" card-text"><?= '' . $addres_room_tental ?></span>
        <?php } else { ?>
          <span style="vertical-align:left" class=" card-text"><?= '' . $detail[1]->address  ?></span>
        <?php } ?>
      </div>
      <br clear="all" /><br />
      <!--Partie Récuperation image-->
      <div class="row">
        <?php

        $image = json_decode($model1->picture, true);
        $path = Yii::getAlias('@productImgUrl') . '/' . $image[0];

        //patie image
        if ($model1->picture != "") { ?>

          <div class="col-sm-4 float-left">
          <?php
          echo  Html::img($path, ['width' => '100%', 'height' => '200px']);
        }
          ?>
          </div>
          <div class="col-sm-6 float-left">
            <?php if ($model1->partner_category == 3) : ?>
              <p class="card-text"><?= '<b>Plat name</b><b class="triangle-right"></b>' .  $model1->product_type  ?></p>
            <?php endif ?>
            <?php if ($model1->partner_category != 3) : ?>
              <?php if ($model1->partner_category != 6) : ?>
                <p class="card-text"><?= '<b>Product name</b><b class="triangle-right"></b>' .  $model1->name  ?></p>
              <?php endif ?>
            <?php endif ?>
            <!--Affichage detail of product if fulfy a condition of partner_category == 2-->
            <?php if ($model1->partner_category == 1) : ?>
              <?php
              $temp = json_decode($model1->temp, true);
              $description = json_decode($model1->description, true);
              ?>
              <p class="card-text"><?= '<b>Type of room</b><b class="triangle-right"></b>' . $temp[0] ?></p>
              <p class="card-text"><?= '<b>Space for rent</b><b class="triangle-right"></b>' . $description[0]  ?></p>
            <?php endif ?>
            <!--Affichage detail of product if fulfy a condition of partner_category == 2-->
            <?php if ($model1->partner_category == 2) : ?>
              <p class="card-text"><?= '<b>Number equipement</b><b class="triangle-right"></b>' . $model1->quantity  ?></p>
              <p class="card-text"><?= '<b>Duration</b> <b class="triangle-right"></b>' . $model1->periode . 'hour' ?></p>
            <?php endif ?>
            <!--Affichage detail of product if fulfy a condition of partner_category == 2-->
            <?php if ($model1->partner_category == 3) : ?>
              <p class="card-text"><?= '<b>Meal</b><b class="triangle-right"></b>' .  $model1->description ?></p>
              <p class="card-text"><?= '<b>Kind of food </b><b class="triangle-right"></b>' . $detail[0]->kind_of_food  ?></p>
              <?php if ($model1->temp) { ?>
                <?php if ($model1->temp == "Hot") {
                ?>
                  <img width="50px;" height="50px" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSItNDIgMCA1MTIgNTEyIiB3aWR0aD0iNTEycHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTg0LjE0NDUzMSAzOC41MzEyNWM0LjM5NDUzMSAxOS40NDUzMTIgMjcuOTg4MjgxIDI3LjEwOTM3NSA0Mi45Njg3NSAxMy45NjA5MzggMi41MzEyNS0yLjIyMjY1NyA2LjMyNDIxOS41MzEyNSA0Ljk5MjE4OCAzLjYyNS03Ljg3ODkwNyAxOC4zMTI1IDYuNzAzMTI1IDM4LjM4MjgxMiAyNi41NTQ2ODcgMzYuNTUwNzgxIDMuMzU1NDY5LS4zMDg1OTQgNC44MDQ2ODggNC4xNDQ1MzEgMS45MDYyNSA1Ljg2NzE4Ny0xNy4xMzY3MTggMTAuMTg3NS0xNy4xMzY3MTggMzQuOTk2MDk0IDAgNDUuMTc5Njg4IDIuODk4NDM4IDEuNzIyNjU2IDEuNDQ5MjE5IDYuMTc1NzgxLTEuOTA2MjUgNS44NjcxODctMTkuODUxNTYyLTEuODMyMDMxLTM0LjQzMzU5NCAxOC4yMzgyODEtMjYuNTU0Njg3IDM2LjU1MDc4MSAxLjMzMjAzMSAzLjA5NzY1Ny0yLjQ2MDkzOCA1Ljg0NzY1Ny00Ljk5MjE4OCAzLjYyNS0xNC45ODA0NjktMTMuMTQ4NDM3LTM4LjU3ODEyNS01LjQ4MDQ2OC00Mi45Njg3NSAxMy45NjA5MzgtLjc0MjE4NyAzLjI4OTA2Mi01LjQyNTc4MSAzLjI4OTA2Mi02LjE2Nzk2OSAwLTQuMzkwNjI0LTE5LjQ0NTMxMi0yNy45ODQzNzQtMjcuMTA5Mzc1LTQyLjk2ODc1LTEzLjk2MDkzOC0yLjUzMTI1IDIuMjIyNjU3LTYuMzI0MjE4LS41MjczNDMtNC45OTIxODctMy42MjUgNy44Nzg5MDYtMTguMzEyNS02LjcwMzEyNS0zOC4zODI4MTItMjYuNTU0Njg3LTM2LjU1MDc4MS0zLjM1NTQ2OS4zMDg1OTQtNC44MDQ2ODgtNC4xNDQ1MzEtMS45MDYyNS01Ljg2NzE4NyAxNy4xMzY3MTgtMTAuMTgzNTk0IDE3LjEzNjcxOC0zNC45OTIxODggMC00NS4xNzk2ODgtMi44OTQ1MzItMS43MjI2NTYtMS40NDkyMTktNi4xNzU3ODEgMS45MDYyNS01Ljg2NzE4NyAxOS44NTE1NjIgMS44MzIwMzEgMzQuNDMzNTkzLTE4LjIzODI4MSAyNi41NTQ2ODctMzYuNTUwNzgxLTEuMzMyMDMxLTMuMDkzNzUgMi40NjA5MzctNS44NDc2NTcgNC45OTIxODctMy42MjUgMTQuOTg0Mzc2IDEzLjE0ODQzNyAzOC41NzgxMjYgNS40ODQzNzQgNDIuOTY4NzUtMTMuOTYwOTM4Ljc0MjE4OC0zLjI4OTA2MiA1LjQyNTc4Mi0zLjI4OTA2MiA2LjE2Nzk2OSAwem0wIDAiIGZpbGw9IiNmZDhmMzEiLz48cGF0aCBkPSJtMTYwLjU2NjQwNiAxNDMuNzE0ODQ0Yy0xNy4xMzY3MTgtMTAuMTgzNTk0LTE3LjEzNjcxOC0zNC45OTIxODggMC00NS4xNzk2ODggMi44OTg0MzgtMS43MTg3NSAxLjQ0OTIxOS02LjE3NTc4MS0xLjkwNjI1LTUuODYzMjgxLTE5Ljg0NzY1NiAxLjgzMjAzMS0zNC40Mjk2ODctMTguMjQyMTg3LTI2LjU1NDY4Ny0zNi41NTQ2ODcgMS4zMzIwMzEtMy4wOTM3NS0yLjQ1NzAzMS01Ljg0NzY1Ny00Ljk5MjE4OC0zLjYyNS0xNC45ODA0NjkgMTMuMTUyMzQzLTM4LjU3NDIxOSA1LjQ4NDM3NC00Mi45Njg3NS0xMy45NjA5MzgtLjc0MjE4Ny0zLjI4OTA2Mi01LjQyNTc4MS0zLjI4OTA2Mi02LjE2Nzk2OSAwLTEuNjI1IDcuMTkxNDA2LTUuODc1IDEyLjc2MTcxOS0xMS4zNDM3NSAxNi4yNzczNDQgMTkuMzk4NDM4IDE1LjU4OTg0NCAzMS44MjQyMTkgMzkuNDk2MDk0IDMxLjgyNDIxOSA2Ni4zMjAzMTIgMCAyNi44MjAzMTMtMTIuNDI1NzgxIDUwLjczMDQ2OS0zMS44MjQyMTkgNjYuMzIwMzEzIDUuNDY4NzUgMy41MTE3MTkgOS43MTg3NSA5LjA4NTkzNyAxMS4zNDM3NSAxNi4yNzM0MzcuNzQyMTg4IDMuMjg5MDYzIDUuNDI5Njg4IDMuMjg5MDYzIDYuMTY3OTY5IDAgNC4zOTQ1MzEtMTkuNDQ1MzEyIDI3Ljk4ODI4MS0yNy4xMDkzNzUgNDIuOTY4NzUtMTMuOTYwOTM3IDIuNTM1MTU3IDIuMjIyNjU2IDYuMzI0MjE5LS41MjczNDQgNC45OTIxODgtMy42MjUtNy44NzUtMTguMzEyNSA2LjcwNzAzMS0zOC4zODI4MTMgMjYuNTU0Njg3LTM2LjU1MDc4MSAzLjM1NTQ2OS4zMDg1OTMgNC44MDQ2ODgtNC4xNDg0MzggMS45MDYyNS01Ljg3MTA5NHptMCAwIiBmaWxsPSIjZmY3ZjFmIi8+PHBhdGggZD0ibTExNS45MzM1OTQgMTIxLjEyNWMwIDE5LjI2MTcxOS0xNS42MTMyODIgMzQuODcxMDk0LTM0Ljg3NSAzNC44NzEwOTQtMTkuMjU3ODEzIDAtMzQuODcxMDk0LTE1LjYwOTM3NS0zNC44NzEwOTQtMzQuODcxMDk0IDAtMTkuMjU3ODEyIDE1LjYxMzI4MS0zNC44NzEwOTQgMzQuODcxMDk0LTM0Ljg3MTA5NCAxOS4yNjE3MTggMCAzNC44NzUgMTUuNjEzMjgyIDM0Ljg3NSAzNC44NzEwOTR6bTAgMCIgZmlsbD0iI2ZjY2YzZiIvPjxwYXRoIGQ9Im0zMzQuMDExNzE5IDMxNS4zNTU0Njl2LTI1My4xOTUzMTNjMC0zNC4zMzIwMzEtMjcuODMyMDMxLTYyLjE2MDE1Ni02Mi4xNjAxNTctNjIuMTYwMTU2LTM0LjMzMjAzMSAwLTYyLjE2MDE1NiAyNy44MjgxMjUtNjIuMTYwMTU2IDYyLjE2MDE1NnYyNTMuMTk1MzEzYy0yNy44MTI1IDE5LjU2NjQwNi00NS45ODQzNzUgNTEuOTEwMTU2LTQ1Ljk4NDM3NSA4OC41IDAgNTkuNzI2NTYyIDQ4LjQxNzk2OSAxMDguMTQ0NTMxIDEwOC4xNDQ1MzEgMTA4LjE0NDUzMSA1OS43MjY1NjMgMCAxMDguMTQ0NTMyLTQ4LjQxNzk2OSAxMDguMTQ0NTMyLTEwOC4xNDQ1MzEgMC0zNi41ODk4NDQtMTguMTc1NzgyLTY4LjkzMzU5NC00NS45ODQzNzUtODguNXptMCAwIiBmaWxsPSIjZDhkOGQ4Ii8+PHBhdGggZD0ibTI3MS44NTE1NjIgNDc2LjU4MjAzMWMtNDEuMTgzNTkzIDAtNzQuNjg3NS0zMy41MDc4MTItNzQuNjg3NS03NC42ODc1IDAtMzEuMjczNDM3IDE5LjQzMzU5NC01OS4xMTcxODcgNDguNTkzNzUtNjkuOTgwNDY5di0yNjkuNzUzOTA2YzAtMTQuMzkwNjI1IDExLjcwMzEyNi0yNi4wOTM3NSAyNi4wOTM3NS0yNi4wOTM3NSAxNC4zODY3MTkgMCAyNi4wOTM3NSAxMS43MDMxMjUgMjYuMDkzNzUgMjYuMDkzNzV2MjY5Ljc1MzkwNmMyOS4xNTYyNSAxMC44NTkzNzYgNDguNTkzNzUgMzguNzAzMTI2IDQ4LjU5Mzc1IDY5Ljk3NjU2MyAwIDQxLjE4MzU5NC0zMy41MDM5MDYgNzQuNjkxNDA2LTc0LjY4NzUgNzQuNjkxNDA2em0wIDAiIGZpbGw9IiNmM2U4ZDciLz48cGF0aCBkPSJtMjQ1Ljc1NzgxMiAxMDkuODcxMDk0djIyMi4wNDI5NjhjLTI5LjE2MDE1NiAxMC44NTkzNzYtNDguNTkzNzUgMzguNzAzMTI2LTQ4LjU5Mzc1IDY5Ljk3NjU2MyAwIDQxLjE4MzU5NCAzMy41MDM5MDcgNzQuNjg3NSA3NC42ODc1IDc0LjY4NzUgNDEuMTgzNTk0IDAgNzQuNjg3NS0zMy41MDM5MDYgNzQuNjg3NS03NC42ODc1IDAtMzEuMjczNDM3LTE5LjQzNzUtNTkuMTE3MTg3LTQ4LjU5Mzc1LTY5Ljk3NjU2M3YtMjIyLjA0Mjk2OHptMCAwIiBmaWxsPSIjZmM0ZTUxIi8+PGcgZmlsbD0iIzBkNmU5YSI+PHBhdGggZD0ibTQyMC4xMDU0NjkgMTgwLjIxODc1aC00NC44MjQyMTljLTQuMjY5NTMxIDAtNy43MjY1NjItMy40NjA5MzgtNy43MjY1NjItNy43MjY1NjIgMC00LjI2NTYyNiAzLjQ1NzAzMS03LjcyNjU2MyA3LjcyNjU2Mi03LjcyNjU2M2g0NC44MjQyMTljNC4yNjU2MjUgMCA3LjcyNjU2MiAzLjQ2MDkzNyA3LjcyNjU2MiA3LjcyNjU2MyAwIDQuMjY1NjI0LTMuNDYwOTM3IDcuNzI2NTYyLTcuNzI2NTYyIDcuNzI2NTYyem0wIDAiLz48cGF0aCBkPSJtMzk1LjYzMjgxMiAxMTcuNTk3NjU2aC0yMC4zNTE1NjJjLTQuMjY5NTMxIDAtNy43MjY1NjItMy40NjA5MzctNy43MjY1NjItNy43MjY1NjJzMy40NTcwMzEtNy43MjY1NjMgNy43MjY1NjItNy43MjY1NjNoMjAuMzUxNTYyYzQuMjY1NjI2IDAgNy43MjY1NjMgMy40NjA5MzggNy43MjY1NjMgNy43MjY1NjNzLTMuNDYwOTM3IDcuNzI2NTYyLTcuNzI2NTYzIDcuNzI2NTYyem0wIDAiLz48cGF0aCBkPSJtNDAyLjg0Mzc1IDU0Ljk3NjU2MmgtMjcuNTYyNWMtNC4yNjk1MzEgMC03LjcyNjU2Mi0zLjQ2MDkzNy03LjcyNjU2Mi03LjcyNjU2MnMzLjQ1NzAzMS03LjcyNjU2MiA3LjcyNjU2Mi03LjcyNjU2MmgyNy41NjI1YzQuMjY5NTMxIDAgNy43MjY1NjIgMy40NjA5MzcgNy43MjY1NjIgNy43MjY1NjJzLTMuNDU3MDMxIDcuNzI2NTYyLTcuNzI2NTYyIDcuNzI2NTYyem0wIDAiLz48cGF0aCBkPSJtNDAyLjg0Mzc1IDMwNS40NjA5MzhoLTI3LjU2MjVjLTQuMjY5NTMxIDAtNy43MjY1NjItMy40NjA5MzgtNy43MjY1NjItNy43MjY1NjMgMC00LjI2OTUzMSAzLjQ1NzAzMS03LjcyNjU2MyA3LjcyNjU2Mi03LjcyNjU2M2gyNy41NjI1YzQuMjY5NTMxIDAgNy43MjY1NjIgMy40NTcwMzIgNy43MjY1NjIgNy43MjY1NjMgMCA0LjI2NTYyNS0zLjQ1NzAzMSA3LjcyNjU2My03LjcyNjU2MiA3LjcyNjU2M3ptMCAwIi8+PHBhdGggZD0ibTM5NS42MzI4MTIgMjQyLjgzOTg0NGgtMjAuMzUxNTYyYy00LjI2OTUzMSAwLTcuNzI2NTYyLTMuNDYwOTM4LTcuNzI2NTYyLTcuNzI2NTYzczMuNDU3MDMxLTcuNzI2NTYyIDcuNzI2NTYyLTcuNzI2NTYyaDIwLjM1MTU2MmM0LjI2NTYyNiAwIDcuNzI2NTYzIDMuNDYwOTM3IDcuNzI2NTYzIDcuNzI2NTYycy0zLjQ2MDkzNyA3LjcyNjU2My03LjcyNjU2MyA3LjcyNjU2M3ptMCAwIi8+PC9nPjxwYXRoIGQ9Im0yOTcuOTQ1MzEyIDMzMS45MTQwNjJ2LTIyMi4wNDI5NjhoLTUyLjE4NzV2MjIyLjA0Mjk2OHMzNi4wNzQyMTkgMTYuNzM4MjgyIDM2LjA3NDIxOSA2OS45NzY1NjNjMCAyOS42MDE1NjMtMTcuMzA4NTkzIDU1LjIzNDM3NS00Mi4zMzU5MzcgNjcuMzEyNSA5Ljc5Mjk2OCA0LjcyNjU2MyAyMC43Njk1MzEgNy4zNzUgMzIuMzUxNTYyIDcuMzc1IDQxLjE4MzU5NCAwIDc0LjY5MTQwNi0zMy41MDM5MDYgNzQuNjkxNDA2LTc0LjY4NzUgMC0zMS4yNzM0MzctMTkuNDM3NS01OS4xMTMyODEtNDguNTkzNzUtNjkuOTc2NTYzem0wIDAiIGZpbGw9IiNlNTM5NGIiLz48L3N2Zz4=" />
                  <span class="card-text" style="vertical-align:left"><?= 'Hot Dish'  ?></span>
                <?php } ?>
                <?php if ($model1->temp == "Cold") { ?>
                  <img width="50px;" height="50px" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSItNTUgMCA1MTIgNTEyIiB3aWR0aD0iNTEycHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTMxMC42NDg0MzggMzEzLjYxMzI4MXYtMjQ1Ljc3MzQzN2MwLTMzLjMyNDIxOS0yNy4wMTE3MTktNjAuMzM5ODQ0LTYwLjMzNTkzOC02MC4zMzk4NDRzLTYwLjMzOTg0NCAyNy4wMTU2MjUtNjAuMzM5ODQ0IDYwLjMzOTg0NHYyNDUuNzczNDM3Yy0yNi45OTYwOTQgMTguOTk2MDk0LTQ0LjYzNjcxOCA1MC4zOTA2MjUtNDQuNjM2NzE4IDg1LjkxMDE1NyAwIDU3Ljk3NjU2MiA0NyAxMDQuOTc2NTYyIDEwNC45NzY1NjIgMTA0Ljk3NjU2MnMxMDQuOTc2NTYyLTQ3IDEwNC45NzY1NjItMTA0Ljk3NjU2MmMwLTM1LjUxOTUzMi0xNy42NDQ1MzEtNjYuOTE0MDYzLTQ0LjY0MDYyNC04NS45MTAxNTd6bTAgMCIgZmlsbD0iI2Q4ZDhkOCIvPjxwYXRoIGQ9Im0yNTAuMzA4NTk0IDQ3MC4xMTcxODhjLTM5Ljk3MjY1NiAwLTcyLjUtMzIuNTIzNDM4LTcyLjUtNzIuNSAwLTMwLjM1NTQ2OSAxOC44NjcxODctNTcuMzgyODEzIDQ3LjE3MTg3NS02Ny45Mjk2ODh2LTI2MS44NDc2NTZjMC0xMy45Njg3NSAxMS4zNjMyODEtMjUuMzMyMDMyIDI1LjMyODEyNS0yNS4zMzIwMzIgMTMuOTY4NzUgMCAyNS4zMzIwMzEgMTEuMzYzMjgyIDI1LjMzMjAzMSAyNS4zMzIwMzJ2MjYxLjg0NzY1NmMyOC4zMDQ2ODcgMTAuNTQ2ODc1IDQ3LjE2Nzk2OSAzNy41NzQyMTkgNDcuMTY3OTY5IDY3LjkyOTY4OCAwIDM5Ljk3NjU2Mi0zMi41MTk1MzIgNzIuNS03Mi41IDcyLjV6bTAgMCIgZmlsbD0iI2YzZThkNyIvPjxwYXRoIGQ9Im0yMjQuOTgwNDY5IDI5Ny41OTM3NXYzMi4wOTc2NTZjLTI4LjMwNDY4OCAxMC41NDI5NjktNDcuMTY3OTY5IDM3LjU3MDMxMy00Ny4xNjc5NjkgNjcuOTI1NzgyIDAgMzkuOTc2NTYyIDMyLjUyMzQzOCA3Mi41IDcyLjUgNzIuNXM3Mi41LTMyLjUxOTUzMiA3Mi41LTcyLjVjMC0zMC4zNTU0NjktMTguODY3MTg4LTU3LjM4MjgxMy00Ny4xNzE4NzUtNjcuOTI1Nzgydi0zMi4wOTc2NTZ6bTAgMCIgZmlsbD0iIzY5ZTZlZCIvPjxwYXRoIGQ9Im0yNzUuNjQwNjI1IDMyOS42ODc1di0zMi4wOTM3NWgtNTAuNjYwMTU2djMyLjA5Mzc1czM1LjAxOTUzMSAxNi4yNSAzNS4wMTk1MzEgNjcuOTI5Njg4YzAgMjguNzM0Mzc0LTE2LjgwMDc4MSA1My42MTcxODctNDEuMDkzNzUgNjUuMzM5ODQzIDkuNTA3ODEyIDQuNTg5ODQ0IDIwLjE2MDE1NiA3LjE2MDE1NyAzMS40MDYyNSA3LjE2MDE1NyAzOS45NzY1NjIgMCA3Mi41LTMyLjUyMzQzOCA3Mi41LTcyLjUtLjAwMzkwNi0zMC4zNTU0NjktMTguODY3MTg4LTU3LjM4MjgxMy00Ny4xNzE4NzUtNjcuOTI5Njg4em0wIDAiIGZpbGw9IiMzM2Q4ZGQiLz48cGF0aCBkPSJtMzk0LjIyMjY1NiAxNjcuNDM3NWgtNDMuNTExNzE4Yy00LjE0MDYyNiAwLTcuNSAzLjM1OTM3NS03LjUgNy41czMuMzU5Mzc0IDcuNSA3LjUgNy41aDQzLjUxMTcxOGM0LjE0MDYyNSAwIDcuNS0zLjM1OTM3NSA3LjUtNy41cy0zLjM1OTM3NS03LjUtNy41LTcuNXptMCAwIi8+PHBhdGggZD0ibTM1MC43MTA5MzggMTIxLjY1MjM0NGgxOS43NTM5MDZjNC4xNDQ1MzEgMCA3LjUtMy4zNTkzNzUgNy41LTcuNSAwLTQuMTQ0NTMyLTMuMzU1NDY5LTcuNS03LjUtNy41aC0xOS43NTM5MDZjLTQuMTQwNjI2IDAtNy41IDMuMzU1NDY4LTcuNSA3LjUgMCA0LjE0MDYyNSAzLjM1OTM3NCA3LjUgNy41IDcuNXptMCAwIi8+PHBhdGggZD0ibTM1MC43MTA5MzggNjAuODYzMjgxaDI2Ljc1NzgxMmM0LjE0MDYyNSAwIDcuNS0zLjM1NTQ2OSA3LjUtNy41IDAtNC4xNDA2MjUtMy4zNTkzNzUtNy41LTcuNS03LjVoLTI2Ljc1NzgxMmMtNC4xNDA2MjYgMC03LjUgMy4zNTkzNzUtNy41IDcuNSAwIDQuMTQ0NTMxIDMuMzU5Mzc0IDcuNSA3LjUgNy41em0wIDAiLz48cGF0aCBkPSJtMzc3LjQ2ODc1IDI4OS4wMTE3MTloLTI2Ljc1NzgxMmMtNC4xNDA2MjYgMC03LjUgMy4zNTU0NjktNy41IDcuNSAwIDQuMTQwNjI1IDMuMzU5Mzc0IDcuNSA3LjUgNy41aDI2Ljc1NzgxMmM0LjE0MDYyNSAwIDcuNS0zLjM1OTM3NSA3LjUtNy41IDAtNC4xNDQ1MzEtMy4zNTkzNzUtNy41LTcuNS03LjV6bTAgMCIvPjxwYXRoIGQ9Im0zNTAuNzEwOTM4IDI0My4yMjI2NTZoMTkuNzUzOTA2YzQuMTQ0NTMxIDAgNy41LTMuMzU1NDY4IDcuNS03LjUgMC00LjE0MDYyNS0zLjM1NTQ2OS03LjUtNy41LTcuNWgtMTkuNzUzOTA2Yy00LjE0MDYyNiAwLTcuNSAzLjM1OTM3NS03LjUgNy41IDAgNC4xNDQ1MzIgMy4zNTkzNzQgNy41IDcuNSA3LjV6bTAgMCIvPjxwYXRoIGQ9Im0xMjcuMTA5Mzc1IDE2Mi44MDg1OTRjMTIuNDA2MjUgNi42MjUgMTMuMTUyMzQ0IDguMTI1IDE2LjQ1MzEyNSA4LjEyNSA3LjcxODc1IDAgMTAuMzc4OTA2LTEwLjI4OTA2MyAzLjY3MTg3NS0xNC4wNDY4NzVsLTEyLjgwMDc4MS03LjE2NDA2MyA5LjQxNDA2Mi0zLjg1NTQ2OGMzLjgzMjAzMi0xLjU3MDMxMyA1LjY2Nzk2OS01Ljk1MzEyNiA0LjA5NzY1Ni05Ljc4NTE1Ny0xLjU3MDMxMi0zLjgzMjAzMS01Ljk0OTIxOC01LjY2NDA2Mi05Ljc4MTI1LTQuMDk3NjU2bC0yMC40NDkyMTggOC4zNzUtMjYuODI4MTI1LTE1LjAyMzQzNyAyNi44MjgxMjUtMTUuMDIzNDM4YzIxLjAyNzM0NCA4LjQxNDA2MiAyMC43MDcwMzEgOC45Mzc1IDIzLjI4OTA2MiA4LjkzNzUgOC4xOTE0MDYgMCAxMC40MjU3ODItMTEuMzM1OTM4IDIuODQzNzUtMTQuNDQxNDA2bC05LjQxMDE1Ni0zLjg1NTQ2OSAxMi43OTY4NzUtNy4xNjc5NjljMy42MTMyODEtMi4wMTk1MzEgNC45MDYyNS02LjU5Mzc1IDIuODgyODEzLTEwLjIwNzAzMS0yLjAyMzQzOC0zLjYxMzI4MS02LjU5Mzc1LTQuOTAyMzQ0LTEwLjIxMDkzOC0yLjg3ODkwNmwtMTIuNzk2ODc1IDcuMTY0MDYyIDEuNjMyODEzLTEwLjAzOTA2MmMuNjY0MDYyLTQuMDg1OTM4LTIuMTEzMjgyLTcuOTQxNDA3LTYuMjAzMTI2LTguNjA1NDY5LTQuMDgyMDMxLS42NjQwNjItNy45NDE0MDYgMi4xMDkzNzUtOC42MDU0NjggNi4xOTkyMTlsLTMuNTQyOTY5IDIxLjgwODU5My0yNy4zNTU0NjkgMTUuMzE2NDA3di0zMS4zNTE1NjNsMTcuMjk2ODc1LTEzLjc0NjA5NGMzLjI0MjE4OC0yLjU3ODEyNCAzLjc4MTI1LTcuMjkyOTY4IDEuMjA3MDMxLTEwLjUzOTA2Mi0yLjU3ODEyNC0zLjI0MjE4OC03LjI5Njg3NC0zLjc4MTI1LTEwLjUzOTA2Mi0xLjIwMzEyNWwtNy45NjQ4NDQgNi4zMjgxMjV2LTE0LjY2Nzk2OWMwLTQuMTQwNjI1LTMuMzU1NDY4LTcuNS03LjUtNy41LTQuMTQwNjI1IDAtNy41IDMuMzU5Mzc1LTcuNSA3LjV2MTQuNjY3OTY5bC03Ljk2MDkzNy02LjMyODEyNWMtMy4yNDIxODgtMi41NzgxMjUtNy45NjA5MzgtMi4wMzkwNjMtMTAuNTM5MDYzIDEuMjA3MDMxLTIuNTc4MTI1IDMuMjQyMTg4LTIuMDM5MDYyIDcuOTU3MDMyIDEuMjA3MDMyIDEwLjUzNTE1NmwxNy4yOTI5NjggMTMuNzV2MzEuMzQ3NjU3bC0yNy4zNTE1NjItMTUuMzE2NDA3LTMuNTQ2ODc1LTIxLjgwODU5M2MtLjY2NDA2My00LjA4OTg0NC00LjUxNTYyNS02Ljg2MzI4MS04LjYwNTQ2OS02LjE5OTIxOS00LjA4NTkzOC42NjQwNjItNi44NjMyODEgNC41MTk1MzEtNi4xOTkyMTkgOC42MDU0NjlsMS42MzI4MTMgMTAuMDM5MDYyLTEyLjgwMDc4Mi03LjE2NDA2MmMtMy42MTMyODEtMi4wMjM0MzgtOC4xODM1OTMtLjczNDM3NS0xMC4yMDcwMzEgMi44Nzg5MDYtMi4wMjM0MzcgMy42MTMyODEtLjczNDM3NSA4LjE4NzUgMi44Nzg5MDcgMTAuMjA3MDMxbDEyLjgwMDc4MSA3LjE2Nzk2OS05LjQxNDA2MyAzLjg1NTQ2OWMtMy44MzIwMzEgMS41NzAzMTItNS42NjQwNjIgNS45NDkyMTgtNC4wOTc2NTYgOS43ODUxNTYgMS41NzQyMTkgMy44MzU5MzggNS45NTcwMzEgNS42NjQwNjIgOS43ODUxNTYgNC4wOTc2NTZsMjAuNDQ1MzEzLTguMzc1IDI2LjgyODEyNSAxNS4wMjM0MzgtMjYuODI4MTI1IDE1LjAxOTUzMS0yMC40NDUzMTMtOC4zNzVjLTMuODM1OTM3LTEuNTY2NDA2LTguMjE0ODQ0LjI2NTYyNS05Ljc4NTE1NiA0LjEwMTU2My0xLjU3MDMxMiAzLjgzMjAzMS4yNjU2MjUgOC4yMTA5MzcgNC4wOTc2NTYgOS43ODEyNWw5LjQxNDA2MyAzLjg1NTQ2OC0xMi44MDA3ODEgNy4xNjc5NjljLTYuNzA3MDMyIDMuNzUzOTA2LTQuMDQyOTY5IDE0LjA0Mjk2OSAzLjY3MTg3NCAxNC4wNDI5NjkgMy4zMDA3ODIgMCA0LjA1NDY4OC0xLjUwMzkwNiAxNi40NTcwMzItOC4xMjVsLTEuNjMyODEzIDEwLjA0Mjk2OGMtLjc0MjE4NyA0LjU2MjUgMi43ODEyNSA4LjcwMzEyNiA3LjQxNDA2MyA4LjcwMzEyNiAzLjYwOTM3NSAwIDYuNzkyOTY4LTIuNjE3MTg4IDcuMzkwNjI1LTYuMjk2ODc2bDMuNTQ2ODc1LTIxLjgwODU5MyAyNy4zNTE1NjItMTUuMzE2NDA3djMxLjM0NzY1N2wtMTcuMjkyOTY4IDEzLjc1Yy0zLjI0NjA5NCAyLjU3NDIxOS0zLjc4NTE1NyA3LjI5Mjk2OS0xLjIwNzAzMiAxMC41MzUxNTYgMi41NzgxMjUgMy4yNDYwOTQgNy4yOTY4NzUgMy43ODUxNTYgMTAuNTM5MDYzIDEuMjA3MDMxbDcuOTYwOTM3LTYuMzI4MTI1djE0LjY2Nzk2OWMwIDQuMTQwNjI1IDMuMzU5Mzc1IDcuNSA3LjUgNy41IDQuMTQ0NTMyIDAgNy41LTMuMzU5Mzc1IDcuNS03LjV2LTE0LjY2Nzk2OWM2LjkyNTc4MiA1LjAxNTYyNSA4LjQxNzk2OSA3Ljk1NzAzMSAxMi42MjUgNy45NTcwMzEgNy4wNzAzMTMtLjAwMzkwNiAxMC4yMzA0NjktOC45NTcwMzEgNC42NzE4NzUtMTMuMzcxMDkzbC0xNy4yOTY4NzUtMTMuNzV2LTMxLjM0NzY1N2wyNy4zNTU0NjkgMTUuMzE2NDA3IDMuNTQyOTY5IDIxLjgwODU5M2MuNTk3NjU2IDMuNjc5Njg4IDMuNzgxMjUgNi4yOTY4NzYgNy4zOTQ1MzEgNi4yOTY4NzYgNC42NDA2MjUgMCA4LjE1MjM0NC00LjE1MjM0NCA3LjQxNDA2My04LjcwMzEyNnptMCAwIi8+PHBhdGggZD0ibTMxOC4xNDg0MzggMzA5LjgwNDY4OHYtMjQxLjk2NDg0NGMwLTM3LjQwNjI1LTMwLjQyOTY4OC02Ny44Mzk4NDQtNjcuODM1OTM4LTY3LjgzOTg0NHMtNjcuODM5ODQ0IDMwLjQzMzU5NC02Ny44Mzk4NDQgNjcuODM5ODQ0djI0MS45NjQ4NDRjLTI4LjAyMzQzNyAyMS4yMjY1NjItNDQuNjM2NzE4IDU0LjQ2ODc1LTQ0LjYzNjcxOCA4OS43MTg3NSAwIDYyLjAxOTUzMSA1MC40NTcwMzEgMTEyLjQ3NjU2MiAxMTIuNDc2NTYyIDExMi40NzY1NjJzMTEyLjQ3NjU2Mi01MC40NTcwMzEgMTEyLjQ3NjU2Mi0xMTIuNDc2NTYyYzAtMzUuMjUtMTYuNjEzMjgxLTY4LjQ5MjE4OC00NC42NDA2MjQtODkuNzE4NzV6bS02Ny44MzU5MzggMTg3LjE5NTMxMmMtNTMuNzUgMC05Ny40NzY1NjItNDMuNzI2NTYyLTk3LjQ3NjU2Mi05Ny40NzY1NjIgMC0zMS42ODc1IDE1LjQ5NjA5My02MS41MTE3MTkgNDEuNDUzMTI0LTc5Ljc3MzQzOCAxLjk5NjA5NC0xLjQwNjI1IDMuMTgzNTk0LTMuNjk1MzEyIDMuMTgzNTk0LTYuMTM2NzE5di0yNDUuNzczNDM3YzAtMjkuMTM2NzE5IDIzLjcwMzEyNS01Mi44Mzk4NDQgNTIuODM5ODQ0LTUyLjgzOTg0NCAyOS4xMzI4MTIgMCA1Mi44MzU5MzggMjMuNzAzMTI1IDUyLjgzNTkzOCA1Mi44Mzk4NDR2MjQ1Ljc3MzQzN2MwIDIuNDQxNDA3IDEuMTg3NSA0LjczMDQ2OSAzLjE4MzU5MyA2LjEzNjcxOSAyNS45NjA5MzggMTguMjY1NjI1IDQxLjQ1NzAzMSA0OC4wODU5MzggNDEuNDU3MDMxIDc5Ljc3MzQzOCAwIDUzLjc1LTQzLjczMDQ2OCA5Ny40NzY1NjItOTcuNDc2NTYyIDk3LjQ3NjU2MnptMCAwIi8+PHBhdGggZD0ibTI4My4xNDA2MjUgMzI0LjY2Nzk2OXYtMjU2LjgyODEyNWMwLTE4LjEwNTQ2OS0xNC43MjY1NjMtMzIuODMyMDMyLTMyLjgyODEyNS0zMi44MzIwMzJzLTMyLjgzMjAzMSAxNC43MjY1NjMtMzIuODMyMDMxIDMyLjgzMjAzMnYyMy4yMjI2NTZjMCA0LjE0MDYyNSAzLjM1OTM3NSA3LjUgNy41IDcuNSA0LjE0NDUzMSAwIDcuNS0zLjM1OTM3NSA3LjUtNy41di0yMy4yMjI2NTZjMC05LjgzMjAzMiA4LTE3LjgzMjAzMiAxNy44MzIwMzEtMTcuODMyMDMyczE3LjgyODEyNSA4IDE3LjgyODEyNSAxNy44MzIwMzJ2MjIyLjI1MzkwNmgtMzUuNjYwMTU2di0xNjguOTYwOTM4YzAtNC4xNDQ1MzEtMy4zNTU0NjktNy41LTcuNS03LjUtNC4xNDA2MjUgMC03LjUgMy4zNTU0NjktNy41IDcuNXYyMDMuNTM1MTU3Yy0yOC40MTc5NjkgMTIuODA4NTkzLTQ3LjE2Nzk2OSA0MS40ODQzNzUtNDcuMTY3OTY5IDcyLjk0OTIxOSAwIDQ0LjExMzI4MSAzNS44ODY3MTkgODAgNzkuOTk2MDk0IDgwIDQ0LjExMzI4MSAwIDgwLTM1Ljg4NjcxOSA4MC04MCAuMDAzOTA2LTMxLjQ2NDg0NC0xOC43NS02MC4xNDA2MjYtNDcuMTY3OTY5LTcyLjk0OTIxOXptLTMyLjgyODEyNSAxMzcuOTQ5MjE5Yy0zNS44NDM3NSAwLTY1LTI5LjE1NjI1LTY1LTY1IDAtMjcgMTYuOTkyMTg4LTUxLjQ3NjU2MyA0Mi4yODkwNjItNjAuODk4NDM4IDIuOTMzNTk0LTEuMDkzNzUgNC44ODI4MTMtMy44OTg0MzggNC44ODI4MTMtNy4wMjczNDR2LTI0LjU5NzY1NmgzNS42NTYyNXYyNC41OTc2NTZjMCAzLjEyODkwNiAxLjk0OTIxOSA1LjkzMzU5NCA0Ljg4MjgxMyA3LjAyNzM0NCAyNS4yOTY4NzQgOS40MjE4NzUgNDIuMjg5MDYyIDMzLjg5NDUzMSA0Mi4yODkwNjIgNjAuODk4NDM4IDAgMzUuODQzNzUtMjkuMTYwMTU2IDY1LTY1IDY1em0wIDAiLz48L3N2Zz4=" />
                  <span class="card-text" style="vertical-align:left;"><?= 'Cold Dish'  ?><span>
                    <?php } ?>
                  <?php } ?>



                <?php endif ?>
                <!--Affichage detail of product if fulfy a condition of partner_category == 6-->
                <?php if ($model1->partner_category == 6) : ?>
                  <?php
                  $temp = json_decode($model1->temp, true);
                  $name = json_decode($model1->name, true);
                  ?>

                  <p class=" card-text"><?= '<b>Number of agent</b><b class="triangle-right"></b>' . $model1->number_of_agent ?></p>
                  <p class="card-text"><?= '<b>Duration</b><b class="triangle-right"></b>' . $model1->periode . 'hour' ?></p>
                  <p class="card-text"><?= '<b>Type of event</b><b class="triangle-right"></b>' . $name[0] ?></p>
                  <p class="card-text"><?= '<b>Position held </b><b class="triangle-right"></b>' . $temp[0] ?></p>

                <?php endif ?>
                <!--Affichage detail of product if fulfy a condition of partner_category == 7-->
                <?php if ($model1->partner_category == 7) : ?>
                  <p class="card-text"><?= '<b>Number of host/hostess</b><b class="triangle-right"></b>' . $model1->number_of_agent ?></p>
                  <p class="card-text"><?= '<b>Duration</b><b class="triangle-right"></b>' . $model1->periode . 'hour' ?></p>
                <?php endif ?>
                <?php if ($model1->partner_category != 3) : ?>
                  <p class="card-text"><?= '<b>Partner name</b><span class="triangle-right"></span><span>' . $detail[1]->name ?>
                    </span></p>
                  <?php endif ?>

          </div>

          <div class="col-sm-2 float-left">
            <!-- a way to get old data but to investigate about the oldattributes for now-->


            <?php 
            //set session
            $minPrice=$model1->min_price;
            $peopleMin=($minPrice*$model1->people_number)/$model1->price;
            $peopleMin=$peopleMin;
            $_SESSION['peopleMin']=$peopleMin;
            
            ?>
            <p class="card-text"><?= '<h5 style="font-size:24px"><b>' . 
            $totalPrice. ' ' . $model1->currencies_symbol  .  '</b></h5>' ?></p>
            <p class="card-text" style="text-decoration:underline">
              Tax included</p>
            <a class="btn  shadow  bg-purple" href="<?= Url::to(['site/detail', 'amount' => $model1->price, 'product_id' => $model1->product_id, 'id' => $model1->id, 'deliveryPrice' => $deliveryPrice]) ?>"><span style="color:cornsilk">Detail</span></a>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="cold-sm-12">&#8199 </div>
<?php

}
?>