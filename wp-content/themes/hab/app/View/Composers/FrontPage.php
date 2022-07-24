<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'slides' => $this->get_slides(),
        ];
    }

    public function get_slides() {
        $slides = "";
        if(have_rows('op_hp-sliders', 'option')) {
            $i = 1;
            while(have_rows('op_hp-sliders', 'option')):the_row();
                if($i==1):
                    $slides .= "<div class='carousel-item active h-100'>";
                else:
                    $slides .= "<div class='carousel-item h-100'>";
                endif;
                $slides .= "<div class='inner-slide'>";
                $slides .= '<h1>' . get_sub_field("op_slide_content",'option') . '</h1>';
                if(get_sub_field("op_slide_link",'option') && get_sub_field("op_slide_button_text",'option')):
                    $slides .= '<a class="btn btn-primary text-uppercase" href="'.get_sub_field("op_slide_link",'option').'" title="'.get_sub_field("op_slide_button_text",'option').'">'.get_sub_field("op_slide_button_text",'option').'</a>';
                endif;
                $slides .= "</div>";
                $slides .= "</div>";
                $i++;
            endwhile;
        }
        return $slides;
    }
}
