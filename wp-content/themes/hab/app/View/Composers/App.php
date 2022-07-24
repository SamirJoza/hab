<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'primaryNavigation' => $this->primaryNavigation(),
            'address' => $this->get_the_address(),
            'socials' => $this->get_the_socials(),
            'footerLogo' => $this->get_the_footerLogo(),
            'headerLogo' => $this->get_the_headerLogo(),
            'footerButton' => $this->get_footer_button(),
        ];
    }

    /**
     * Get the Footer Button(s)
     */
    public function get_footer_button() {
        $footer_buttons = "";
        if(have_rows('op_footer_buttons', 'option')) {
            $footer_buttons = "<ul class='footer-buttons list-inline'>";
            while(have_rows('op_footer_buttons', 'option')): the_row();
                $footer_buttons .= '<li class="list-inline-item"><a class="'.get_sub_field('op_button_type','option').'" href="'.get_sub_field('op_button_link','option').'">'.get_sub_field('op_button_text','option').'</a></li>';
            endwhile;
            $footer_buttons .= "</ul>";
        }
        return $footer_buttons;
    }

    /**
     * Get the header Logo
     */
    public function get_the_headerLogo() {
        if(get_field('op_logo', 'option')) {
            return get_field('op_logo', 'option');
        }
        return;
    }

    /**
     * Get the footer Logo
     */
    public function get_the_footerLogo() {
        if(get_field('op_footer_logo', 'option')) {
            return get_field('op_footer_logo', 'option');
        }
        return;
    }
    /**
     * Get the Socials
     */
    public function get_the_socials() {
        $socials = "";
        $social = [
            'fb' => 'fa-facebook-square',
            'tw' => 'fa-twitter-square',
            'ig' => 'fa-instagram-square',
            'li' => 'fa-linkedin',
            'sn' => 'fa-snapchat-square',
            'tt' => 'fa-tiktok',
            'yt' => 'fa-youtube-square'
        ];
        if(have_rows('op_socials', 'option')) {
            $socials = "<ul class='socials list-inline'>";
            while(have_rows('op_socials', 'option')): the_row();
                if(isset($social[get_sub_field('op_social_network','option')])):
                    $socials .= '<li class="list-inline-item"><a href="'.get_sub_field('op_social_url','option').'" title="Connect with us" class=""><i class="fab '.$social[get_sub_field('op_social_network','option')].'"></i></a></li>';
                endif;
            endwhile;
            $socials .= "</ul>";
        }
        return $socials;
    }

    /** 
     * Get the Address from the Options
    */
    public function get_the_address() {
        $address = "";
        if(get_field('op_street', 'option') || get_field('op_unit', 'option') || get_field('op_city', 'option') || get_field('op_state', 'option') || get_field('op_zip', 'option') || get_field('op_phone', 'option') || get_field('op_email', 'option')) {
            if(get_field('op_street', 'option')) {
                $unit = "";
                if(get_field('op_unit', 'option')) {
                    $unit = ', ' . get_field('op_unit', 'option');
                }
                $address .= '<span itemprop="streetAddress">' . get_field('op_street', 'option') . $unit . ' </span>';
            }
            if(get_field('op_city', 'option')) {
                $address .= '<span itemprop="addressLocality">' . get_field('op_city', 'option') . "</span>";
            }
            if(get_field('op_state', 'option')) {
                $address .= '<span itemprop="addressRegion">, ' . get_field('op_state', 'option') . ' </span>';
            }
            if(get_field('op_zip', 'option')) {
                $address .= '<span itemprop="postalCode">' . get_field('op_zip', 'option') . ' </span>';
            }
            if (get_field('op_phone', 'option')) {
                $address .= '<span itemprop="telephone">' . get_field('op_phone', 'option') . ' </span>';
            }
            if(get_field('op_email', 'option')) {
                $address .= '<a href="mailto:'.get_field('op_email', 'option').'" itemprop="email">'.get_field('op_email', 'option').'</a>';
            }
        }
        return $address;
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Primary Nav Menu arguments
     * @return array
     */
    public function primaryNavigation()
    {
        $args = array(
            'theme_location' => 'primary_navigation',
            'container'  => '',
            'container_class' => '',
            'menu_class' => 'navbar-nav',
            'depth' => 4,
            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
            'walker' => new \App\wp_bootstrap5_navwalker()
        );
        return $args;
    }

}
