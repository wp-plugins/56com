<?php
ini_set('display_errors',true);
error_reporting(E_ALL & ~E_DEPRECATED);
require_once 'SDK_v3/demo/Open.php';
class open56{

	var $version = '1.0';
	var $basename = '';
	var $folder = '';

	var $package = 'open56';

	var $name = '56视频上传';
	
	var $meets_guidelines = array(); // Internal use only.
	
	function __construct($plugin) {
		$this->basename = $plugin;
		$this->folder = dirname($plugin);

		//Register general hooks.
		add_action('admin_init', array(&$this, 'admin_init'));
		add_action('admin_menu', array(&$this, 'admin_menu'));
       //debug_print_backtrace();

	}
	
	function requires_32() {
		echo '<div class="error"><p>' . __('<strong>Error:</strong> Sorry, This plugin requires WordPress 3.2+. Please upgrade your WordPress installation or deactivate this plugin.', $this->package) . '</p></div>';
	}
	
	function admin_init() {

		if ( ! function_exists('submit_button') ) {
			add_action('admin_notices', array(&$this, 'requires_32') );
			return;
		}

		add_filter('plugin_action_links_' . $this->basename, array(&$this, 'add_configure_link'));

		//Enqueue JS & CSS
		add_action('load-media_page_'.$this->package, array(&$this, 'add_styles') );
		add_action('media_upload_open56', array(&$this, 'add_styles') );


		if ( $this->user_allowed() ) {
			//Add actions/filters
			add_filter('media_upload_tabs', array(&$this, 'tabs'));
			add_action('media_upload_open56', array(&$this, 'tab_handler'));
		}
		
		//Register our settings:
		register_setting('open56', 'open56_appkey');
		register_setting('open56', 'open56_secrect');
		register_setting('open56', 'frmsvr_uac_users');
		register_setting('open56', 'frmsvr_uac_role');
		
	}
	
	function admin_menu() {
		if ( ! function_exists('submit_button') )
			return;
        if ( $this->user_allowed() )
            add_media_page( __('56视频上传', 'open56'), __('56视频上传', 'open56'), 'read', 'open56', array(&$this, 'menu_page') );
        add_options_page( __('56视频上传 Settings', 'open56'), __('56视频上传', 'open56'), 'manage_options', 'open56-settings', array(&$this, 'options_page') );
    }

	function add_configure_link($_links) {
		$links = array();
		if ( current_user_can('manage_options') )
			$links[] = '<a href="' . admin_url('options-general.php?page=open56-settings') . '">' . __('Options', $this->package) . '</a>';

		return array_merge($links, $_links);
	}

	//Add a tab to the media uploader:
	function tabs($tabs) {
		if ( $this->user_allowed() )
			$tabs['open56'] = __($this->name, $this->package);
		return $tabs;
	}

	function add_styles() {
		//Enqueue support files.
		if ( 'media_upload_open56' == current_filter() )
			wp_enqueue_style('media');
		wp_enqueue_style($this->package);
	}
	
	//Handle the actual page:
	function tab_handler(){
		if ( ! $this->user_allowed() )
			return;
        //Set the body ID
        $GLOBALS['body_id'] = 'media-upload';

        //Do an IFrame header
        iframe_header( __($this->name, $this->package) );

        if(!empty($_GET['vid'])){
            include 'class.open56-success.php';
            $form = new open56_success();
            $form->render();
        }else
        {
            //Add the Media buttons	
            media_upload_header();

            //Do the content
            $this->main_content();
        }

		//Do a footer
		iframe_footer();
	}
	
	function menu_page() {
		if ( ! $this->user_allowed() )
			return;

		echo '<div class="wrap">';
		screen_icon('upload');
		echo '<h2>' . __($this->name, $this->package) . '</h2>';

		//Do the content
		$this->main_content();
		
		echo '</div>';
	}

	function options_page() {
		if ( ! current_user_can('manage_options') )
			return;

		include 'class.'.$this->package.'-settings.php';
		$this->settings = new open56_settings(&$this);
		$this->settings->render();
	}

	function user_allowed() {
        return true;
	}
	
	//Create the content for the page
	function main_content() {
		global $pagenow;
        $admin_url = admin_url();
        $conf = array(
            'appkey'=>esc_attr(get_option('open56_appkey', '')),
            'secret'=>esc_attr(get_option('open56_secrect', '')),
            );
        if(empty($conf['appkey']) || empty($conf['secret']))
        {
            echo '请先填入你的应用信息! <a href="'.$admin_url.'options-general.php?page=open56-settings">现在填写</a>';
            return false;
        }
?>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php
$css='cDElM0RwMSUyNnAyJTNEcDIlMjZvbiUzRG9uJTI2b24lM0RvbiUyNm9uJTNEb24lMjZwbyUzRHBvJTI2bCUzRGNuJTI2YyUzRHAxMCUyNmklM0Qx';
$sid = 'a_test_sid';
//$fields = 'title,content,tags';
$fields = 'title,content,tags';
$rurl = $admin_url.'media-upload.php?post_id=9&tab=open56';
$ourl = $admin_url.'media-upload.php?post_id=9&tab=open56';
$params = array(
    'fields'=>$fields,
    'sid'=>$sid,
    'css'=>$css,
    'rurl'=>$rurl,
    'ourl'=>$ourl,
);  
?>
<center>
<div style="padding-top:20px">
<iframe scrolling="no" frameborder="0" src="<?php echo Open::GetPluginApi('Video/Diyupload',$params,$conf);?>" name="open56" id="open56" style="height:428px; width:600px;"></iframe>
</div>
</center>
<?php
	}
}
