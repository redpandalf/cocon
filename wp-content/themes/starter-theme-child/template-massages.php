<?php
/**
 * Template Name: Mes Messages
 * Template Post Type: page
 */

// 

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'page-massages.twig', 'page.twig' ), $context );
