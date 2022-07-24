<?php

namespace SJZ\SiteFeature;

//  If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

require_once plugin_dir_path(__FILE__) . 'class-site-features-cpt-parent.php';
use StoutLogic\AcfBuilder\FieldsBuilder;

class Resource extends \SJZ\SiteFeature\CustomPostType {
  protected $slug = 'resource';
  protected $plural_slug = 'resources';
  protected $featured_name = 'Resource Image';
  protected $new_title = 'Headline';

  protected $field_group_callbacks = [
      'acf_resource'
  ];

  protected $taxonomies = [
    'resource_type' => [
    'slug'  => 'resource-type',
    'plural_name' => 'Resource Types',
    'singular_name' => 'Resource Type',
    ]
  ];

  // protected $tax_cap_manage_terms = "";
  // protected $tax_cap_edit_terms = "";
  // protected $tax_cap_delete_terms = "";
  // protected $tax_cap_assign_terms = "edit_posts";

  protected function init() {
    //actions to run on both backend and front end
    add_action('init', function(){
        $this->cpt_args['show_in_admin_bar'] = true;       
        $this->cpt_args['menu_icon'] = 'data:image/svg+xml;base64,' . base64_encode('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M7.5 11c1.381 0 2.5-1.119 2.5-2.5v-6c0-1.381-1.119-2.5-2.5-2.5s-2.5 1.119-2.5 2.5v6c0 1.381 1.119 2.5 2.5 2.5zM11 7v1.5c0 1.933-1.567 3.5-3.5 3.5s-3.5-1.567-3.5-3.5v-1.5h-1v1.5c0 2.316 1.75 4.223 4 4.472v2.028h-2v1h5v-1h-2v-2.028c2.25-0.249 4-2.156 4-4.472v-1.5h-1z"></path></svg>');
        $this->cpt_args['supports'] = array('title', 
                        'editor',
                        'thumbnail', 
                        'revisions',
                        'excerpt');
        $this->cpt_args['exclude_from_search'] = false;
        $this->cpt_args['rewrite'] = array(
            'slug' => $this->slug,
            'with_front' => false,
        );               
        $this->post_type_register();
    });

    // register taxonomies
    add_action('init', function (){
      $resource_type_args = $this->cpt_taxonomy_args['resource_type'];
      $resource_type_args['query_var'] = 'resource-type';
      $resource_type_args['show_admin_column'] = true;
      $resource_type_args['rewrite'] = false;
      $resource_type_args['hierarchical'] = false;

      $this->add_taxonomy($this->taxonomies['resource_type']['slug'], $resource_type_args);
    });

    //backend-only actions
    if( is_admin() ){
        add_action( 'manage_resource_posts_custom_column', [$this,'populate_column'], 10, 2 );
        add_filter( 'manage_resource_posts_columns', [$this,'filter_posts_columns'] );
        add_action( 'admin_head', [$this, 'custom_admin_head'] );
        add_filter( 'enter_title_here', [$this, 'change_title_text'] );
    }
  }

    /**
      * Set ACF Fields
    **/

    protected function acf_resource(){
      $field = new FieldsBuilder($this->prefix . 'resource');
      $field
          ->setGroupConfig('title', 'Resource')
          ->setGroupConfig('position', 'side')
          ->setGroupConfig('description', 'Please fill in only the fields that are corrosponding with the selected type')
          ->addSelect('resource_type', [
            'label' => 'Resource type',
            'choices' => [
              'pdf' => 'PDF File',
              'link' => 'Link to News Article',
              'video' => 'Link to Video'
            ],
          ])
          ->addFile('resource_pdf_file')
            ->setLabel('PDF File')
            ->conditional('resource_type', '==', 'pdf')
          ->addUrl('resource_news_url')
            ->setLabel('URL to News Article')
            ->conditional('resource_type', '==', 'link')
          ->addUrl('resource_video_url')
            ->setLabel('URL to Video')
            ->conditional('resource_type', '==', 'video')  
   
          ->setLocation('post_type', '==', $this->slug);
          

      return $field;
  }

  /** 
    * Change column width on List display
    */
    public function custom_admin_head() {
      global $post_type;
      if ( $this->slug == $post_type ) {
          echo '<style type="text/css"> .column-image { width: 200px; } </style>';
      }
    }

  /** 
  * Change the default "Add title"
  */
  public function change_title_text( $title ){
      $screen = get_current_screen();
   
      if  ( $this->slug == $screen->post_type ) {
           $title = $this->new_title;
      }
   
      return $title;
  }

    /**
    * Populating the custom columns
    */
    public function populate_column($column, $post_id ){
      if('image' === $column) {
          echo get_the_post_thumbnail( $post_id, array('80', '80'));
      }
    }

    /** 
     * Modify Admin Column Listing
     * Setting / Re-ordering the columns
    */
    public function filter_posts_columns($columns){
      $columns = array(
          'cb'                            => $columns['cb'],
          'image'                         => __( 'Resource Image' ),
          'title'                         => __( 'Title' ),
          'taxonomy-resource-type'        => __('Resource Type'),
          'date'                          => $columns['date'],

      );
      return $columns;
  }
    
}