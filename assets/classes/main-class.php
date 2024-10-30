<?php 

class BlogType{

		public $chb_siteid; 
		public $opt;
		public $chb_field_api;
		public $chb_field_listblogs; 
		public $chb_field_count;
		public $chb_field_perpage;   
		public $chb_field_cols; 
		public $chb_field_blogexcerpt;  			
		
		function __construct(){
			
			$options 					    = $this->_option_data();
			$this->opt 						= $options;
			$this->chb_field_api 			= $options['chb_field_api'];
			$this->chb_siteid 				= $options['chb_siteid'];
			$this->chb_field_listblogs 		= $options['chb_field_listblogs'];
			$this->chb_field_count 			= $options['chb_field_count'];
			$this->chb_field_cols 			= $options['chb_field_cols'];
			$this->chb_field_perpage 		= $options['chb_field_perpage'];
			$this->chb_field_blogexcerpt 	= $options['chb_field_blogexcerpt'];
			require_once( dirname( __FILE__ ) . '/main-pagination.php' );
		}

		function _option_data(){
			return get_option( 'chb_options' );
		}	

		function _blog_category_list($atts){
	    	// Get blogs by category

			$content_group_id   = $atts['id'];
			$limit     			= $atts['limit'];

	    	$blog_content = wp_remote_get('https://api.hubapi.com/content/api/v2/blog-posts?content_group_id='.$content_group_id.'&state=PUBLISHED&limit=' . $limit. '&hapikey=' . $this->chb_field_api );

	    	$blog_content = wp_remote_retrieve_body( $blog_content );
		    $blog_data = json_decode($blog_content);
		    return $this->__all_content($atts);
		}

		function __all_content($atts){
			
			$content_group_id   = $atts['id'];
		    $limit     			= $atts['limit'];
		    $col      			= $atts['cols'];
		    $per_page  		    = $atts['perpage'];
		    $listType  	        = $atts['listtype'];
		    $showtext  			= $atts['showtext'];

		    if($per_page == ""){
		        $per_page = 6;
		    }

			$all_content 	= wp_remote_get('https://api.hubapi.com/content/api/v2/blog-posts?content_group_id='.$content_group_id.'&state=PUBLISHED&limit=' . $limit. '&hapikey=' . $this->chb_field_api );
			$all_content    = wp_remote_retrieve_body( $all_content );
		    $all_data1 		= json_decode($all_content);

		    $pagination 	= new connect_hubspot_Pagination();
			$pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
			if (isset($_GET['direction']) && $_GET['direction'] == 'reversed') $pagination->reverse(true);
			
			$pagination->records(count($all_data1->objects));
			$pagination->records_per_page($per_page);
			$DATA = array_slice($all_data1->objects ,(($pagination->get_page() - 1) * $per_page), $per_page);

			if( !empty($listType) && $listType == 'List'){
				$mainData    = $DATA;
				$sliderClass = 'noslide';
			}else{
                /* === For Slider ===*/
				$mainData  = $all_data1->objects;
				$sliderClass = 'slides';
				//$mainData    = $DATA;
				//$sliderClass = 'noslide';
			}

			$html  			= '<div class="flexslider slider_panel"><ul class="'.$sliderClass.'">';

		    $html 		   .= '<li class="row blog_pannel">';
			$i 				= 0;
			$ic 			= 1;
			/*if( !empty($listType) && $listType == 'List' ){
				$mainData  = $DATA;
			}else{
				$mainData  = $all_data1->objects;
			}*/
			    foreach($mainData as $post) {

			        $timestamp      = $post->created_time;
			        $publish_date   = date('d M Y', $timestamp / 1000);
			        $scaf           = 12 / $col;
			        $body           = $post->post_body;
			        $body           = wp_trim_words($body,50); 
			        $author_name    = $post->author_name;


				    $html .= '<div class="col-md-'.$scaf.' " >';

				    $html 	.=  '<article>';

			    				if($post->featured_image !== "") {

			    					$html 	.=	'<div class="imageSec"><header><figure class="hs-blog-image-block">';

			    					$html   .=  ' <a target="_blank" href="'.$post->absolute_url.'"><img class="hs-blog-image" src="'.$post->featured_image.'" alt="'.$post->featured_image_alt_text.'" /></a>';

			    					$html 	.=	'</figure><h1 class="entry-title"><a target="_blank" href="'.$post->absolute_url.'">'.$post->html_title.'</a></h1></header></div>';
			    					

			    				}
			    				if($showtext == "1") {

			    					$html .= '<div class="shortDesc"> <p>'.$body.'</p></div>';

			    				}

			    	$html 	.= '</article>';

				    $html .= '</div>';

				    if($ic == $col || $ic % $col == 0) {
                    	$html .= '</li><li class="row blog_pannel">';
			        }
			        $ic++;
			        $i++;



				}
				$html .= '</ul>'; 
			$html .= '</div></br>';
			if( !empty($listType) && $listType == 'List'){
				$pagination->render();
			}
			
			return $html;

		}

	    
}
