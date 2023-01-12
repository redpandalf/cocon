<?php
/**
 * Template Name: My Custom Page
 * The template for displaying all pages.
 *
 * Description: A Page Template with a darker design.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'page-massages.twig', 'page.twig' ), $context );
