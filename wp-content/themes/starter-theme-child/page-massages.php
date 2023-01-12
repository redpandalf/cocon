<?php
    /*
     Template Name: Front Page
    */
  $context = Timber::context();
  Timber::render( array( 'page-massages.twig', 'page.twig' ), $context );
