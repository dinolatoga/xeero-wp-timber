<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP
 * @since	2015.08.25
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );
