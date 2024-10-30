<?php
/**
 * Plugin Name: LH Native Lazy Loading
 * Plugin URI: https://lhero.org/portfolio/lh-native-image-lazy-loading/
 * Description: Automatically add the new `loading` attribute to images and iframes within your content to support native lazy loading.
 * Version:     1.00
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 */

// If this file is called directly, abandon ship.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if (!class_exists('LH_Native_lazy_loading_plugin')) {

class LH_Native_lazy_loading_plugin {
    
private static $instance;

var $first_featured = false;
var $first_avatar = false;
var $first_content_img = false;


static function str_replace_first($search, $replace, $subject) {
		$search = '/'.preg_quote($search, '/').'/';
		return preg_replace($search, $replace, $subject, 1);
	}



static function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(plugin_basename( __FILE__ ).' - '.print_r($log, true));
            } else {
                error_log(plugin_basename( __FILE__ ).' - '.$log);
            }
        }
    }
    

	
	
public function add_content_image_attribute($content) {
    
if (!empty($content)){
    
libxml_use_internal_errors(true);    
$dom = new DOMDocument;
    $dom->loadHTML( mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
    
    
    //Find all images
$images = $dom->getElementsByTagName('img');


    
 //Iterate though images
foreach ($images AS $image) {

if ($loading = $image->getAttribute('loading')){

//do nothing 

$this->first_content_img = true;
   
} else {
    

if (!empty($this->first_content_img)){
    
$image->setAttribute("loading", "lazy");

}
    
    
}
    
    
}
		
  
    //Find all iframes
$iframes = $dom->getElementsByTagName('iframe');


    
 //Iterate though images
foreach ($iframes AS $iframe) {

if ($loading = $iframe->getAttribute('loading')){

//do nothing 

$this->first_content_img = true;
   
} else {
    

if (!empty($this->first_content_img)){
    
$iframe->setAttribute("loading", "lazy");

}
    
    
}
    
    
}

$content = $dom->saveHTML();
libxml_clear_errors();

}
 
return $content;

	
}


public function add_thumbnail_image_attribute($html, $post_id, $post_thumbnail_id, $size, $attr){
    
 if (!empty($this->first_featured)){
     
$html = str_replace('<img','<img loading="lazy"', $html);     
     
     
     
 }
 

$this->first_featured = true;
    
    
return $html;   
    
}


public function lazy_embed_oembed_html($html, $url, $attr){
    $html = str_replace('<iframe ','<iframe loading="lazy" ',$html);
    return $html;
 }
 
 
 
public function lazy_avatar_html($avatar, $id_or_email, $size, $default, $alt, $args){
    
 if (!empty($this->first_avatar)){
     
$avatar = str_replace('<img','<img loading="lazy"', $avatar);     
     
     
     
 }
 

$this->first_avatar = true;
    
    
return $avatar;
    
}

public function lazy_attachment_attribute($attr, $attachment, $size){
    
if (!empty($this->first_content_img)){
    
$attr['loading'] = "lazy";

} else {
    
$this->first_content_img = true;    
    
    
}
    
return $attr;  
    
}


public function add_hooks(){
    
add_filter('the_content', array($this,'add_content_image_attribute'),PHP_INT_MAX, 1);

add_filter('post_thumbnail_html', array($this,'add_thumbnail_image_attribute'),PHP_INT_MAX, 5);


add_filter('embed_oembed_html', array($this,'lazy_embed_oembed_html'),10, 3);


add_filter('get_avatar', array($this,'lazy_avatar_html'),10, 6);

add_filter('wp_get_attachment_image_attributes', array($this,'lazy_attachment_attribute'),10, 3);    
    
    
}



public function plugins_loaded(){
    
//add on body open so that it only runs when needed
add_action( 'wp_body_open', array($this,'add_hooks'));

}



    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
    public static function get_instance(){
        if (null === self::$instance) {
            self::$instance = new self();
        }
 
        return self::$instance;
    }
    
    



public function __construct() {
    
	 //run our hooks on plugins loaded to as we may need checks       
    add_action( 'plugins_loaded', array($this,'plugins_loaded'));

}




}

$lh_native_lazy_loading_instance = LH_Native_lazy_loading_plugin::get_instance();

}

?>