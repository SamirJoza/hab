<?php

namespace SJZ\SiteFeature;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class CustomPostType { 
    
    protected $prefix;
    protected $textdomain;

    protected $slug;
    protected $plural_slug;
    protected $taxonomies; 

    protected $cpt_args, $cpt_taxonomy_args;
    protected $field_group_callbacks = [];

    protected $tax_cap_manage_terms = "manage_categories";
    protected $tax_cap_edit_terms = "manage_categories";
    protected $tax_cap_delete_terms = "manage_categories";
    protected $tax_cap_assign_terms = "edit_posts";

    protected $singular_name;
    protected $plural_name;
    protected $featured_name = 'Featured image';

    public function __construct($prefix, $textdomain) {
        $this->prefix = $prefix . $this->slug . '_';
        $this->$textdomain = $textdomain;

        $this->set_names();
        $this->set_cpt_args();

        if(!empty($this->taxonomies)){
            foreach($this->taxonomies as $key => $taxonomy){
                $taxonomy['key'] = $key;
                $this->set_cpt_taxonomy_args($taxonomy);
            }
        }

        $this->init();

        if(!empty($this->field_group_callbacks) && is_array($this->field_group_callbacks)){
            add_action( 'acf/init', [$this, 'acf_config'] );
        }

        add_filter('post_updated_messages', [$this, 'update_messages']);
        if(!empty($this->taxonomies)){
            add_filter('term_updated_messages', [$this, 'add_taxonomy_messages']);
        }
        
    }

    private function set_names(){
        $this->singular_name = !empty($this->singular_name) ? $this->singular_name : ucwords(str_replace("-"," ",$this->slug));
        $this->plural_name = !empty($this->plural_name) ? $this->plural_name : ucwords(str_replace("-"," ",$this->plural_slug));
    }

    private function set_cpt_args(){
        
        $labels = [
            'name'                  => _x( $this->plural_name, 'Post Type General Name', $this->textdomain ),
            'singular_name'         => _x( $this->singular_name, 'Post Type Singular Name', $this->textdomain ),
            'menu_name'             => __( $this->plural_name, $this->textdomain ),
            'name_admin_bar'        => __( $this->plural_name, $this->textdomain ),
            'archives'              => __( sprintf("%s Archives", $this->singular_name), $this->textdomain ),
            'attributes'            => __( sprintf("%s Attributes", $this->singular_name), $this->textdomain ),
            'parent_item_colon'     => __( sprintf("Parent %s:", $this->singular_name), $this->textdomain ),
            'all_items'             => __( sprintf("All %s", $this->plural_name), $this->textdomain ),
            'add_new_item'          => __( sprintf("Add New %s", $this->singular_name), $this->textdomain ),
            'add_new'               => __( sprintf("Add %s", $this->singular_name), $this->textdomain ),
            'new_item'              => __( sprintf("New %s", $this->singular_name), $this->textdomain ),
            'edit_item'             => __( sprintf("Edit %s", $this->singular_name), $this->textdomain ),
            'update_item'           => __( sprintf("Update %s", $this->singular_name), $this->textdomain ),
            'view_item'             => __( sprintf("View %s", $this->singular_name), $this->textdomain ),
            'view_items'            => __( sprintf("View %s", $this->plural_name), $this->textdomain ),
            'search_items'          => __( sprintf("Search %s", $this->singular_name), $this->textdomain ),
            'not_found'             => __( 'Not found', $this->textdomain ),
            'not_found_in_trash'    => __( 'Not found in Trash', $this->textdomain ),
            'featured_image'        => __( $this->featured_name, $this->textdomain ),
            'set_featured_image'    => __( sprintf("Set %s",$this->featured_name), $this->textdomain ),
            'remove_featured_image' => __( sprintf("Remove %s",$this->featured_name), $this->textdomain ),
            'use_featured_image'    => __( sprintf("Use as %s",$this->featured_name), $this->textdomain ),
            'insert_into_item'      => __( sprintf("Insert into %s", $this->slug), $this->textdomain ),
            'uploaded_to_this_item' => __( sprintf("Uploaded to this %s", $this->slug), $this->textdomain ),
            'items_list'            => __( sprintf("%s list", $this->singular_name), $this->textdomain ),
            'items_list_navigation' => __( sprintf("%s list navigation", $this->singular_name), $this->textdomain ),
            'filter_items_list'     => __( sprintf("Filter %s list", $this->singular_name), $this->textdomain ),
        ];

        $supports = [
                'title', 
                'thumbnail', 
                'revisions', 
                'custom-fields',
        ];

        $rewrite = [
            'with_front' => false,
        ];

        $this->cpt_args = [
            'labels'                    => $labels,
            'supports'                  => $supports,
            'menu_icon'                 => 'dashicons-media-text', // <-- Options here: https://developer.wordpress.org/resource/dashicons or you can add your own svg
            'hierarchical'              => true,
            'public'                    => true,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'menu_position'             => 5,
            'show_in_admin_bar'         => false,
            'show_in_nav_menus'         => true,
            'can_export'                => true,
            'has_archive'               => false,
            'exclude_from_search'       => true,
            'publicly_queryable'        => true,
            'capability_type'           => 'page',
            'show_in_rest'              => true,
            'rewrite'                   => $rewrite
        ];
    }

    private function set_cpt_taxonomy_args($taxonomy){
        $labels = [
            'name'                       => _x($taxonomy['singular_name'], 'Taxonomy General Name', $this->textdomain),
            'singular_name'              => _x($taxonomy['singular_name'], 'Taxonomy Singular Name', $this->textdomain),
            'menu_name'                  => __($taxonomy['plural_name'], $this->textdomain),
            'all_items'                  => __($taxonomy['plural_name'], $this->textdomain),
            'parent_item'                => __("Parent {$taxonomy['singular_name']}" , $this->textdomain),
            'parent_item_colon'          => __("Parent {$taxonomy['singular_name']}", $this->textdomain),
            'new_item_name'              => __("New {$taxonomy['singular_name']}", $this->textdomain),
            'add_new_item'               => __("Add New {$taxonomy['singular_name']}", $this->textdomain),
            'edit_item'                  => __("Edit {$taxonomy['singular_name']}", $this->textdomain),
            'update_item'                => __("Update {$taxonomy['singular_name']}", $this->textdomain),
            'view_item'                  => __("View {$taxonomy['singular_name']}", $this->textdomain),
            'separate_items_with_commas' => __("Separate {$taxonomy['plural_name']} with commas", $this->textdomain),
            'add_or_remove_items'        => __("Add or remove {$taxonomy['singular_name']}", $this->textdomain),
            'choose_from_most_used'      => __('Choose from the most used', $this->textdomain),
            'popular_items'              => __("Popular {$taxonomy['plural_name']}", $this->textdomain),
            'search_items'               => __("Search {$taxonomy['plural_name']}", $this->textdomain),
            'not_found'                  => __('Not Found', $this->textdomain),
        ];

        $this->cpt_taxonomy_args[$taxonomy['key']] = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'show_admin_column' => false,
            'show_tagcloud'     => false,
            'rewrite' => array(
                'slug' => $this->plural_slug,
                'with_front' => false,
            ),
            'show_in_rest'    => true,
            'capabilities' => array(
                'manage_terms' => $this->tax_cap_manage_terms,
                'edit_terms' => $this->tax_cap_edit_terms,
                'delete_terms' => $this->tax_cap_delete_terms,
                'assign_terms' => $this->tax_cap_assign_terms
              ),
        ];
    }
    
    protected function init(){
        //Left blank empty, it is mean to be overwritten by child classes 
    }


    /**
     * Register the post type
     */
    protected function post_type_register() {
        register_post_type($this->slug, $this->cpt_args);
    }

    /**
     * Sets the post updated messages for the post type
     *
     * @param array $messages Post updated messages.
     * @return array
     */
    public function update_messages($messages) {

        global $post;

        $permalink = get_permalink($post);
        $slug = $this->slug;
        $textdomain = $this->textdomain;

        $messages[$slug] = array(
            0  => '', // Unused. Messages start at index 1.
            /* translators: %s: post permalink */
            1  => sprintf(__( $this->singular_name . ' updated. <a target="_blank" href="%s">View ' . $this->singular_name . '</a>', $textdomain), esc_url($permalink)),
            2  => __('Custom field updated.', $textdomain),
            3  => __('Custom field deleted.', $textdomain),
            4  => __( $this->singular_name . ' updated.', $textdomain),
            /* translators: %s: date and time of the revision */
            5  => isset($_GET['revision']) ? sprintf(__( $this->singular_name . ' restored to revision from %s', $textdomain), wp_post_revision_title((int) $_GET['revision'], false)) : false,
            /* translators: %s: post permalink */
            6  => sprintf(__( $this->singular_name . ' published. <a href="%s">View ' . $this->singular_name . '</a>', $textdomain), esc_url($permalink)),
            7  => __( $this->singular_name . ' saved.', $textdomain),
            /* translators: %s: post permalink */
            8  => sprintf(__( $this->singular_name . ' submitted. <a target="_blank" href="%s">Preview ' . $this->singular_name . '</a>', $textdomain), esc_url(add_query_arg('preview', 'true', $permalink))),
            /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
            9  => sprintf(
                __( $this->singular_name . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . $this->singular_name . '</a>', $textdomain),
                date_i18n(__('M j, Y @ G:i', $textdomain), strtotime($post->post_date)),
                esc_url($permalink)
            ),
            /* translators: %s: post permalink */
            10 => sprintf(__( $this->singular_name . ' draft updated. <a target="_blank" href="%s">Preview ' . $this->singular_name . '</a>', $textdomain), esc_url(add_query_arg('preview', 'true', $permalink))),
        );

        return $messages;
    }


    protected function add_taxonomy($taxonomy_name, $args) {
        register_taxonomy($taxonomy_name, $this->slug, $args);
    }


    /**
     * Sets the post updated messages for taxonomies
     */
    public function add_taxonomy_messages($messages) {

        foreach($this->taxonomies as $taxonomy){
            $messages[$taxonomy['slug']] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __($taxonomy['singular_name'] . ' added.', $this->textdomain),
                2 => __($taxonomy['singular_name'] . ' deleted.', $this->textdomain),
                3 => __($taxonomy['singular_name'] . ' updated.', $this->textdomain),
                4 => __($taxonomy['singular_name'] . ' not added.', $this->textdomain),
                5 => __($taxonomy['singular_name'] . ' not updated.', $this->textdomain),
                6 => __($taxonomy['plural_name'] . ' deleted.', $this->textdomain),
            );
        }
        return $messages;
    }

    /**
     * Register ACF metaboxes and fields
     */
    public function acf_config() {
        if (function_exists('acf_add_local_field_group')) {
            foreach($this->field_group_callbacks as $callback){
                acf_add_local_field_group($this->$callback()->build());
            }
        }
    }

}
