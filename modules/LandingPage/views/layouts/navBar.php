  <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Profile', 'url' => ['/user/profile', 'id' => \Yii::$app->user->id], 'visible' => !User::isGuest() && !User::isAdmin()],
           // ['label' => 'Profiles', 'url' => ['/profile/index'], 'visible' => User::isAdmin()],
            ['label' => 'Partner', 'url' => ['/partner/index'], 'visible' => User::isAdmin()],
           // ['label' => 'Reservation', 'url' => ['/reservation/index'], 'visible' => User::isAdmin()],
            ['label' => 'Payment', 'url' => ['/payment/index'], 'visible' => User::isAdmin()],
            ['label' => 'Subscription', 'url' => ['/subscription/index'], 'visible' => User::isAdmin()],
            ['label' => 'About Us', 'url' => ['/site/about'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Contact', 'url' => ['/site/contact'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Terms & Conditions', 'url' => ['/site/terms'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Administration', 'url' => ['/user/admin'], 'visible' => User::isAdmin()],
            


            /*[ // TODO: need to secure access!
                'label' => 'Configuration',
                'items' => [
                     ['label' => 'Permission', 'url' => ['/admin/permission']],
                     ['label' => 'Route', 'url' => ['/admin/route']],
//                     ['label' => 'Menu', 'url' => ['/admin/menu']],
                     ['label' => 'Role', 'url' => ['/admin/role']],
                     ['label' => 'Assignment', 'url' => ['/admin/assignment']],
                     ['label' => 'User', 'url' => ['/admin/user']],
                ],
            ],*/
            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
                ['label' => 'Login', 'url' => ['/user/security/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);