<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Banner extends Block {
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Banner';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Banner block.';

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
    public $icon = 'table-col-after';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = ['banner', 'hero'];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

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
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        [
            'name' => 'light',
            'label' => 'Light',
        ],
        [
            'name' => 'dark',
            'label' => 'Dark',
        ]
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'h1' => 'A powerful <strong>Banner</strong> can work wonders',
        'desc'  => 'This will make your site stand out form all the others in a very subtle way.'
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with() {
        return [
            'h1' => $this->h1(),
            'desc' => $this->desc(),
            'style' => $this->style(),
            'bgimg' => get_field('bgimg'),
            // 'swoop' => get_field('swoop') ?: false,
            'title' => get_the_title(),
            // 'submenu' => $this->submenu_navigation(),
            'title_max' => get_field('title_maxwidth'),
            'desc_max' => get_field('desc_maxwidth'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields() {
        $banner = new FieldsBuilder('banner');

        $banner
            ->addText('h1', [
                'label' => 'Title',
                'instructions'  => 'To make green text, wrap in strong tag'
            ])
            ->addNumber('title_maxwidth', [
                'label' => 'Custom title max-width',
                'instructions' => 'Defaults to column width.',
            ])
            ->addTextarea('desc', ['label' => 'Description'])
            ->addNumber('desc_maxwidth', [
                'label' => 'Custom description max-width',
                'instructions' => 'Defaults to column width.',
            ])
            ->addImage('bgimg', [
                'label' => 'Background Image',
                'return_format' => 'url'
            ])
            ->setWidth('75')
            // ->addTrueFalse('swoop', ['label' => 'Add swoop?'])
            // ->setWidth('25')
            ->addNumber('bg-x', [
                'label' => 'Background X Position',
                'min'   => 0,
                'max'   => 100,
                'conditional_logic' => [
                    [
                        'field' => 'swoop',
                        'operator' => '==',
                        'value' => '0'
                    ]
                ]
            ])
            ->setWidth('50')
            ->addNumber('bg-y', [
                'label' => 'Background Y Position',
                'min'   => 0,
                'max'   => 100,
                'conditional_logic' => [
                    [
                        'field' => 'swoop',
                        'operator' => '==',
                        'value' => '0'
                    ]
                ]
            ])
            ->setWidth('50');
            // ->addField('menu', 'nav_menu', [
            //     'label' => 'Submenu',
            //     'allow_null' => 1,
            // ]);

        return $banner->build();
    }

    /**
     * Return the h1 field.
     *
     * @return array
     */
    public function h1() {
        $val = get_field('h1');
        return strip_tags($val, array('<strong>', '<br>')) ?: $this->example['h1'];
    }

    /**
     * Return the desc field.
     *
     * @return array
     */
    public function desc() {
        return get_field('desc') ?: $this->example['desc'];
    }

    public function style() {
        $style = array();
        $bgimg = get_field('bgimg');
        // $swoop = get_field('swoop');
        $swoop = "";
        if ($bgimg) {
            array_push($style, 'background-image:url(' . esc_attr($bgimg) . ')');
        }
        if ( !$swoop && ( get_field('bg-x') || get_field('bg-x') === '0') ) {
            array_push($style, 'background-position-x:' . esc_attr(get_field('bg-x')) . '%');
        }
        if ( !$swoop && ( get_field('bg-y') || get_field('bg-y') === '0') ) {
            array_push($style, 'background-position-y:' . esc_attr(get_field('bg-y')) . '%');
        }

        return join(";", $style) . ';';
    }

    /**
     * Submenu arguments
     * @return array
     */
    public function submenu_navigation() {
        $menu = get_field('menu') ?: false;
        if ($menu) {
            $args = [
                'menu' => $menu,
                'menu_id' => 'banner_menu',
                'menu_class' => 'banner-menu dropdown-menu',
                'container' => false,
                'depth' => 1,
                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                'walker' => new \App\WPBootstrap5Navwalker()
            ];
            return $args;
        }
    }


    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue() {
        //
    }
}
