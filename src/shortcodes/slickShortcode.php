<?php 
namespace giorgiosaud\slickwp\shortcodes;
use giorgiosaud\slickwp\Singleton;
class slickShortcode extends Singleton{
	protected $posts=array();
	protected $view;
	public function __construct()
	{
		add_shortcode('slickwp',array($this,'execute'));
	}
	public function execute($atts){
		$atts = shortcode_atts(
			array(
				'post_type' => 'paquetes',
				'category' => 'activo',
				'qty'=>'10',
				'id'=>'identificador'
			), $atts, 'slickwp' );
		$this->getPosts($atts);
		$this->prepareView($atts['id'],$atts['category']);

		
		return $this->view;
	}
	protected function prepareView($id,$cat){
		$html="<div class='carousel $cat'  id='$id'>";
		foreach ($this->posts as $post) {
			$html.='<div class="carousel_slide">';
				$html.='<div class="carousel_container">';
						$html.='<div class="carousel_image">';
							$html.=$post['image'];
						$html.='</div>';
						$html.='<div class="carousel_text">';
							$html.='<div class="carousel_title">';
								$html.=$post['title'];
							$html.='</div>';
							$html.='<div class="carousel_subTitle">';
								$html.=$post['short_description'];
							$html.='</div>';
						$html.='</div>';
				$html.='</div>';
				$ref=$post['link'];
				$html.="<a class='button_carousel' href='$ref' target='_self'><span class='fusion-button-text'>Ver más</span></a>";
			$html.='</div>';

		}
		$html.='</div>';
		$html.='<script >';
		$html.='</script>';
		$this->view=$html;
		// return;
	}
	protected function getPosts($atts){
			/*
			 * The WordPress Query class.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/WP_Query
			 \*/
			$args = array(
				
				// Post & Page Parameters
				// 'p'            => 1,
				// 'name'         => 'hello-world',
				// 'page_id'      => 1,
				// 'pagename'     => 'sample-page',
				// 'post_parent'  => 1,
				// 'post__in'     => array( 1, 2, 3 ),
				// 'post__not_in' => array( 1, 2, 3 ),
		
				// Author Parameters
				// 'author'      => '1,2,3',
				// 'author_name' => 'admin',
		
				// Category Parameters
				// 'cat'              => 1,
				'category_name'    => $atts['category'],
				// 'category__and'    => array( 1, 2 ),
				// 'category__in'     => array( 1, 2 ),
				// 'category__not_in' => array( 1, 2 ),
		
				// Type & Status Parameters
				'post_type'   => $atts['post_type'],
				'post_status' => 'published',
		
				// Choose ^ 'any' or from below, since 'any' cannot be in an array
				// 'post_type' => array(
					// 'post',
					// 'page',
					// 'revision',
					// 'attachment',
					// 'my-post-type',
				// ),
		
				// 'post_status' => array(
				// 	'publish',
				// 	'pending',
				// 	'draft',
				// 	'auto-draft',
				// 	'future',
				// 	'private',
				// 	'inherit',
				// 	'trash',
				// ),
		
				// Order & Orderby Parameters
				// 'order'               => 'DESC',
				// 'orderby'             => 'date',
				// 'ignore_sticky_posts' => false,
				// 'year'                => 2012,
				// 'monthnum'            => 1,
				// 'w'                   => 1,
				// 'day'                 => 1,
				// 'hour'                => 12,
				// 'minute'              => 5,
				// 'second'              => 30,
		
				// Tag Parameters
				// 'tag'           => 'cooking',
				// 'tag_id'        => 5,
				// 'tag__and'      => array( 1, 2 ),
				// 'tag__in'       => array( 1, 2 ),
				// 'tag__not_in'   => array( 1, 2 ),
				// 'tag_slug__and' => array( 'red', 'blue' ),
				// 'tag_slug__in'  => array( 'red', 'blue' ),
		
				// Pagination Parameters
				'posts_per_page'         => $atts['qty'],
				// 'posts_per_archive_page' => 10,
				// 'nopaging'               => false,
				// 'paged'                  => get_query_var( 'paged' ),
				// 'offset'                 => 3,
		
				// Custom Field Parameters
				// 'meta_key'       => 'key',
				// 'meta_value'     => 'value',
				// 'meta_value_num' => 10,
				// 'meta_compare'   => '=',
				// 'meta_query'     => array(
				// 	array(
				// 		'key'     => 'color',
				// 		'value'   => 'blue',
				// 		'type'    => 'CHAR',
				// 		'compare' => '=',
				// 	),
				// 	array(
				// 		'key'     => 'price',
				// 		'value'   => array( 1,200 ),
				// 		'compare' => 'NOT LIKE',
				// 	),
				// ),
		
				// Taxonomy Parameters
				// 'tax_query' => array(
				// 	'relation' => 'AND',
				// 	array(
				// 		'taxonomy'         => 'color',
				// 		'field'            => 'slug',
				// 		'terms'            => array( 'red', 'blue' ),
				// 		'include_children' => true,
				// 		'operator'         => 'IN',
				// 	),
				// 	array(
				// 		'taxonomy'         => 'actor',
				// 		'field'            => 'id',
				// 		'terms'            => array( 1, 2, 3 ),
				// 		'include_children' => false,
				// 		'operator'         => 'NOT IN',
				// 	)
				// ),
		
				// Permission Parameters -
				// 'perm' => 'readable',
		
				// Parameters relating to caching
				// 'no_found_rows'          => false,
				// 'cache_results'          => true,
				// 'update_post_term_cache' => true,
				// 'update_post_meta_cache' => true,
		
			);
		var_dump($args);
		wp_reset_query();
		$query = new \WP_Query( $args );
		while ($query->have_posts() ) : $query->the_post();
			$post=array();
			$post['title']=get_the_title();
			$post['image']= wp_get_attachment_image( get_post_meta( get_the_ID(), 'image_carousel_id', 1 ), 'carousel' );
			$post['short_description'] = get_post_meta( get_the_ID(), 'short_description', true );
			$post['link']=get_permalink( get_the_ID() );

			array_push($this->posts,$post);
		endwhile;
		wp_reset_query();
	}
}

