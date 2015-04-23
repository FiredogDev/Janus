<?php
/*
 * File: Utility Functions
 * Author: Firedog Design
 * URL: http://firedog.co.uk
*/

/*********************
* Utils
*********************/
function get_attachment_as_url($id, $size){
    $image = wp_get_attachment_image_src( $id, $size );
    return $image[0];
} ?>