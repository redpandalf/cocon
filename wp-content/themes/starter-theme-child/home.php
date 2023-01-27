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

$context = Timber::context();

$context['is_front_page'] = 'true';

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'home.twig', 'page.twig' ), $context );