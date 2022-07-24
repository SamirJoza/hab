<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ThemeSettings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Theme Settings';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Theme Settings | Options';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $themeSettings = new FieldsBuilder('theme_settings');

        $themeSettings
            ->addTab('Address')
            ->addText('op_street',[
                'label' => 'Street',
                'wrapper' => [
                    'width' => '50'
                ]
            ])
            ->addText('op_unit',[
                'label' => 'Unit / PO Box Number / Suite',
                'wrapper' => [
                    'width' => '50'
                ]
            ])
            ->addText('op_city',[
                'label' => 'City',
                'wrapper' => [
                    'width' => '30'
                ]
            ])
            ->addText('op_state',[
                'label' => 'State',
                'wrapper' => [
                    'width' => '20'
                ]
            ])
            ->addText('op_zip',[
                'label' => 'Zip / Postal Code',
                'wrapper' => [
                    'width' => '10'
                ]
            ])
            ->addText('op_phone',[
                'label' => 'Phone',
                'wrapper' => [
                    'width' => '20'
                ]
            ])
            ->addText('op_email',[
                'label' => 'Email',
                'wrapper' => [
                    'width' => '20'
                ]
            ])
            ->addTab('Social')
            ->addRepeater('op_socials',[
                'label' => '',
                'button_label' => 'Add Social Network'
            ])
                ->addSelect('op_social_network',[
                    'label' => 'Network',
                    'wrapper' => [
                        'width' => '50'
                    ],
                    'choices' => [
                        'fb' => 'Facebook',
                        'tw' => 'Twitter',
                        'ig' => 'Instagram',
                        'li' => 'LinkedIn',
                        'sn' => 'SnapChat',
                        'tt' => 'TikTok',
                        'yt' => 'Youtube'
                    ],
                    'ui' => 0,
                    'placeholder' => 'Please select',
                ])
                ->addUrl('op_social_url', [
                    'label' => 'URL',
                    'wrapper' => [
                        'width' => '50'
                    ]
                ])
            ->endRepeater()
            ->addTab('Footer Buttons')
            ->addRepeater('op_footer_buttons',[
                'label' => '',
                'button_label' => 'Add Footer Button',
                'max' => 2
            ])
            ->addSelect('op_button_type',[
                'label' => 'Button Type',
                'wrapper' => [
                    'width' => '20'
                ],
                'choices' => [
                    'button-outline-primary' => 'Primary',
                    'button-outline-secondary' => 'Secondary',
                ],
                'ui' => 0,
                'placeholder' => 'Please select',
            ])
            ->addText('op_button_text',[
                'label' => 'Button Text',
                'wrapper' => [
                    'width' => '40'
                ]
            ])
            ->addText('op_button_link',[
                'label' => 'Link to:',
                'wrapper' => [
                    'width' => '40'
                ]
            ])
            ->endRepeater()
            ->addTab('Logos')
            ->addImage('op_logo', [
                'label' => 'Logo',
                'instructions' => 'This is the main Logo and if no other logo is specified it will be used in the header and in the footer',
                'preview_size' => 'thumbnail',
                'return_format' => 'url'
            ])
            ->addImage('op_footer_logo', [
                'label' => 'Footer Logo',
                'instructions' => '',
                'preview_size' => 'thumbnail',
                'return_format' => 'url'
            ])
            ->addImage('op_fav_icon', [
                'label' => 'FavIcon',
                'instructions' => 'This is the image that shows up on the browser tab',
                'preview_size' => 'thumbnail',
                'return_format' => 'url'
            ])
            ->addTab('Front Page Settings')
            ->addRepeater('op_hp-sliders',[
                'label' => 'Home Page Slides',
                'button_label' => 'Add Slide',
            ])
            ->addTextarea('op_slide_content', [
                'label' => 'Slide Content',
                'wrapper' => [
                    'width' => '50'
                ],
                'instructions' => 'Wrap text in <span style="font-weight: bold; color: red">&lt;cite&gt;</span> to make it larger <br> 
                                   Wrap text in <span style="font-weight: bold; color: red">&lt;em&gt;</span> to make it spread out<br> 
                                   Wrap text in <span style="font-weight: bold; color: red">&lt;strong&gt;</span> to make it serif and change color to orange<br>
                                   Use <span style="font-weight: bold; color: red">&lt;br&gt;</span> to force a line break',
            ])
            ->addText('op_slide_link', [
                'label' => "Link to",
                'wrapper' => [
                    'width' => '25'
                ]
            ])
            ->addText('op_slide_button_text', [
                'label' => "Link Text",
                'wrapper' => [
                    'width' => '25'
                ]
            ])
            ->endRepeater();
            

        return $themeSettings->build();
    }
}
