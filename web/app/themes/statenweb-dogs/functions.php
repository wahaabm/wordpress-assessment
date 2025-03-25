<?php
function statenweb_dogs_enqueue()
{
    //load jquery and tailwindcss
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/style.css', [], '1.0');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'statenweb_dogs_enqueue');
