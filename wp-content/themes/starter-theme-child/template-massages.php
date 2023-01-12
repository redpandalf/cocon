<?php
/**
    * Template Name: Coucou
    */

  $context = Timber::context();
  Timber::render( array( 'page-massages.twig', 'page.twig' ), $context );
