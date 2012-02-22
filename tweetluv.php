<?php
/*
Plugin Name: Tweetluv
Version: 0.1
Plugin URI: http://tweetluv.com
Description: Like Gravatars, but for Twitter account links. Automatically adds a link to each commenter's Twitter account. No database changes needed!
Author: Charlie Park
Author URI: http://charliepark.org

Copyright 2012  Charlie Park (email : charlie@pearbudget.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function add_twitter_link_to_comment_author(){
	global $comment;
	$author = get_comment_author();
	$email  = get_comment_author_email();
	$url    = get_comment_author_url();
	$hash   = md5(strtolower($email));

	$author_block = ( empty( $url ) || 'http://' == $url ) ? $author : "<a href='$url' rel='external nofollow' class='url'>$author</a>";
	echo $author_block.' <div class="tweetluv" data-md5="'.$hash.'"></div>';
}

function insert_twitter_links(){
	echo '<script type="text/javascript">(function(){var a=document.createElement("script");a.type="text/javascript";a.src="//tweetluv.com/tweetluv.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script>';
};

add_filter('get_comment_author_link','add_twitter_link_to_comment_author');
add_action('wp_head','insert_twitter_links');
?>