<?php

// create associative array, containing all the pics of one product 
$array_gallery = array( "pic_1" => array( 'url_1','alt_1'),
                        "pic_2" => array( 'url_2','alt_2'),
                        "pic_3" => array( 'url_3','alt_3')
                      );

echo "array_gallery is: ";
echo "<pre>";
var_dump($array_gallery);  // printing complex array
echo "</pre>";
echo "<br/><br/>";

$array_gallery_string = serialize($array_gallery);  // serialize the complex array
echo "The serialized array_gallery is this string: ";
echo "<pre>";
var_dump($array_gallery_string);  // printing the serialize array
echo "</pre>";
echo "<br/><br/>";

$unserialized_array_gallery = unserialize($array_gallery_string);  // unserializing the serialized array
echo "The unserialized_array_gallery is this array: ";
echo "<pre>";
var_dump($unserialized_array_gallery);  // printing the unserialized array
echo "</pre>";
echo "<br/><br/>";


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// Test getting info from the unserialized array /////////////////////////////////
echo "Picture 2: ";
echo "<br/>URL: " . $unserialized_array_gallery['pic_2'][0];
echo "<br/>ALT: " . $unserialized_array_gallery['pic_2'][1];

?>