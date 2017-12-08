<?php

	$url=$argv[1];
	$depth=$argv[2];
	$info_array = array();
	include_once('simple_html_dom.php'); 
	$html = file_get_html($url);
  	function get_links($url,$depth){
  		$links=array();
		$images=array();
		$titles=array();
	    global $html;
	  	if($depth>0){
		  	foreach ($html->find('title') as $element) {
		  		$titles[]=$element->plaintext;
		  	}
		  	foreach ($html->find('img') as $element) {
		  		$images[]=$element->src;
		  	}
		  	foreach ($html->find('a') as $element) {
		  		$links[]=array('Page title'=>$titles,'Image Sources'=>$images,'Link'=>$element->href,'Internal Link'=>get_links($element->href,$depth-1));
		  	}
	  		return $links;
  	 	}
  	}
    $output=get_links($url,$depth);
    print_r($output);

?>
