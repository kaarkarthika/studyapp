<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
            .navbar-inverse {
        background-color: #0d62ae !important;
        border-color: #080808;
    }
    .navbar-inverse {
         background-color: rgba(247, 247, 247, 0) !important;
        border-color: rgba(230, 234, 235, 0);
    }
    .wrap > .container {
      padding: 61px 15px 20px !important;
    }
  /*  .wrap{
        background-image: url('nasalogo2.png');
        background-size: cover;

    }*/
    .login-box-body, .register-box-body {
    background: rgba(26, 25, 21, 0.95) !important;
   
    }
    </style>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>

<div class="w rap">
    <?php
    /*NavBar::begin([
        'brandLabel' => '',//My Company
        'brandUrl' => '',//Yii::$app->homeUrl
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
   /* $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
      //  $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        $menuItems[] = ['label' => '', 'url' => []];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([

        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end(); */
    ?>

    <div class="con tainer">      
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
