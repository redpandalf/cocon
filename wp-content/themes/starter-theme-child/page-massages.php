<?php
/**
 * Template Name: Massages
 *
 * Displays the Business Template of the theme.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( array( 'page-massages.twig', 'page.twig'), $context );
