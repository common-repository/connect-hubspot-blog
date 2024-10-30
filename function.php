<?php 

/*
** Plugin functions
*/

add_action( 'admin_enqueue_scripts', 'chb_wp_admin_style' );
function chb_wp_admin_style(){
    wp_enqueue_style( 'css-admin', plugin_dir_url( __FILE__ ) . 'assets/css/chb_admin.css', false, '1.0.0');
    wp_enqueue_style( 'css-admin-font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', false, '5.2.0');
}

add_action('wp_enqueue_scripts','chb_load_custom_css_for_site');
function chb_load_custom_css_for_site(){
   wp_enqueue_style('css-front-site-style',plugin_dir_url( __FILE__ ) .'/assets/css/siteStyle.css' );
    wp_enqueue_script( 'slider_cs', plugins_url('assets/js/flexslider.js', __FILE__), false, '1.0.3' );
     wp_enqueue_script( 'slider_custom', plugins_url('assets/js/custom.js', __FILE__), false, '1.0.3' );

}
    
add_action( 'admin_init', 'chb_settings_init' );
function chb_settings_init() { 

 register_setting( 'connect_hubspot_blog', 'chb_options' );

 add_settings_section(
 'chb_section_developers',
 __( '', 'connect_hubspot_blog' ),
 'chb_section_developers_cb',
 'connect_hubspot_blog'
 );

  add_settings_section(
 'chb_section_blog',
 __( '', 'connect_hubspot_blog' ),
 'chb_section_blog_cb',
 'connect_hubspot_blog'
 );

 add_settings_field(
    'chb_field_api',
    __( 'HubSpot API', 'connect_hubspot_blog' ),
    'chb_field_api_fn',
    'connect_hubspot_blog',
    'chb_section_developers',
    array(
        'label_for' => 'chb_field_api',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );

  add_settings_field(
    'chb_siteid',
    __( 'HubSpot site ID', 'connect_hubspot_blog' ),
    'chb_siteid_fn',
    'connect_hubspot_blog',
    'chb_section_developers',
    array(
        'label_for' => 'chb_siteid',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );


  add_settings_field(
    'chb_field_listblogs',
    __( 'Select blog', 'connect_hubspot_blog' ),
    'chb_field_listblogs_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_listblogs',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );

  add_settings_field(
    'chb_field_count',
    __( 'Number of articles', 'connect_hubspot_blog' ),
    'chb_field_count_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_count',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );

   add_settings_field(
    'chb_field_cols',
    __( 'Number of columns', 'connect_hubspot_blog' ),
    'chb_field_cols_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_cols',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );
   add_settings_field(
    'chb_field_perpage',
    __( 'Post per page', 'connect_hubspot_blog' ),
    'chb_field_perpage_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_perpage',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );
 // * For list and Slider option*//
 add_settings_field(
    'chb_field_listType',
    __( 'List type', 'connect_hubspot_blog' ),
    'chb_field_listType_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_listType',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );  

 add_settings_field(
    'chb_field_blogexcerpt',
    __( 'Show blog text?', 'connect_hubspot_blog' ),
    'chb_field_blogexcerpt_fn',
    'connect_hubspot_blog',
    'chb_section_blog',
    array(
        'label_for' => 'chb_field_blogexcerpt',
        'class' => 'chb_row',
        'chb_custom_data' => 'custom',
    )
 );
}

function chb_load_custom_wp_admin_style_script() {
    if (isset($_GET['page'])) {
      
        if ( $_GET['page'] != 'connect_hubspot_blog' ) {
            return;
        }
        
    }

    wp_enqueue_script( 'js', plugins_url('assets/js/chblink.js', __FILE__), false, '1.0.0' );
    $options = get_option( 'chb_options' );

    if ($options['chb_siteid'] != '' && $options['chb_field_api'] != '') {

        wp_enqueue_script( 'jstrack', plugins_url('assets/js/chbtrack.js', __FILE__), false, '1.0.3' );
        wp_localize_script( 'jstrack', 'hsvars', array('siteid' => $options['chb_siteid']));
    }

    wp_enqueue_style( 'css', plugins_url('assets/css/chblink.css', __FILE__), false, '1.0.0');
    wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', false, '3.3.7');
    wp_enqueue_style( 'fa', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css', false, '4.7.0');

}
add_action( 'admin_enqueue_scripts', 'chb_load_custom_wp_admin_style_script' );


function chblink_options_page() {
  $page_title = 'HubSpot Connecter';
  $menu_title = 'HubSpot Connecter';
  $capability = 'manage_options';
  $menu_slug  = 'connect_hubspot_blog';
  $function   = 'chblink_options_page_html';
  $icon_url   = plugins_url( '/assets/images/suss.png', __FILE__ );
  $position   = 1;

  add_menu_page( $page_title,
                 $menu_title, 
                 $capability, 
                 $menu_slug, 
                 $function, 
                 $icon_url, 
                 $position );
}
add_action( 'admin_menu', 'chblink_options_page' );

function chb_section_developers_cb( $args ) {
 ?>
<div class="main-panel">
	<div class="header_section">
		<p id="hubspot_banner"><img src="<?php echo plugins_url( '/assets/images/banner.svg', __FILE__ ); ?>" /></p>

		<h3 class="setting-title">HubSpot settings</h3>
	</div>	
    <ul class="tabs">
        <li class="tab-link current" id="api_sec" data-tab="tab-1">Api settings</li>
        <li class="tab-link" id="blog_sec" data-tab="tab-2">Blog settings</li>
    </ul>
    <p id="chb_connection">
        <?php if(chb_check_status() == true) { ?>
            <div class="alert alert-success" role="alert"><strong><i class="fa fa-check-circle" aria-hidden="true"></i> </strong></div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert"><strong><i class="fa fa-times" aria-hidden="true"></i></strong></div>
        <?php } ?>
    </p>

<?php
}

function chb_section_blog_cb( $args ) {
 ?>
    <div id="tab-2" class="tab-content">
        <div class="blog_section"></div>	
    </div>
</div>
<?php
}

 
function chb_field_api_fn( $args ) {
 $options = get_option( 'chb_options' );
 ?>

 <input value="<?php echo esc_attr( $options['chb_field_api'] ); ?>" placeholder="66z6zd2d-xxxx-xxxx-xxxx-xxxxxxxp2o49" id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>"
 name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" />
 
 <?php
}

function chb_field_count_fn( $args ) {
 $options = get_option( 'chb_options' );
 ?>

 <input <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> value="<?php echo esc_attr( $options['chb_field_count'] ); ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>"
 name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]"  <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?> />
 
 <?php
}

function chb_field_cols_fn( $args ) {
 $options = get_option( 'chb_options' );


 ?>

<select <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" 
        id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>" <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?> > 

<?php
    
    for($i=1; $i<5; $i++){ ?>

         <option value="<?php echo $i; ?>" <?php if ($options['chb_field_cols'] == $i) { echo "selected"; } ?> >
            <?php echo $i; ?>
        </option>
    <?php }
?>
 
</select>
 

 <?php
}

function chb_field_perpage_fn( $args ) {
 $options = get_option( 'chb_options' );


 ?>

 <input <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> value="<?php echo esc_attr( $options['chb_field_perpage'] ); ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>"
 name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?> />
 

 <?php
}

function chb_field_listType_fn( $args ) {
 $options = get_option( 'chb_options' );

 ?>

 <select <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" 
        id="<?php echo esc_attr( $args['label_for'] ); ?>" data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>" <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?> > 

<?php
    $listarray = array('List','Slider');
    foreach ($listarray as $listValue) { ?>

         <option value="<?php echo $listValue; ?>" <?php if ($options['chb_field_listType'] == $listValue) { echo "selected"; } ?> >
            <?php echo $listValue; ?>
        </option>
    <?php }
?>
 
</select>
 

 <?php
}

function chb_field_blogexcerpt_fn( $args ) {
 $options = get_option( 'chb_options' );
 ?>

<input <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" 
    type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" 
    value="1" name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]"  <?php if (isset($options['chb_field_blogexcerpt'])) { echo "checked"; } ?> <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?>/>


 <?php
}

function chb_siteid_fn( $args ) {
 $options = get_option( 'chb_options' );
 ?>

 <input <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> value="<?php echo esc_attr( $options['chb_siteid'] ); ?>" placeholder="xxxxxxx" id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['chb_custom_data'] ); ?>"
 name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" />

 <?php
}

function chb_field_listblogs_fn( $args ) {
 $options = get_option( 'chb_options' );
 ?>

<select <?php if($options['chb_field_api'] == "") { echo 'disabled'; } ?> name="chb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" 
        id="<?php echo esc_attr( $args['label_for'] ); ?>"  <?php if(chb_check_status() !== true) {  ?> disabled <?php } ?>> 

<?php
    $content = wp_remote_get('https://api.hubapi.com/content/api/v2/blogs?hapikey=' . esc_attr( $options['chb_field_api'] ));
    $content = wp_remote_retrieve_body( $content );
    $data = json_decode($content);
    
    foreach($data->objects as $blog) {
    ?>
        <option value="<?php echo $blog->id; ?>" <?php if ($options['chb_field_listblogs'] == $blog->id) { echo "selected"; } ?> >
            <?php echo $blog->name ?>
        </option>
    <?php
    }
?>
 
</select>

 <?php
}

 
function chblink_options_page_html() {
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}
 
if ( isset( $_GET['settings-updated'] ) ) {
    add_settings_error( 'chb_messages', 'chb_message', __( 'Settings Saved', 'chb' ), 'updated' );
}
 
 settings_errors( 'chb_messages' );
 ?>
 <div class="wrap">
     <form action="options.php" method="post" class="set-sec">
        
           
            <?php 
                settings_fields( 'connect_hubspot_blog' ); 
               
                do_settings_sections( 'connect_hubspot_blog' );

                submit_button( 'Save HubSpot settings' ); 
            ?>
            <p class="get-shortcode"><a id="get_sCode" href="javascript:void(0)" class="button button-primary">Get shortcode</a></p>


     </form>
     <div class="hs-jumbotron" id="shortCodeSec" style="display:none;">
        <div class="shortcode-inner">
            <span><i class="fa fa-times"></i></span>
            <?php
                $options    = get_option( 'chb_options' );
                $blogid     = $options['chb_field_listblogs'];
                $limit      = $options['chb_field_count'];
                $cols       = $options['chb_field_cols'];
                $per_page   = $options['chb_field_perpage'];
                $list_Type  = $options['chb_field_listType'];
                $showtext   = $options['chb_field_blogexcerpt'];
                if($limit == "") $limit = '6'; 
                if($cols == "") $cols = '1';
                if($showtext == "") $showtext = '0';
                $shortcode  = "[chb-blog id=$blogid limit=$limit cols=$cols perpage=$per_page listtype=$list_Type showtext=$showtext]";
                //$shortcode = "[chb-blog id=1234567 limit=10 cols=2 showtext=1]";
            ?>
              <?php if($options['chb_field_api'] == "") { ?>
                <div class="alert alert-warning">
                  <strong>Warning:</strong> Connect HubSpot to get shortcode.
                </div>
             <?php } else { ?>
                <p>Shortcode snippet: <code><?php echo $shortcode; ?></code></p>
                <p>PHP snippet: <code><?php echo htmlspecialchars('<?php echo do_shortcode(\'' . $shortcode . '\'); ?>'); ?></code></p>
             <?php } ?>
        </div>
    </div>
</div>
 <?php
}

function chb_check_status() {
    $options = get_option( 'chb_options' );

    $content = wp_remote_get('https://api.hubapi.com/content/api/v2/blog-posts?hapikey=' . esc_attr( $options['chb_field_api'] ));
    $content = wp_remote_retrieve_body( $content );
    $data = json_decode($content);
    //print_r($data); die;
    if($data->status == 'error') {
        return false;
    }else{

        return true;
    }
}


function chblink_blog_shortcode( $atts, $content = null ) {
    //print_r($atts); die;

    $BlogType = new BlogType();
    echo $BlogType->_blog_category_list($atts); 
     
    
}

add_shortcode('chb-blog','chblink_blog_shortcode');


function chb_truncateHTML($html, $limit = 20) {
    static $wrapper = null;
    static $wrapperLength = 0;
    $html = trim($html);
    $html = preg_replace("~<!--.*?-->~", '', $html);
    if ((strlen(strip_tags($html)) > 0) && strlen(strip_tags($html)) == strlen($html))  {
        return substr($html, 0, $limit);
    }
    elseif (is_null($wrapper)) {
        if (!preg_match("~^\s*<[^\s!?]~", $html)) {
            $wrapper = 'div';
            $htmlWrapper = "<$wrapper></$wrapper>";
            $wrapperLength = strlen($htmlWrapper);
            $html = preg_replace("~><~", ">$html<", $htmlWrapper);
        }
    }
    $totalLength = strlen($html);
    if ($totalLength <= $limit) {
        if ($wrapper) {
            return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
        }
        return strlen(strip_tags($html)) > 0 ? $html : '';
    }
    $dom = new DOMDocument;
    $dom->loadHTML($html,  LIBXML_HTML_NOIMPLIED  | LIBXML_HTML_NODEFDTD);
    $xpath = new DOMXPath($dom);
    $lastNode = $xpath->query("./*[last()]")->item(0);
    if ($totalLength > $limit && is_null($lastNode)) {
        if (strlen(strip_tags($html)) >= $limit) {
            $textNode = $xpath->query("//text()")->item(0);
            if ($wrapper) {
                $textNode->nodeValue = substr($textNode->nodeValue, 0, $limit );
                $html = $dom->saveHTML();
                return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
            } else {
                $lengthAllowed = $limit - ($totalLength - strlen($textNode->nodeValue));
                if ($lengthAllowed <= 0) {
                    return '';
                }
                $textNode->nodeValue = substr($textNode->nodeValue, 0, $lengthAllowed);
                $html = $dom->saveHTML();
                return strlen(strip_tags($html)) > 0 ? $html : '';
            }
        } else {
            $textNode = $xpath->query("//text()")->item(0);
            $textNode->nodeValue = substr($textNode->nodeValue, 0, -(($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $limit));
            $html = $dom->saveHTML();
            return strlen(strip_tags($html)) > 0 ? $html : '';
        }
    }
    elseif ($nextNode = $lastNode->nextSibling) {
        if ($nextNode->nodeType === 3 /* DOMText */) {
            $nodeLength = strlen($nextNode->nodeValue);
            if (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength >= $limit) {
                $nextNode->parentNode->removeChild($nextNode);
                $html = $dom->saveHTML();
                return chb_truncateHTML($html, $limit);
            }
            else {
                $nextNode->nodeValue = substr($nextNode->nodeValue, 0, ($limit - (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength)));
                $html = $dom->saveHTML();
                if ($wrapper) {
                    return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
                }
                return $html;
            } 
        }
    }
    elseif ($lastNode->nodeType === 1 /* DOMElement */) {
        $nodeLength = strlen($lastNode->nodeValue);
        if (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength >= $limit) {
            $lastNode->parentNode->removeChild($lastNode);
            $html = $dom->saveHTML();
            return chb_truncateHTML($html, $limit);
        }
        else {
            $lastNode->nodeValue = substr($lastNode->nodeValue, 0, ($limit - (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength)));
            $html = $dom->saveHTML();
            if ($wrapper) {
                return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
            }
            return $html . "...";
        }
    }
}

function chb_html2text($Document) {
    $Rules = array ('@<script[^>]*?>.*?</script>@si',
                    '@<[\/\!]*?[^<>]*?>@si',
                    '@([\r\n])[\s]+@',
                    '@&(quot|#34);@i',
                    '@&(amp|#38);@i',
                    '@&(lt|#60);@i',
                    '@&(gt|#62);@i',
                    '@&(nbsp|#160);@i',
                    '@&(iexcl|#161);@i',
                    '@&(cent|#162);@i',
                    '@&(pound|#163);@i',
                    '@&(copy|#169);@i',
                    '@&(reg|#174);@i',
                    '@&#(d+);@e'
             );
    $Replace = array ('',
                      '',
                      '',
                      '',
                      '&',
                      '<',
                      '>',
                      ' ',
                      chr(161),
                      chr(162),
                      chr(163),
                      chr(169),
                      chr(174),
                      'chr()'
                );
  return preg_replace($Rules, $Replace, $Document);
}


add_action( 'admin_bar_menu', function( \WP_Admin_Bar $bar ) {

    $iconurl = plugins_url( '/assets/images/suss.png', __FILE__ );
    $iconspan = '<span class="custom-icon" style=" float:left; width:26px !important; height:26px !important; margin-right: 5px!important; margin-left: 10px !important; margin-top: 5px !important; background-image:url(\''.$iconurl.'\');"></span>';

    $title = __( 'HubSpot Connecter', 'connect_hubspot_blog' );

    $bar->add_menu( array(
        'id'     => 'wpse',
        'title'  => $iconspan.$title,
        'href' => get_site_url() . '/wp-admin/admin.php?page=connect_hubspot_blog', 
        'meta'   => array(
            'target'   => '_self',
            'title'    => __( 'HubSpot Connecter', 'connect_hubspot_blog' ),
            'html'     => '',
        ),
    ) );
}, 999 ); 