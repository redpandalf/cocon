<?php
/**
 * Template Name: Mes Messages
 * Description: A Page Template with a darker design.
 */

// 

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'page-massages.twig', 'page.twig' ), $context );
