<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use  yii\web\Session;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Model;

DashboardAsset::register($this);

$session = Yii::$app->session;
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
    
      .modal-header > h3{
        margin-top: 1px;
        margin-bottom: -6px;

    }
    .modal-header > h2{
        margin-top: 1px;
        margin-bottom: -6px;
    }

    </style>
 <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<?php $this->beginBody() ?>
 <style>
 .cgridoverlap{
      overflow-x: scroll;
 }
 .dnone{
	 display:none;
 }
</style>
<?php 
   $session = Yii::$app->session;
   
?>
<div class="wrapper">
     <header class="main-header">
          <a href="<?= Yii::$app->homeUrl ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <!-- <span class="logo-mini"><img src="uploads/mosque/logo_small.png" width="45px" style="background-color: #DDDDDD"></span> -->
          <!-- logo for regular state and mobile devices -->
          <span class="logo">Inzta Study</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">  

            <ul class="nav navbar-nav"> 
                  
              <!-- Chat Message View End  -->    
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="img/profile-img.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo  $session['user_name'];  ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="img/profile-img.jpg" class="img-circle" alt="User Image">
                    <p>
                     <?php echo  $session['user_name'];  ?>
                      
                    </p>
                  </li>
                  <!-- Menu Body -->
                    
                    
                  <!-- Menu Footer-->
                  
                  <li class="user-footer">
                    <?php
                    if(isset($_SESSION['user_logintype'])){ ?>
                    <div class="pull-left">
                      <a href='<?php echo Yii::$app->homeUrl."?r=userdetails/view&id=".$session['user_id']; ?>' class="btn btn-default btn-flat"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </div>
                  <?php }?>
                    
                    <div class="pull-right">                  
					<?php 
          if(isset($_SESSION['user_logintype'])){
           if (Yii::$app->user->isGuest) {
					       echo  ['label' => 'Sign out', 'url' => ['/site/login']];
					    } else {
					        echo '<a>'
					            . Html::beginForm(['/site/logout'], 'post')
					            . Html::submitButton(
					                '<i class="fa fa-fw fa-sign-out"></i> Logout',
					                ['class' => 'btn btn-default btn-flat']
					            )
					            . Html::endForm()
					            . '</a>';
					    }
              } ?>
                    </div>
                  </li>
                </ul>
              </li>
            
            </ul>
          </div>
        </nav>
      </header>
       
    <!-- Left side column. contains the logo and sidebar -->      
 	<?php  echo $this->render('left_menu.php'); ?>
      <!-- Content Wrapper. Contains page content -->
     
     <div class="content-wrapper">
     	<section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          	<div class="col-md-12">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        
    </div>
    </div>
    </section>
    
    </div>
     <?php $this->beginContent('@backend/views/layouts/fooder.php'); ?>
<?php $this->endContent(); ?>
</div>
<script>
 
 
 $('a.sidebar-toggle').click(function(){
	 $('.additional-block').toggleClass('dnone');
 });

</script>

<?php 

 $this->endBody() ?>
 </body>
</html>
<?php $this->endPage() ?>
