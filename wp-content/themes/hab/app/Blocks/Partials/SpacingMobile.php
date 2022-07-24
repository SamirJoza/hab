<?php

namespace App\Blocks\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SpacingMobile extends Partial {
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields(){
        $spacing_mobile = new FieldsBuilder('spacing_mobile');

        $spacing_mobile
            ->addGroup('spacing_group_mobile', [
                'label' => 'Spacing',
            ])
                ->addGroup('padding', [
                    'label' => 'Padding'
                ])
                    ->addNumber('top_value', [
                        'label' => 'Top value',
                        'min'   => 0,
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('top_unit', [
                        'label' => 'Top unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw'
                        ],
                        'default_value' => 'px',
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('bottom_value', [
                        'label' => 'Bottom value',
                        'min'   => 0,
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('bottom_unit', [
                        'label' => 'Bottom unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw'
                        ],
                        'default_value' => 'px',
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('left_value', [
                        'label' => 'Left value',
                        'min'   => 0,
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('left_unit', [
                        'label' => 'Left unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw'
                        ],
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('right_value', [
                        'label' => 'Right value',
                        'min'   => 0,
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('right_unit', [
                        'label' => 'Right unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw'
                        ],
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                ->endGroup()
                ->addGroup('margin', [
                    'label' => 'Margin'
                ])
                    ->addNumber('top_value', [
                        'label' => 'Top value',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('top_unit', [
                        'label' => 'Top unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw',
                            'auto'
                        ],
                        'default_value' => 'px',
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('bottom_value', [
                        'label' => 'Bottom value',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('bottom_unit', [
                        'label' => 'Bottom unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw',
                            'auto'
                        ],
                        'layout' => 'horizontal',
                        'default_value' => 'px',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('left_value', [
                        'label' => 'Left value',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('left_unit', [
                        'label' => 'Left unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw',
                            'auto'
                        ],
                        'default_value' => 'auto',
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addNumber('right_value', [
                        'label' => 'Right value',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                    ->addButtonGroup('right_unit', [
                        'label' => 'Right unit',
                        'choices' => [
                            'px',
                            '%',
                            'vw',
                            'auto'
                        ],
                        'default_value' => 'auto',
                        'layout' => 'horizontal',
                        'wrapper' => [
                            'width' => '25',
                        ],
                    ])
                ->endGroup()
            ->endGroup();

        return $spacing_mobile;
    }
}
