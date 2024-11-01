<?php
/*
Plugin Name: Universal Slugs
Plugin URI: http://humbuckercode.co.uk/licks/wordpress-plugins/universal-slugs
Description: Localized slugs for your blog
Author: AC - Humbucker Limited
Version: 0.6
Author URI: http://humbuckercode.co.uk/licks
*/
?>
<?php
/**
 *
 * Currently will only work with greek strings,
 * but plan is to include more character mappings to the class
 *
 * url: http://http://humbuckercode.co.uk/licks/wordpress-plugins/universal-slugs
 * email: sales@humbuckercode.co.uk
 *
 * @package UniversalSlug
 * @author http://humbuckercode.co.uk
 * @version 0.6
 **/


class  UniversalSlug {
  var $encoding;
  var $language;
  var $post_name;
  var $universal_slug;
  
  /**
   * Constructor function
   *
   * @param string $post_name 
   * @author achillesc
   */
  function __construct($post_name){
    global $wpdb;
    
    $this->post_name = $post_name;
    $this->language = WPLANG;
    $this->encoding = get_option('blog_charset');
    $this->romanize();
  }
  
  /**
   * PHP4 Constructor
   * @author achillesc
   */
  function UniversalSlug($post_name){
    $this->__construct($post_name);
  }
  
  /**
   * Romanizing function
   *
   * @return void
   * @author achillesc
   **/
  function romanize(){
    if ($this->post_name && !empty($this->post_name)) {
      $universal_slug = $this->post_name;
    } else {
      $universal_slug = $_POST['post_title'];
      $universal_slug = preg_replace ("/[^a-zA-Z0-9 \']/", "", $universal_slug);
      $universal_slug = str_replace(" ","-",$universal_slug);
    }
    $universal_slug = strtolower(stripslashes($universal_slug));
    $universal_slug = mb_strtoupper(urldecode($universal_slug),$this->encoding);
    $universal_slug = strtolower(strtr($universal_slug,$this->mappings()));
    $universal_slug = str_replace($this->stopwords(),"",$universal_slug);
    $universal_slug = preg_replace('/&.+?;/', '', $universal_slug);
    $this->universal_slug = $universal_slug;
  }
  
  function stopwords(){
    return $this->get_data("languages/stopwords");
  }
  
  function mappings(){
    return $this->get_data("languages/mappings");
  }
  
  /**
   * Open and unserialize a localization data file
   *
   * @param string $path 
   * @return array $data
   * @author achillesc
   */
  function get_data($path){
    $generic_language = empty($this->language) ? "" : explode("_",$this->language);
    $generic_language = is_array($generic_language) ? $generic_language[0] : $generic_language;
    $path = dirname(__FILE__)."/".$path;
    if (file_exists("{$path}/{$this->language}.dat")) {
      $data = unserialize(file_get_contents("{$path}/{$this->language}.dat"));
    } elseif (file_exists("{$path}/{$generic_language}.dat")) {
      $data = unserialize(file_get_contents("{$path}/{$generic_language}.dat"));
    } else {
      $data = array();
    }
    return $data;
  }
} // END class 
add_filter("name_save_pre",'us_romanize_slug',0);

function us_romanize_slug($post_name){
  $slug_factory = new UniversalSlug($post_name);
  return $slug_factory->universal_slug;
}
?>