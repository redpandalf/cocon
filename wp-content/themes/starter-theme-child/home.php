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

$context = Timber::get_context();

// Set a home page variable
$context['is_front_page'] = 'true';


Timber::render(array('home.twig'), $context);