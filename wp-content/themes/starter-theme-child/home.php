<?php
/**
 * Template Name: Page d'accueil
 *
 * Displays the Business Template of the theme.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */


$post = new Timber\Post();
if (isset($post->hero_image) && strlen($post->hero_image)){
	$post->hero_image = new Timber\Image($post->hero_image);
}
$context = Timber::context();
$context['post'] = $post;



//$context = Timber::get_context();


// Set a home page variable
$context['is_front_page'] = 'true';


Timber::render(array('home.twig'), $context);