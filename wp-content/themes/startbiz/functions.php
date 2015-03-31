<?php
/**
* Functions
*
* @file 		 functions.php
* @package	 StartPress Business
* @author	 StartPress Team - Carrie
* @copyright	 2014 StartPress Studio
* @version	 1.0.1
* @link		 http://startpress.cc
*/

$themename = "StartBiz";
$themefolder = "startbiz";
define ('theme_name', $themename );
define ('theme_ver' , 1 );

// 定義主題名稱與資料夾
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 1 );

// 載入自定佈景主題函式庫
include (TEMPLATEPATH . '/custom-functions.php');

// 獲取主題函式
include (TEMPLATEPATH . '/functions/banners.php');
include (TEMPLATEPATH . '/functions/common-scripts.php');
include (TEMPLATEPATH . '/functions/default-options.php');
include (TEMPLATEPATH . '/functions/home-cat-pic.php');
include (TEMPLATEPATH . '/functions/home-cats.php');
include (TEMPLATEPATH . '/functions/home-cat-scroll.php');
include (TEMPLATEPATH . '/functions/home-cat-tabs.php');
include (TEMPLATEPATH . '/functions/home-cat-videos.php');
include (TEMPLATEPATH . '/functions/home-recent-box.php');
include (TEMPLATEPATH . '/functions/theme-functions.php');
include (TEMPLATEPATH . '/functions/updates.php');
include (TEMPLATEPATH . '/functions/widgetize-theme.php');

include (TEMPLATEPATH . '/includes/breadcrumbs.php');
include (TEMPLATEPATH . '/includes/pagenavi.php');
include (TEMPLATEPATH . '/includes/wp_list_comments.php');
include (TEMPLATEPATH . '/includes/widgets.php');

// 載入主題設定選項
include (TEMPLATEPATH . '/spanel/shortcodes/shortcode.php');
if (is_admin()) {
	include (TEMPLATEPATH . '/spanel/spanel-ui.php');
	include (TEMPLATEPATH . '/spanel/spanel-functions.php');
	include (TEMPLATEPATH . '/spanel/category-options.php');
	include (TEMPLATEPATH . '/spanel/post-options.php');
	include (TEMPLATEPATH . '/spanel/custom-slider.php');
}


/*-----------------------------------------------------------------------------------*/
# 自訂控制台工具欄選單
/*-----------------------------------------------------------------------------------*/
function stf_admin_bar() {
	global $wp_admin_bar;
	
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'spanel_page',
			'title' => theme_name ,
			'href' => admin_url( 'admin.php?page=spanel')
		) );
	}
}
add_action( 'wp_before_admin_bar_render', 'stf_admin_bar' );

if ( ! isset( $content_width ) ) $content_width = 618;

// 主題安裝啟用後進入主題設定選項頁面
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {

	if( !get_option('stf_active') ){
		stf_save_settings( $default_data );
		update_option( 'stf_active' , theme_ver );
	}
   //header("Location: admin.php?page=spanel");
}

//add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
//function add_login_logout_link($items, $args) {

//		ob_start();
//        wp_loginout('index.php');
//        $loginoutlink = ob_get_contents();
//        ob_end_clean();
//        $items .= '<li id="menu-item-100">'. $loginoutlink .'</li>';
//    return $items;
//}

// remove the admin bar
if ( !current_user_can('administrator') ) { 
	show_admin_bar(false);
	echo '<style type="text/css"> #ozhmenu_wrap{display:none;}
	#screen-meta-links .screen-meta-toggle {
	display: none;
	}</style>' ;
}

add_action('phpmailer_init', 'mail_smtp');
function mail_smtp( $phpmailer ) {
  $phpmailer->IsSMTP();
  $phpmailer->SMTPAuth = true; // 啟用SMTPAuth服務
  $phpmailer->Port = 465;  //SMTP郵件發送埠，
  $phpmailer->SMTPSecure ="ssl"; //是否驗證ssl或tls
  $phpmailer->Host = "smtp.gmail.com"; // 郵件的SMTP服務器地址
  $phpmailer->Username = "wangejay@gmail.com<script cf-hash="f9e31" type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script>"; //你的郵件地址
  $phpmailer->Password ="zZ367172"; //你的郵件登陸密碼
}


?>