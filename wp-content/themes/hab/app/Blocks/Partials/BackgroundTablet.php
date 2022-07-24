<?php

namespace App\Blocks\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundTablet extends Partial {
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields(){
        $background_tablet = new FieldsBuilder('background_tablet');

        $background_tablet
            ->addGroup('bg_group_tablet', [
                'label' => 'Background',
                'conditional_logic' => [
                    [
                        'field' => 'bg_img',
                        'operator' => '!=empty',
                    ]
                ]
            ])
                ->addSelect('bg_size', [
                    'label' => 'Size',
                    'choices' => [
                        'auto' => 'Auto',
                        'cover' => 'Cover',
                        'contain' => 'Contain',
                        '100% 100%' => 'Full (100% 100%)'
                    ],
                    'wrapper' => [
                        'width' => '33',
                    ],
                ])
                ->addNumber('bg_x', [
                    'label' => 'X Position (%)',
                    'min'   => 0,
                    'max'   => 100,
                    'wrapper' => [
                        'width' => '33',
                    ],
                ])
                ->addNumber('bg_y', [
                    'label' => 'Y Position (%)',
                    'min'   => 0,
                    'max'   => 100,
                    'wrapper' => [
                        'width' => '33',
                    ],
                ])
            ->endGroup();

        return $background_tablet;
    }
}
