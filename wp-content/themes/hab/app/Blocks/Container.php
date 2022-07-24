<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Blocks\Partials\BackgroundDesktop;
use App\Blocks\Partials\BackgroundTablet;
use App\Blocks\Partials\BackgroundMobile;
use App\Blocks\Partials\SpacingDesktop;
use App\Blocks\Partials\SpacingTablet;
use App\Blocks\Partials\SpacingMobile;

class Container extends Block {
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Container';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A general container.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'layout';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = ['layout', 'container', 'section'];

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
            'name' => 'default',
            'label' => 'Default',
            'isDefault' => true
        ],
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
    public $example = [];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with() {
        return [
            'block_id' => $this->block->id,
            'container_size' => $this->container_size(),
            'max_width' => $this->max_width(),
            'tag' => get_field('container_tag'),
            'bg_image' => $this->bg_image(),
            'bg_color' => $this->bg_color(),
            'bg_style_desktop' => $this->get_bg_style('desktop'),
            'bg_style_tablet' => $this->get_bg_style('tablet'),
            'bg_style_mobile' => $this->get_bg_style('mobile'),
            'alignment_desktop' => get_field('alignment_desktop'),
            'alignment_tablet' => get_field('alignment_tablet'),
            'alignment_mobile' => get_field('alignment_mobile'),
            'spacing_desktop' => $this->get_spacing('desktop'),
            'spacing_tablet' => $this->get_spacing('tablet'),
            'spacing_mobile' => $this->get_spacing('mobile'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields() {
        $container = new FieldsBuilder('container');

        $container
            ->addRadio('container_size', [
                'label' => 'Container Size',
                'choices' => [
                    'bg-default-width' => 'Default',
                    'bg-full-width' => 'Full-width'
                ],
                'default_value' => [
                    'bg-default-width'
                ],
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addSelect('container_tag', [
                'label' => 'Container Tag',
                'choices' => [
                        'section',
                        'div',
                    ],
                'default_value' => ['section'],
                'required' => 1,
                'allow_null' => 0,
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addTrueFalse('use_custom_width', [
                'label' => 'Use a custom inner width?',
                'wrapper' => [
                    'width' => '25',
                ],
            ])
            ->addNumber('max_width', [
                'label' => 'Max-width',
                'instructions' => 'Set in px',
                'min' => 0,
                'wrapper' => [
                    'width' => '25',
                ],
                'conditional_logic' => [
                    [
                        'field' => 'use_custom_width',
                        'operator' => '==',
                        'value' => '1'
                    ]
                ]
            ])
            ->addImage('bg_img', [
                'label' => 'Background Image',
                'return_format' => 'url',
                'wrapper' => [
                    'width' => '100',
                ],
            ])
            ->addColorPicker('bg_color', [
                'label' => "Background color"
            ])
            ->addTab('Desktop')
                ->addFields($this->get(BackgroundDesktop::class))
                ->addButtonGroup('alignment_desktop', [
                    'label' => 'Alignment',
                    'wrapper' => [
                        'width' => '100',
                    ],
                    'choices' => [
                        'left' => '<i class="dashicons dashicons-editor-alignleft"></i>',
                        'center' => '<i class="dashicons dashicons-editor-aligncenter"></i>',
                        'right' => '<i class="dashicons dashicons-editor-alignright"></i>',
                    ],
                    'default_value' => 'left',
                ])
                ->addFields($this->get(SpacingDesktop::class))
            ->addTab('Tablet')
                ->addFields($this->get(BackgroundTablet::class))
                ->addButtonGroup('alignment_tablet', [
                    'label' => 'Alignment',
                    'wrapper' => [
                        'width' => '100',
                    ],
                    'choices' => [
                        'left' => '<i class="dashicons dashicons-editor-alignleft"></i>',
                        'center' => '<i class="dashicons dashicons-editor-aligncenter"></i>',
                        'right' => '<i class="dashicons dashicons-editor-alignright"></i>',
                    ],
                    'default_value' => 'left',
                ])
                ->addFields($this->get(SpacingTablet::class))
            ->addTab('Mobile')
                ->addFields($this->get(BackgroundMobile::class))
                ->addButtonGroup('alignment_mobile', [
                    'label' => 'Alignment',
                    'wrapper' => [
                        'width' => '100',
                    ],
                    'choices' => [
                        'left' => '<i class="dashicons dashicons-editor-alignleft"></i>',
                        'center' => '<i class="dashicons dashicons-editor-aligncenter"></i>',
                        'right' => '<i class="dashicons dashicons-editor-alignright"></i>',
                    ],
                    'default_value' => 'left',
                    'allow_null' => 1,
                ])
                ->addFields($this->get(SpacingMobile::class));

        return $container->build();
    }

    /**
     * Return the container size.
     *
     * @return array
     */
    public function container_size() {
        return get_field('container_size');
    }

    /**
     * Return the max-width.
     *
     * @return array
     */
    public function max_width() {
        return get_field('max_width') ? 'max-width: ' . get_field('max_width') . 'px;' : null;
    }

    /**
     * Return the background color.
     *
     * @return string
     */
    public function bg_color() {
        return get_field('bg_color') ? 'background-color:' . get_field('bg_color') . ';' : null;
    }


    /**
     * Return the background image.
     *
     * @return array
     */
    public function bg_image() {
        return get_field('bg_img') ? 'background-image:url(' . esc_attr(get_field('bg_img')) . ');' : null;
    }

    /**
     * Return the background style.
     *
     * @return array
     */
    public function get_bg_style($screensize) {
        $style = [];
        $group = 'bg_group_' . $screensize;

        if (get_field($group .'_bg_size')) $style[] = 'background-size:' . get_field($group .'_bg_size');

        if (get_field($group .'_bg_x') || get_field($group .'_bg_x') === '0') $style[] = 'background-position-x:' . get_field($group .'_bg_x') . '%';
        if (get_field($group .'_bg_y') || get_field($group .'_bg_y') === '0') $style[] = 'background-position-y:' . get_field($group .'_bg_y') . '%';

        if(!empty($style)){
            return join(';'.PHP_EOL, $style) . ';';
        };
    }

    /**
     * Return the spacing values.
     *
     * @return array
     */
    public function get_spacing($screensize) {
        $spacing = [];
        $group = 'spacing_group_' . $screensize;

        if (get_field($group .'_padding_top_value') || get_field($group . '_padding_top_value') === '0') {
            $spacing[] = 'padding-top:' . get_field($group . '_padding_top_value') . get_field($group . '_padding_top_unit');
        }
        if (get_field($group . '_padding_bottom_value') || get_field($group . '_padding_bottom_value') === '0') {
            $spacing[] = 'padding-bottom:' . get_field($group . '_padding_bottom_value') . get_field($group . '_padding_bottom_unit');
        }
        if (get_field($group . '_padding_left_value') || get_field($group . '_padding_left_value') === '0') {
            $spacing[] = 'padding-left:' . get_field($group . '_padding_left_value') . get_field($group . '_padding_left_unit');
        }
        if (get_field($group . '_padding_right_value') || get_field($group . '_padding_right_value') === '0') {
            $spacing[] = 'padding-right:' . get_field($group . '_padding_right_value') . get_field($group . '_padding_right_unit');
        }

        if (get_field($group . '_margin_top_unit') == 'auto') {
            $spacing[] = 'margin-top: auto';
        } elseif (get_field($group . '_margin_top_value') || get_field($group . '_margin_top_value') === '0') {
            $spacing[] = 'margin-top:' . get_field($group . '_margin_top_value') . get_field($group . '_margin_top_unit');
        }
        if (get_field($group . '_margin_bottom_unit') == 'auto') {
            $spacing[] = 'margin-bottom: auto';
        } elseif (get_field($group . '_margin_bottom_value') || get_field($group . '_margin_bottom_value') === '0') {
            $spacing[] = 'margin-bottom:' . get_field($group . '_margin_bottom_value') . get_field($group . '_margin_bottom_unit');
        }
        if (get_field($group . '_margin_left_unit') == 'auto') {
            $spacing[] = 'margin-left: auto';
        } elseif (get_field($group . '_margin_left_value') || get_field($group . '_margin_left_value') === '0') {
            $spacing[] = 'margin-left:' . get_field($group . '_margin_left_value') . get_field($group . '_margin_left_unit');
        }
        if (get_field($group . '_margin_right_unit') == 'auto') {
            $spacing[] = 'margin-right: auto';
        } elseif (get_field($group . '_margin_right_value') || get_field($group . '_margin_right_value') === '0') {
            $spacing[] = 'margin-right:' . get_field($group . '_margin_right_value') . get_field($group . '_margin_right_unit');
        }

        if(!empty($spacing)){
            return join(';'.PHP_EOL, $spacing) . ';';
        };
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue() {
    }
}
