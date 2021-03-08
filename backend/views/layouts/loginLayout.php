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

<div class="wrap">
    <div class="container">      
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?> Inzta Study </strong>     All rights reserved.</p>
        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
