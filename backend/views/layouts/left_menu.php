<?php

$session = Yii::$app->session;
$session['user_logintype'];
//echo "<pre>";print_r($_SESSION);die;
$menu_data_array = array();
use yii\helpers\Url;

 if($session['user_logintype']=='T1')
 {
  $menu_data_array[0] = array('one', 'Dashboard', Yii::$app -> homeUrl, '<i class="fa fa-dashboard"></i>', 'site/index');
  $menu_data_array[1] = array('one', 'Admin User Management', Yii::$app->homeUrl.'?r=userdetails/index', '<i class="fa fa-fw fa-users" aria-hidden="true"></i>', 'userdetails/index');
  $menu_data_array[2] = array('one', 'User Management', Yii::$app->homeUrl.'?r=user-management/index', '<i class="fa fa-fw fa-user" aria-hidden="true"></i>', 'user-management/index');
  $menu_data_array[3] = array('one', 'Category Management', Yii::$app->homeUrl.'?r=category-management/index', '<i class="fa fa-fw fa-tasks" aria-hidden="true"></i>', 'category-management/index');
  $menu_data_array[4] = array('one', 'Sub Category', Yii::$app->homeUrl.'?r=sub-category/index', '<i class="fa fa-fw fa-tasks" aria-hidden="true"></i>', 'sub-category/index');
  $menu_data_array[5] = array('one', 'Chapter Management', Yii::$app->homeUrl.'?r=chapter-management/index', '<i class="fa fa-fw fa-tasks" aria-hidden="true"></i>', 'chapter-management/index');
  $menu_data_array[6]=array('more','Content Management','#','<i class="fa fa-file"></i>','content-management');
  $menu_data_array[6]['sub'][0]=array('PDF Management',Yii::$app->homeUrl.'?r=content-management/index','<i class="fa fa-file-pdf-o" aria-hidden="true"></i>','content-management','content-management');
  $menu_data_array[6]['sub'][1]=array('Video Management',Yii::$app->homeUrl.'?r=content-management/videoindex','<i class="fa fa-file-video-o" aria-hidden="true"></i>','content-management','content-management');
  $menu_data_array[7] = array('one', 'Home Tag Management', Yii::$app->homeUrl.'?r=home-tag-management/index', '<i class="fa fa-home" aria-hidden="true"></i>', 'home-tag-management/index');
}else if($session['user_logintype']=='R2'){
}
$html_menu_out = '';
$controler_url_id = Yii::$app ->controller->id;
$active_url_id = Yii::$app ->controller->action->id;
$html_menu_out_tmp = $controler_url_id . "/" . $active_url_id;
foreach ($menu_data_array as $one_ig => $one_menus) {
	if (count($one_menus) > 0) {
		if ($one_menus[0] == 'more') {
			$isselct = '';
			if ($controler_url_id == $one_menus[4]) {$isselct = 'active';
			}//echo $isselct;
			$html_menu_out2 = '<ul class="treeview-menu">';
			foreach ($one_menus['sub'] as $one_submenus) {
				$isactive = '';
				if ($active_url_id == "index") {
					if ($active_url_id == $one_submenus[4] || $controler_url_id == $one_submenus[4]) {
						$isactive = 'class="active"';
						if ($isselct == '') {
							$isselct = 'active';
						}
					}
				} else {
					if ($active_url_id == $one_submenus[4]) {$isactive = 'class="active"';
					}
				}
				$html_menu_out2 .= '<li ' . $isactive . '><a href="' . $one_submenus[1] . '">' . $one_submenus[2] . '' . $one_submenus[0] . '</a></li>';
			}
			$html_menu_out1 = '<li class="treeview ' . $isselct . '"><a href="#">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span><i class="fa fa-angle-left pull-right"></i></a>';
			$html_menu_out2 .= '</ul></li>';
			$isselct = '';
			$html_menu_out .= $html_menu_out1 . $html_menu_out2;
		} elseif ($one_menus[0] == 'one') {
			$isselct = '';
			if ($active_url_id == "index") {
				if ($controler_url_id.'/'.$active_url_id == $one_menus[4] ) {$isselct = 'active';
				//die;
				}
			} else {
				if ($html_menu_out_tmp == $one_menus[4]) {

					$isselct = 'active';
				}
			}
			$html_menu_out .= '<li class="treeview ' . $isselct . '">
		              <a href="' . $one_menus[2] . '">' . $one_menus[3] . ' <span>' . $one_menus[1] . '</span></a></li>';
		}
	}
}
?>
<aside class="main-sidebar">
<section class="sidebar">
<ul class="sidebar-menu">
<?php echo $html_menu_out; ?>
</ul>
</section>
</aside>