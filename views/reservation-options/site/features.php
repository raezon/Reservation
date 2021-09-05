<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\ActiveForm;

$this->title = 'ClicangoEvent';
?>

  <div class="container">  
      
      <section class="pt-5 pb-5 bg-white position-relative" style="min-height:100vh;">
          
        <div class="layer-wrapper laya-vr layer-1">
          
        <!-- background svg -->
        <svg  id="animLayer1" class="scene" width="1200" height="1200" preserveAspectRatio="xMinYMid slice" viewBox="0 0 1200 1200" data-aos="fade-left" data-aos-delay="100">
                    <defs>
                        <linearGradient id="gradient-1" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop stop-color="#f19872"></stop>
                                <stop offset="1" stop-color="#e86c9a"></stop>
                        </linearGradient>
                        <linearGradient id="gradient-2" x1="0%" y1="0%" x2="100%" y2="100%">
                                <!-- dark -->
                                <!--<stop stop-color="#423f6f"></stop>-->
                                <!-- light -->
                                <stop stop-color="#59548f"></stop>
                                <stop offset="1" stop-color="#776bb0"></stop>
                                
<!--                                <stop stop-color="#91552e"></stop>
                                <stop offset="1" stop-color="#db9eb4"></stop>-->
                                
                        </linearGradient>
                        <linearGradient id="gradient-3" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop stop-color="#ee2d29"></stop>
                                <stop offset="1" stop-color="#f8ae2c"></stop>
                        </linearGradient>
                        <linearGradient id="gradient-4" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop stop-color="#3a3d98"></stop>
                                <stop offset="1" stop-color="#6f22b9"></stop>
                        </linearGradient>
                        <linearGradient id="gradient-5" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop stop-color="#9d316e"></stop>
                                <stop offset="1" stop-color="#de2d3e"></stop>
                        </linearGradient>
                        <linearGradient id="gradient-6" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop stop-color="#00ac53"></stop>
                                <stop offset="1" stop-color="#23c3e0"></stop>
                        </linearGradient>
                    </defs>
                  <g class="blob-2">
                        <path  fill="url(#gradient-2)" d="M 392.8,547.7 C 427.8,592.2 497.3,600.5 536.4,565.8 561.4,545.7 595.7,539.8 618,516 635.7,498.1 638.6,470.8 637.7,445.6 636.8,425 636.9,404.2 640.7,384.2 645.7,352.9 651.8,320.4 642.8,288.1 629.8,234.1 578.5,188 524,187.1 490.6,186 460.7,202.9 437.5,224.4 411.5,245.9 384.3,266.1 355.4,283.4 329.4,301.4 305.1,326.1 299.7,359.5 294.8,392.4 309.6,425.9 328.3,453.7 348.9,485.7 371.1,516.5 392.8,547.7 Z" pathdata:id="M -907.7,1516 C -413.5,1881 567.9,1950 1120,1664 1473,1499 1957,1451 2272,1255 2522,1108 2563,884.2 2550,677.2 2538,508 2539,337.1 2593,172.8 2663,-84.28 2749,-351.2 2622,-616.5 2439,-1060 1714,-1439 944.9,-1446 473.3,-1455 51.08,-1316 -276.5,-1140 -643.6,-963.2 -1028,-797.3 -1436,-655.2 -1803,-507.3 -2146,-304.4 -2222,-30.07 -2291,240.2 -2082,515.3 -1818,743.7 -1528,1007 -1214,1260 -907.7,1516 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path  fill="url(#gradient-2)" d="M 340.9,428.6 C 353.4,444.4 366.9,459.6 379.5,475.4 403.4,504.3 427.7,533.6 456.8,557.3 489.9,575 531.5,568.6 556.1,543.8 577.6,531.8 603,522 614.9,498.7 630.2,460.2 616.4,415 630.3,376.1 638.9,344.4 645.6,309 632.7,275.9 618.1,227.4 561.8,193.1 515.5,207.3 484.3,217.6 466.6,247.4 441,265.8 407,291.9 363.4,305.4 336.1,339.9 317.5,364.6 321.9,402.7 340.9,428.6 Z" pathdata:id="M -1640,537.5 C -1464,667.3 -1273,792.2 -1095,921.9 -758,1159 -414.9,1400 -3.984,1595 463.4,1740 1051,1687 1398,1484 1702,1385 2060,1305 2228,1113 2444,797.1 2250,425.8 2446,106.3 2567,-154.1 2662,-444.9 2480,-716.8 2274,-1115 1479,-1397 824.9,-1280 384.3,-1196 134.4,-950.9 -227.1,-799.7 -707.2,-585.3 -1323,-474.4 -1708,-191.1 -1971,11.82 -1909,324.8 -1640,537.5 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path  fill="url(#gradient-2)" d="M 364,422.9 C 394.4,463.7 427.7,505 472.9,529.1 501.3,545.1 534.9,541.5 562.1,529.8 580.3,523.3 600.7,514.7 608,495.2 616.7,457.8 605,416.3 619.9,380.5 630.8,351 639.4,318.4 631.4,285.6 625.5,259.5 608.2,233.9 582.7,223.9 556.1,212.3 523.9,216.4 504.6,236.5 471.3,263.8 439.6,294.5 399.5,312 377.2,324.8 354.4,341.5 346.9,367.9 343.9,387.1 352.3,407.1 364,422.9 Z" pathdata:id="M -1314,490.7 C -885.1,825.8 -414.9,1165 223.3,1363 624.4,1494 1099,1465 1483,1369 1740,1315 2028,1245 2131,1085 2254,777.4 2089,436.5 2299,142.4 2453,-99.89 2574,-367.7 2461,-637.1 2378,-851.5 2134,-1062 1774,-1144 1398,-1239 943.5,-1205 671,-1040 200.8,-816.1 -246.8,-564 -813.1,-420.2 -1128,-315.1 -1450,-177.9 -1556,38.93 -1598,196.6 -1480,360.9 -1314,490.7 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path fill="url(#gradient-2)" d="M 408.3,450.5 C 435.7,490.6 480.5,521.6 527.9,523.4 552.1,523.7 578.3,513.4 587.8,489.9 598.4,457.4 588.6,419.1 605.1,388.6 617,358.2 631.3,326.4 626.7,291.7 625.4,265.1 603.9,241.4 579.2,233.5 562.9,227.8 545.2,230.5 531.6,239.3 489.8,262.6 459.6,301.6 417.1,323.9 399.2,335.6 380.7,351.8 378.5,375.4 377.1,402.8 393.4,428 408.3,450.5 Z" pathdata:id="M -688.8,717.4 C -301.9,1047 330.7,1301 999.9,1316 1342,1319 1712,1234 1846,1041 1995,774.1 1857,459.5 2090,209 2258,-40.75 2460,-302 2395,-587 2377,-805.5 2073,-1000 1724,-1065 1494,-1112 1244,-1090 1052,-1017 462,-826 35.55,-505.7 -564.5,-322.5 -817.3,-226.4 -1079,-93.31 -1110,100.5 -1129,325.6 -899.2,532.6 -688.8,717.4 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path  fill="url(#gradient-2)" d="M 434.2,460.1 C 459.4,497.5 508.6,519.5 549.5,506.1 573.6,496.7 585.5,469.4 584.7,443.4 590.7,393.5 619.2,350 618.4,298.4 617.7,273.1 595.7,246.3 569.9,246.9 540.6,247.7 517.9,267.6 498.5,286.7 467.6,315.7 432.8,343.2 415.3,383.7 408.6,409.5 417.9,438.3 434.2,460.1 Z" pathdata:id="M -323.1,796.3 C 32.73,1103 727.4,1284 1305,1174 1645,1097 1813,872.7 1802,659.1 1887,249.2 2289,-108.1 2278,-531.9 2268,-739.8 1957,-959.9 1593,-955 1179,-948.4 858.7,-784.9 584.8,-628 148.5,-389.8 -342.9,-164 -590,168.7 -684.6,380.6 -553.3,617.2 -323.1,796.3 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path  fill="url(#gradient-2)" d="M 446,458.6 C 471.3,494.2 524.6,510.3 557.7,485.8 573.8,473.9 571.9,450.1 574.8,431.1 579.9,397.6 598.7,369.4 605.6,336.4 609.8,316.6 613,294.3 604.6,274.5 597.6,258 576.8,251.3 560.8,256.8 530.7,267.1 508.3,289.4 485.9,310.3 460.7,333.8 435.9,361.7 429.7,397.7 426.2,418.5 433.3,440.8 446,458.6 Z" pathdata:id="M -156.5,783.9 C 200.8,1076 953.4,1209 1421,1007 1648,909.6 1621,714.1 1662,558.1 1734,282.9 2000,51.25 2097,-219.8 2156,-382.4 2202,-565.6 2083,-728.3 1984,-863.8 1690,-918.8 1464,-873.6 1039,-789 723.2,-605.9 406.9,-434.2 51.08,-241.2 -299.1,-12 -386.6,283.7 -436.1,454.6 -335.8,637.7 -156.5,783.9 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                        <path fill="url(#gradient-2)" d="M 451.9,456.5 C 474.7,489.7 523.3,505.1 554.4,482.8 566.2,474.4 563.5,457 562.3,443.4 557.8,394.7 589.2,351.4 580.7,303.2 578.3,289.3 558.1,289.3 547.2,293.4 503.5,310 466,342.4 444.9,384.3 434,406 437,434.8 451.9,456.5 Z" pathdata:id="M -73.17,766.7 C 248.8,1039 935,1166 1374,982.7 1541,913.7 1503,770.8 1486,659.1 1422,259.1 1866,-96.6 1745,-492.5 1712,-606.7 1426,-606.7 1272,-573 655.4,-436.7 125.9,-170.5 -172,173.6 -325.9,351.9 -283.6,588.4 -73.17,766.7 Z" style="transform-origin: 473.081px 185.66px; opacity: 1; transform: scale(2.5);"></path>
                  </g>
                    </svg>
        
        </div>
        <div class="container-fluid pt-5 pb-5 position-relative">
          <div class="row d-flex justify-content-between  align-items-center">
            <div class="col-md-5 offset-md-1 text-center text-lg-left mb-5 mb-lg-0 order-2 order-md-1">
              <h1 class="display-4   mt-5 mt-md-2"><span  class="d-block w-100" data-aos="fade-left" data-aos-delay="1000">Simplest Way</span> <span  class="d-block w-100" data-aos="fade-right" data-aos-delay="1200">to your Events!</span></h1>
              <div class="my-4" data-aos="fade-up" data-aos-delay="1200">
                <p class="lead">On fournir à nos partenaires le maximum de clients potentiels sérieux</p>
              </div>
              <!-- stars ratings -->
              <?php /* div class="d-flex justify-content-center justify-content-lg-start" >
                <div class="d-flex mr-2">
                  <i class="fas fa-star   text-warning m-1" data-aos="zoom-in" data-aos-delay="2000"></i>
                  <i class="fas fa-star   text-warning m-1" data-aos="zoom-in" data-aos-delay="2050"></i>
                  <i class="fas fa-star   text-warning m-1" data-aos="zoom-in" data-aos-delay="2100"></i>
                  <i class="fas fa-star   text-warning m-1" data-aos="zoom-in" data-aos-delay="2150"></i>
                  <i class="fas fa-star   text-muted m-1" data-aos="zoom-in" data-aos-delay="2200"></i>
                </div>
                <span class=" " data-aos="fade-right" data-aos-delay="1900">(Average score: 4.9/5)</span>
              </div */?>
              
              <div class="row d-flex justify-content-between  align-items-center mt-2">
                <div class="col-md-6">
                      <a href="<?= Url::to(['site/about']) ?>" class="btn btn-primary shadow-sm btn-block btn-lg ml-md-3 ml-md-auto mt-5" data-aos="fade-left" data-aos-delay="1500">Learn more...</a>
                </div>
                <div class="col-md-6">
                    <a href="<?= Url::to(['user/registration/register']) ?>" class="btn btn-outline-primary  btn-block shadow-sm btn-lg ml-md-3 ml-md-auto mt-md-5 mt-3" data-aos="fade-right" data-aos-delay="1500">SIGN UP</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 order-1 order-md-2">
              <div class="layer-img-wrapper laya-vr layer-2 ">
                <?= Html::img('@web/img/logo-lg.png', ["alt"=>"", "class"=>" img-fluid d-block my-auto", "data-aos"=>"zoom-in", "data-aos-delay"=>"300"]); ?>
              </div>
            </div>
          </div>
        </div>

      </section>
      
      <!-- the future is now -->
      <?php /*section class="pt-5 pb-5 " style="">
        <div class="container  pt-5 pb-5 mt-5 mb-5 ">
          <div class="row d-flex justify-content-between">
            <div class="col-md-5 order-2 order-md-1 mt-md-0 mt-5 pt-5 pt-md-1" >
              <div class="svg-wrapper" data-aos="fade-in" data-aos-delay="500" >
                  <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                    <linearGradient id="MyGradient2">
                      <stop stop-color="#0947db"></stop>
                      <stop offset="1" stop-color="#07d89d"></stop>
                    </linearGradient>

                      <g transform="translate(300,300)">
                        <path d="M95.3,-122.5C128.2,-107.2,163,-85.7,190.9,-50.2C218.7,-14.6,239.7,35,227.9,74.9C216,114.7,171.5,144.7,128.1,160.4C84.6,176.2,42.3,177.6,-7.9,188.5C-58.2,199.4,-116.4,219.9,-141.9,198.3C-167.4,176.8,-160.3,113.3,-158.4,64.4C-156.6,15.5,-160.1,-18.9,-160.9,-63.4C-161.8,-108,-159.9,-162.8,-132.7,-179.9C-105.4,-197.1,-52.7,-176.5,-10.8,-161.7C31.2,-146.9,62.3,-137.8,95.3,-122.5Z" fill="url(#MyGradient2)"></path>
                      </g>
                    </svg>
                </div>
                <div class="slider-testimonials-1 position-relative card  " data-aos="fade-left" data-aos-delay="300">
                  <div class="slik-item">
                    <div class="container-fluid">
                      <div class="row   justify-content-center d-flex  ">
                        <div class="col-md-12    px-5 text-dark py-5">
                          <div class="d-flex justify-content-center justify-content-lg-start">
                            <div class="d-flex mr-2">
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                            </div>
                          </div>
                          <blockquote class="blockquote blockquote-reverse mt-4">
                            <p class="lead  mt-2">"Good design is like a refrigerator—when it works, no one notices, but when it doesn’t, it sure stinks."</p>
                            <div class="mt-3 d-flex align-items-center pt-2">
                              <div class="mr-3">
                                <img class="d-block img-fluid rounded-circle" src="https://via.placeholder.com/40x40/5fa9f8/ffffff " srcset="https://via.placeholder.com/120x120/5fa9f8/ffffff 2x" alt="user">
                              </div>
                              <div class="d-block">
                                <p class="mb-0">–Irene Au</p>
                                <p class="small">Designer</p>
                              </div>
                            </div>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="slik-item">
                    <div class="container-fluid">
                      <div class="row   justify-content-center d-flex  ">
                        <div class="col-md-12    px-5 text-dark py-5">
                          <div class="d-flex justify-content-center justify-content-lg-start">
                            <div class="d-flex mr-2">
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                            </div>
                          </div>
                          <blockquote class="blockquote blockquote-reverse mt-4">
                            <p class="lead  mt-2">"Digital design is like painting, except the paint never dries."</p>
                            <div class="mt-3 d-flex align-items-center pt-2">
                              <div class="mr-3">
                                <img class="d-block img-fluid rounded-circle" src="https://via.placeholder.com/40x40/5fa9f8/ffffff " srcset="https://via.placeholder.com/120x120/5fa9f8/ffffff 2x" alt="user">
                              </div>
                              <div class="d-block">
                                <p class="mb-0">-Neville Brody</p>
                                <p class="small">Designer</p>
                              </div>
                            </div>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="slik-item">
                    <div class="container-fluid">
                      <div class="row   justify-content-center d-flex  ">
                        <div class="col-md-12    px-5 text-dark py-5">
                          <div class="d-flex justify-content-center justify-content-lg-start">
                            <div class="d-flex mr-2">
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                              <i class="fas fa-star text-warning mr-1"></i>
                            </div>
                          </div>
                          <blockquote class="blockquote blockquote-reverse mt-4">
                            <p class="lead  mt-2">"The alternative to good design is always bad design. There is no such thing as no design."</p>
                            <div class="mt-3 d-flex align-items-center pt-2">
                              <div class="mr-3">
                                <img class="d-block img-fluid rounded-circle" src="https://via.placeholder.com/40x40/5fa9f8/ffffff " srcset="https://via.placeholder.com/120x120/5fa9f8/ffffff 2x" alt="user">
                              </div>
                              <div class="d-block">
                                <p class="mb-0"> –Adam Judge</p>
                                <p class="small">Designer</p>
                              </div>
                            </div>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- slider dots navigation -->
                  <div class="slider-nav"></div>
            </div>
            <div class="col-md-6 order-1 order-md-2">
              <h3 class=" display-4 " ><span  class="d-block w-100" data-aos="fade-left" data-aos-delay="500">The Future</span> <span  class="d-block w-100" data-aos="fade-right" data-aos-delay="550">is Now</span></h3>
              <p class="lead mt-4" data-aos="fade-up" data-aos-delay="300">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
              <div class="row row-grid">
                <div class="col-3 my-1 mt-5" data-aos="zoom-in" data-aos-delay="500">
                    <?= Html::img('@web/img/logos/nike.svg',[ "alt"=>"image", "class"=>"img-fluid logo"]); ?>
                </div>
                <div class="col-3 my-1 mt-5" data-aos="fade-right" data-aos-delay="700">
                  <?= Html::img('@web/img/logos/disney.svg',[ "alt"=>"image", "class"=>"img-fluid logo"]); ?>
                </div>
                <div class="col-3 my-1 mt-5" data-aos="fade-right" data-aos-delay="900">
                  <?= Html::img('@web/img/logos/uber.svg',[ "alt"=>"image", "class"=>"img-fluid"]); ?>
                </div>

              </div>
            </div>

          </div>
        </div>
      </section */?>
      
      <!-- Your run your business -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
            
          <div class="row d-flex mb-md-5 mb-3 justify-content-center">
            <div class="col-md-9 mb-5 ">
                
              
              <h3 class="mb-4 text-center display-4" data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">Clicango Event</h3>
              
              <p class="mb-0 mt-5  text-uppercase text-primary text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="350">Qui sommes-nous ?</p>
              
              <p class="text-h3 text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
                <strong>Clicango Event</strong> est une startup événementielle française à grand potentiel.
              </p>
              
              <p class="text-h3 text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
                  Innovante et investie, elle est le site web et l’application N°1 qui regroupe toutes les prestations des partenaires professionnels nécessaires à la bonne organisation d’un événement.
              </p>
              <p class="text-h3 text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200"> N°1 qui regroupe toutes les prestations des partenaires professionnels nécessaires à la bonne organisation d’un événement
                <a href="<?= Url::to(['/user/registration/register']) ?>"> INSCRIVEZ VOUS</a>
              </p>
              <p class="text-h3 text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Permettre à des organisateurs d’événements de réserver rapidement et sans stress en un seul clique le service qui manque à leurs événements auprès de professionnels certifiés ou de particuliers vérifiés
              </p>
              <p class="text-h3 text-center" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Fournir à ses partenaires le maximum de clients potentiels sérieux.
              </p>

            </div>
          </div>
            
          <!-- Advantages row 1 -->
          <div class="row text-center">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M95.3,-122.5C128.2,-107.2,163,-85.7,190.9,-50.2C218.7,-14.6,239.7,35,227.9,74.9C216,114.7,171.5,144.7,128.1,160.4C84.6,176.2,42.3,177.6,-7.9,188.5C-58.2,199.4,-116.4,219.9,-141.9,198.3C-167.4,176.8,-160.3,113.3,-158.4,64.4C-156.6,15.5,-160.1,-18.9,-160.9,-63.4C-161.8,-108,-159.9,-162.8,-132.7,-179.9C-105.4,-197.1,-52.7,-176.5,-10.8,-161.7C31.2,-146.9,62.3,-137.8,95.3,-122.5Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class=" text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">
                  <?= Html::img('@web/img/icons/visible.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
              <h4 class="display-5 pt-5 pb-3"  data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">Visibilité</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">Une visibilité qui donne accès à la promotion de leu rétablissement, sur des moteurs de recherche comme «Google».</p>

            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M123.1,-148.2C166.1,-110.7,212.1,-78.1,228.6,-33.1C245,11.8,232.1,69.2,197.7,100.6C163.4,131.9,107.7,137.4,57.1,155C6.5,172.6,-39,202.3,-86.8,201.1C-134.6,199.9,-184.6,167.7,-197.1,124.3C-209.6,81,-184.6,26.4,-164.4,-18.8C-144.3,-64,-129,-99.8,-102.4,-140.2C-75.8,-180.7,-37.9,-225.9,1.1,-227.1C40.1,-228.4,80.1,-185.8,123.1,-148.2Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class="display-4 text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
                  <?= Html::img('@web/img/icons/fast.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
                <h4 class="display-5 pt-5 pb-3"   data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Paiement immédiat<br> et sécurisé</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Un piement immédiat et sécurisé. </p>

            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M72,-86.4C97.8,-64.2,126.2,-45.8,155.1,-8.6C183.9,28.5,213.2,84.2,195.6,111.2C178,138.1,113.4,136.3,58.3,153.5C3.1,170.7,-42.8,207,-69.4,195.3C-96,183.6,-103.4,123.8,-128.1,76.3C-152.7,28.8,-194.5,-6.5,-196.1,-41C-197.6,-75.5,-158.9,-109.4,-119.5,-129.1C-80.1,-148.8,-40.1,-154.4,-8.5,-144.3C23.1,-134.2,46.3,-108.5,72,-86.4Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class=" text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">
                  <?= Html::img('@web/img/icons/giftbox.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
              <h4 class="display-5 pt-5 pb-3"  data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">Inscription gratuite</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">Une inscription totalement gratuite sans engagement, avec un accompagnement 100% personnalisé.</p>

            </div>
          </div>
          
          <!-- Advantages row 2 -->
          <div class="row text-center">
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M95.3,-122.5C128.2,-107.2,163,-85.7,190.9,-50.2C218.7,-14.6,239.7,35,227.9,74.9C216,114.7,171.5,144.7,128.1,160.4C84.6,176.2,42.3,177.6,-7.9,188.5C-58.2,199.4,-116.4,219.9,-141.9,198.3C-167.4,176.8,-160.3,113.3,-158.4,64.4C-156.6,15.5,-160.1,-18.9,-160.9,-63.4C-161.8,-108,-159.9,-162.8,-132.7,-179.9C-105.4,-197.1,-52.7,-176.5,-10.8,-161.7C31.2,-146.9,62.3,-137.8,95.3,-122.5Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class=" text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">
                  <?= Html::img('@web/img/icons/growth.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
              <h4 class="display-5 pt-5 pb-3"  data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">Chiffre d’affaire</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="150">Une augmentation de leur chiffre d’affaire grâce aux demandes de réservation envoyées instantanément.</p>

            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M123.1,-148.2C166.1,-110.7,212.1,-78.1,228.6,-33.1C245,11.8,232.1,69.2,197.7,100.6C163.4,131.9,107.7,137.4,57.1,155C6.5,172.6,-39,202.3,-86.8,201.1C-134.6,199.9,-184.6,167.7,-197.1,124.3C-209.6,81,-184.6,26.4,-164.4,-18.8C-144.3,-64,-129,-99.8,-102.4,-140.2C-75.8,-180.7,-37.9,-225.9,1.1,-227.1C40.1,-228.4,80.1,-185.8,123.1,-148.2Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class="display-4 text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
                  <?= Html::img('@web/img/icons/control.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
                <h4 class="display-5 pt-5 pb-3"   data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Contrôle total</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">Un contrôle total sur leurs disponibilités, leurs prix et leurs conditions de travail.</p>

            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
              <div class="svg-icon-wrapper position-relative" data-aos="zoom-in" data-aos-offset="200" data-aos-delay="150">

                    <svg width="200" height="200" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                      <linearGradient id="MyGradient2">
                        <stop stop-color="#0947db"></stop>
                        <stop offset="1" stop-color="#07d89d"></stop>
                      </linearGradient>

                        <g transform="translate(300,300)">
                          <path d="M72,-86.4C97.8,-64.2,126.2,-45.8,155.1,-8.6C183.9,28.5,213.2,84.2,195.6,111.2C178,138.1,113.4,136.3,58.3,153.5C3.1,170.7,-42.8,207,-69.4,195.3C-96,183.6,-103.4,123.8,-128.1,76.3C-152.7,28.8,-194.5,-6.5,-196.1,-41C-197.6,-75.5,-158.9,-109.4,-119.5,-129.1C-80.1,-148.8,-40.1,-154.4,-8.5,-144.3C23.1,-134.2,46.3,-108.5,72,-86.4Z" fill="url(#MyGradient2)"></path>
                        </g>
                      </svg>

                <div class=" text-primary mb-3 icon-wrapper m-shadow-32" data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">
                  <?= Html::img('@web/img/icons/globe.png', ['alt'=>'image', 'class'=>"img-fluid"]);?>
                </div>
              </div>
              <h4 class="display-5 pt-5 pb-3"  data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">International</h4>
              <p data-aos="fade-up" data-aos-offset="200" data-aos-delay="250">La proposition de leurs services auprès des entreprises et des particuliers, avec une ouverture à l’international.</p>

            </div>
          </div>
        
        </div>
      </section>

      <!-- Que bénéficient nos clients? -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-3">
          <div class="row justify-content-center">
            <div class="col col-md-8 text-center" data-aos="fade-up" data-aos-offset="300">
              <h3 class=" display-5 pb-md-4 pb-3"> Que bénéficient nos clients ?</h3>
<!--              <p class="text-h3">To o do later...
                <a href="#">Read more...</a>
              </p>-->
                <ol class="list-unstyled mt-4">
                  <li class="d-flex mb-2 mt-2" >
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="550" ></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="50"><strong class="text-primary">Un choix :</strong> Avec une liste de prestataires innombrables</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="650"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="100"><strong class="text-primary">Des économies :</strong> En comparant le même service pour un meilleur prix</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Une assurance :</strong>En réservant instantanément via le calendrier</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Une idée reçu :</strong>Grace aux avis confirmés sur le prestataire</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Des informations :</strong>Avec un accès à l’essentiel de la description</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Un devis en ligne téléchargeable :</strong>Pour augmenter les transactions avec les entreprises</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Accessibilité:</strong>Un accès 24H/24 à la plateforme</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Une assistance :</strong>Via le chat en cas de besoin</span></li>
                  <li class="d-flex mb-2 mt-2">
                      <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150"><strong class="text-primary">Un service Event EXPRESS :</strong>Pour tous les évènements</span></li>
                </ol>
                
            </div>
          </div>
        </div>
      </section>
      
      <!-- Image team -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
          <div class="row align-items-center justify-content-center">
              
            <div class="col-12 col-md-4  mt-4 mt-md-0 position-relative order-2 order-md-1">
                <div class="svg-card-wrapper-1 aos-init aos-animate">
                    <div class="img-responsive">
                        <?= Html::img('img/team.png', ['width' => '512', 'height' => 'auto']) ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Why a partner -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
          <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-5 pr-md-5" >
              <h3 class="display-5 " data-aos="fade-right">Les Partenaires</h3>
              <p class="text-h3 mt-3 lead" data-aos="fade-right">Les professionnels avec une activité/service, qui peut intervenir dans le domaine de l’événementiel.</p>
              <ol class="list-unstyled mt-4">
                <li class="d-flex mb-2 mt-2" >
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="550" ></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="50">Nos partenaires inscrivent leurs prestations sur notre espace dédié</span></li>
                <li class="d-flex mb-2 mt-2">
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="650"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="100">Acceptent leurs demandes de réservation</span></li>
                <li class="d-flex mb-2 mt-2">
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150">Reçoivent leurs paiements</span></li>
              </ol>
            </div>
            <div class="col-12 col-md-4   mt-4 mt-md-0 position-relative">
              <div class="svg-card-wrapper-1" data-aos="zoom-in" data-aos-offset="200">
                <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                    <linearGradient id="MyGradient4">
                            <stop offset="5%" stop-color="#4158D0"></stop>
                            <stop offset="30%" stop-color="#C850C0"></stop>
                            <stop offset="66%" stop-color="#ff8e00"></stop>
                            <stop offset="100%" stop-color="#ff0a0e"></stop>
                          </linearGradient>
                    <g transform="translate(300,300)">
                      <path d="M123.1,-148.2C166.1,-110.7,212.1,-78.1,228.6,-33.1C245,11.8,232.1,69.2,197.7,100.6C163.4,131.9,107.7,137.4,57.1,155C6.5,172.6,-39,202.3,-86.8,201.1C-134.6,199.9,-184.6,167.7,-197.1,124.3C-209.6,81,-184.6,26.4,-164.4,-18.8C-144.3,-64,-129,-99.8,-102.4,-140.2C-75.8,-180.7,-37.9,-225.9,1.1,-227.1C40.1,-228.4,80.1,-185.8,123.1,-148.2Z" fill="url(#MyGradient4)"></path>
                    </g>
                    </svg>
              </div>
              <div class="card h-100 justify-content-center card-body p-lg-4 p-3 mb-1  border-light border " data-aos="fade-right" data-aos-offset="300">
                  <div class="card-body py-3 flex-grow-0">
                      <span class="d-block h2">“Why a Partner?”</span>
                      <p class="lead">Mailing & phoning, Animation réseaux sociaux, Déplacement locaux et salons d’expositions</p>
                      <a class="lead" href="<?= Url::to(['site/become-partner']) ?>">Become a Partner →</a>
                  </div>
              </div>
            </div>

          </div>
        </div>
      </section>
      
      <!-- Why clients -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
          <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-4  mt-4 mt-md-0 position-relative order-2 order-md-1">
              <div class="svg-card-wrapper-1" data-aos="zoom-in" data-aos-offset="200">
                <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                    <linearGradient id="MyGradient4">
                            <stop offset="5%" stop-color="#4158D0"></stop>
                            <stop offset="30%" stop-color="#C850C0"></stop>
                            <stop offset="66%" stop-color="#ff8e00"></stop>
                            <stop offset="100%" stop-color="#ff0a0e"></stop>
                          </linearGradient>
                    <g transform="translate(300,300)">
                      <path d="M156.1,-174.8C195.1,-153.2,214.7,-97.3,205.4,-50.9C196.1,-4.600000000000001,157.8,32.2,135.2,84.4C112.6,136.5,105.7,204,73.8,225.4C42,246.8,-14.899999999999999,222.1,-72,200.2C-129,178.4,-186.2,159.4,-210.8,120.1C-235.4,80.8,-227.5,21,-207.9,-27.3C-188.2,-75.6,-156.8,-112.5,-120.2,-134.5C-83.6,-156.6,-41.8,-163.8,8.399999999999999,-173.8C58.5,-183.7,117,-196.4,156.1,-174.8Z" fill="url(#MyGradient4)"></path>
                    </g>
                    </svg>
              </div>
              <div class="card h-100 justify-content-center card-body p-lg-4 p-3 mb-1  border-light border " data-aos="fade-right" data-aos-offset="300">
                  <div class="card-body py-3 flex-grow-0">
                      <span class="d-block h2">“Why Subscribe?”</span>
                      <p class="lead">The easy way to organize your events.</p>
                      <a class="lead" href="<?= Url::to(['/user/registration/register']) ?>">Register Now →</a>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-5 pl-md-5 order-1 order-md-2" >
              <h3 class="display-5 " data-aos="fade-right">Comment les attirer les clients?</h3>
              <p class="text-h3 mt-3 lead" data-aos="fade-right"></p>
              <ol class="list-unstyled mt-4">
                <li class="d-flex mb-2 mt-2" >
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="550" ></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="50">Pub sur les réseaux sociaux</span></li>
                <li class="d-flex mb-2 mt-2">
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="650"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="100">Référencement sur la barre de recherche</span></li>
                <li class="d-flex mb-2 mt-2">
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150">Partenariats</span></li>
                <li class="d-flex mb-2 mt-2">
                  <i class="fas fa-check-circle fa-lg text-primarys mr-1 mt-2 mb-2 ml-0" aria-hidden="true" data-aos="zoom-in" data-aos-delay="750"></i><span class="pl-2 pt-1" data-aos="fade-left" data-aos-delay="150">Envoi et distribution de prospectus</span></li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      
      <!-- FAQ -->
      <section class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-center position-relative">
                <h3 class="mb-5 display-5 " data-aos="fade-up">Frequently asked questions (FAQ)</h3>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 text-center position-relative">

              <div class="svg-card-wrapper-3 aos-init aos-animate" data-aos="zoom-in" data-aos-offset="200">
                <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                    <linearGradient id="MyGradient4">
                            <stop offset="5%" stop-color="#4158D0"></stop>
                            <stop offset="30%" stop-color="#C850C0"></stop>
                            <stop offset="66%" stop-color="#ff8e00"></stop>
                            <stop offset="100%" stop-color="#ff0a0e"></stop>
                          </linearGradient>
                    <g transform="translate(300,300)">
                      <path d="M71.3,-120.2C100.1,-92.5,136.5,-85.7,169.1,-62.9C201.7,-40.2,230.5,-1.5,231,37.1C231.6,75.7,203.8,114.2,171.5,145C139.2,175.9,102.3,199.3,59.9,218.3C17.5,237.3,-30.4,252,-55.8,227.5C-81.2,202.9,-84,139.1,-101.7,99.1C-119.3,59,-151.7,42.8,-156.3,21.5C-160.9,0.1999999999999993,-137.8,-26.1,-130.2,-66.4C-122.5,-106.7,-130.5,-161,-111.4,-193.1C-92.3,-225.2,-46.1,-235.1,-12.4,-215.8C21.3,-196.4,42.5,-147.8,71.3,-120.2Z" fill="url(#MyGradient4)"></path>
                    </g>
                    </svg>
              </div>
              <div class="accordion position-relative" id="accordionExample">
                <div class="card   shadow-sm mb-2" data-aos="fade-up">
                  <div class="card-header collapsed py-4" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <p class="mb-0 lead">Comment devenir partenaire?</p>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Vous devez créer un compte chez ClicangoEvent en tant que Partner par <a href="<?= Url::to(['site/partner']) ?>">ici</a></div>
                  </div>
                </div>
                <div class="card   shadow-sm mb-2" data-aos="fade-up">
                  <div class="card-header collapsed py-4" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <p class="mb-0 lead">Pourquoi s'inscire?</p>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">Pour pouvoire bénéficier de nos avantages vous devez vous s'inscire en tant qu'utilisateur, l'inscription est gratuite par <a href="<?= Url::to(['user/registration/register']) ?>">ici</a>.</div>
                  </div>
                </div>
                <div class="card   shadow-sm mb-3" data-aos="fade-up">
                  <div class="card-header collapsed py-4" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <p class="mb-0 lead">J'ai d'autre question</p>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">Vous pouvez tout moment nous <a href="<?= Url::to(['site/contact']) ?>">Contacter</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Ready to start form -->
      <section class="pt-5 pb-5" style="">
        <div class="container pt-5 pb-5 mb-5">
          <div class="row">
            <div class="col">
              <div class="">
                <div class="row text-center justify-content-center">
                  <div class="col-12 col-md-9 col-lg-7" data-aos="fade-up">
                    <h3 class="mb-3 display-5 ">Ready to start?</h3>
                    <p class="text-h3 lead mb-5">S'inscrire sur notre newsletter pour découvrir toutes nouveautés.</p>
                  </div>
                </div>
                <div class="row justify-content-center pt-4" data-aos="fade-up">
                  <div class="col-12 col-md-8">
                    <div class="row justify-content-center">
                      <div class="col-xl-8 col-md-10 position-relative">
                        <div class="svg-card-wrapper-2" data-aos="zoom-in" data-aos-offset="200">
                          <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                              <linearGradient id="MyGradient4">
                                      <stop offset="5%" stop-color="#4158D0"></stop>
                                      <stop offset="30%" stop-color="#C850C0"></stop>
                                      <stop offset="66%" stop-color="#ff8e00"></stop>
                                      <stop offset="100%" stop-color="#ff0a0e"></stop>
                                    </linearGradient>
                              <g transform="translate(300,300)">
                                <path d="M114.6,-174.3C156.7,-151.2,204.8,-133.4,231.1,-98.8C257.3,-64.2,261.8,-13,238.7,22.8C215.5,58.5,164.8,78.7,133.8,117.7C102.7,156.8,91.4,214.6,61.2,236C31.1,257.5,-17.8,242.4,-57.3,219.6C-96.7,196.8,-126.6,166.2,-152.9,133.7C-179.2,101.1,-201.9,66.7,-202.2,32.1C-202.6,-2.5999999999999996,-180.4,-37.4,-165,-77C-149.5,-116.6,-140.7,-160.9,-114.3,-191.2C-87.9,-221.5,-44,-237.8,-3.8999999999999995,-231.7C36.2,-225.7,72.4,-197.4,114.6,-174.3Z" fill="url(#MyGradient4)"></path>
                              </g>
                              </svg>
                        </div>
                        <div class="card card-body  shadow">
                        <form>
                          <div class="form-group">
                            <label class=" " for="course-name-1">Name</label>
                            <input name="course-name" id="course-name-1" type="text" class="form-control form-control-lg" placeholder="Type your name">
                          </div>
                          <div class="form-group">
                            <label class=" " for="course-email-1">Email</label>
                            <input name="course-email" id="course-email-1" type="email" class="form-control form-control-lg" placeholder="you@yoursite.com">
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group mb-1">
                                <label class=" ">Type:</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group rounded bg-white p-2 border">
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="course-radio-beginner-1" name="course-radio-1" class="custom-control-input">
                                  <label class="custom-control-label" for="course-radio-beginner-1">User</label>
                                </div>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group rounded bg-white p-2 border">
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="course-radio-advanced-1" name="course-radio-1" class="custom-control-input">
                                  <label class="custom-control-label" for="course-radio-advanced-1">Partner</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group text-center">
                            <button class="btn btn-lg btn-primary btn-block mb-2 m-shadow-32" type="submit">Send </button>
                            <small class=" ">You’ll recieve your first lesson via email in less than a minute.</small>
                          </div>
                        </form>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- footer section -->

  </div> <!-- /container -->

<?php
$this->registerJs(<<<JS
    const elems = document.querySelectorAll(".laya-vr");
    const layer2 = document.querySelector(".layer-1");
    const layer3 = document.querySelector(".layer-2");
    document.body.addEventListener('mousemove', function (e) {
        let width = window.innerWidth / 2;
        let mouseMoved2 = ((width - e.pageX) / 70);
        let mouseMoved3 = ((width - e.pageY) / 60);
        layer2.style.transform = "translateY(" + mouseMoved2 + "px)";
        layer3.style.transform = "translateX(" + mouseMoved3 + "px)";
    })
JS
);