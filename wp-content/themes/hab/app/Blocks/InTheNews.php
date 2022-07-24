<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class InTheNews extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'In The News';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple In The News block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'hab-blocks';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'share-alt';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = ['page'];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'items' => [
            ['item' => 'Item one'],
            ['item' => 'Item two'],
            ['item' => 'Item three'],
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'data' => $this->get_post_data(),
            'hasData' => $this->has_data(),
            'cols' => $this->get_cols(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $inTheNews = new FieldsBuilder('in_the_news');

        $inTheNews
            ->addSelect('re_items', [
                'label' => 'how many items',
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ]
            ])
            ->addSelect('re_order', [
                'label' => 'Sort',
                'choices' => [
                    'ASC' => 'Ascending',
                    'DESC' => 'Descending'
                ]
            ])
            ->addSelect('re_orderby', [
                'label' => 'Order by',
                'choices' => [
                    'date' => 'Date',
                    'title' => 'Title',
                    'rand' => 'Random'
                ]
                ]);
        return $inTheNews->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
    }

    /**
     * Get number of items to display
     */
    public function get_cols() {
        if('4'== get_field('re_items')) {
            return "row-cols-md-2 row-cols-lg-4";
        }
        return "row-cols-md-2 row-cols-lg-3";
    }

     /**
     * Return the items field.
     *
     * @return array
     */
    public function get_post_data() {
        $items = get_field('re_items');
        $order = get_field('re_order');
        $orderby = get_field('re_orderby');
         
        $args = array(
             'post_type' => 'resource',
             'post_status' => 'publish',
             'posts_per_page' => $items,
             'order' => $order,
             'orderby' => $orderby,

         );
 
         array_push($args);
 
         
         return collect(
             get_posts( $args )
         )->map(function ($data) {
             return (object) [
                 'id' => $data->ID,
                 'title' => get_the_title($data->ID),
                 'url' => get_the_permalink($data->ID),
                 'resource_image' => get_the_post_thumbnail_url($data->ID,'full'),
                 'pdf_file' => get_field('resource_pdf_file',$data->ID),
                 'news_article' => get_field('resource_news_url',$data->ID),
                 'video_url' => get_post_meta($data->ID,'resource_video_url',true),
                 'summary' => get_the_excerpt($data->ID),
                 'link' => $this->create_link($data->ID),
             ];
         })->filter();
     }

     /** 
      * Create a useful and meaning full link for the resources
      * @return string
     */
     public function create_link($id) {
        if(get_field('resource_pdf_file',$id)) {
            $link_text = "Download the PDF";
            $link = get_field('resource_pdf_file',$id)['url'];
        } elseif(get_field('resource_news_url',$id)) {
            $link_text = "Read the Article";
            $link = get_field('resource_news_url',$id);
        } elseif(get_field('resource_video_url',$id)) {
            $link_text = "Watch the video";
            $link = get_field('resource_video_url',$id);
        } else {
            return false;
        }
        return "<a href='". $link . "' targe='_blank' class=''>".$link_text."</a>";
     }

     /** 
     * Check if data is present
    */
    public function has_data() {
        $data = $this->get_post_data();

        if (0 === count($data)) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
