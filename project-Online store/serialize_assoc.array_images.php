<?php

// create associative array, containing all the pics of one product 
$array_gallery = array( "pic_1" => array( 'https://vanhout.art/wp-content/uploads/Waiting-for-Santa-snack-time-20210612221952-7-scaled.jpg','product_id_1-pic_1'),
                        "pic_2" => array( 'https://vanhout.art/wp-content/uploads/Waiting-for-Santa-snack-time-20210612221952-2-1200x1200.jpg','product_id_1-pic_2'),
                        "pic_3" => array( 'https://vanhout.art/wp-content/uploads/Waiting-for-Santa-snack-time-20210612221952-1-1200x1200.jpg','product_id_1-pic_3'),
                        "pic_4" => array( 'https://vanhout.art/wp-content/uploads/Waiting-for-Santa-snack-time-20210612221952-4-scaled.jpg','product_id_1-pic_4'),
                        "pic_5" => array( 'https://vanhout.art/wp-content/uploads/Waiting-for-Santa-snack-time-20210612221952-5-scaled.jpg','product_id_1-pic_5')
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