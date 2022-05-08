
<?php
$url ='https://pixabay.com/api/';

$options = array(

    'key' => '27228236-ecacee828bdd0ed754e88ae07',
    'q'=> 'all',
    'lang'=>'en',
    'category'=> 'all',
    'colors'=> "grayscale", "transparent", "red", "orange", "yellow", "green", "turquoise", "blue", "lilac", "pink", "white", "gray", "black", "brown",
    'order'=>  "popular",

);

$curl= curl_init();

curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_URL,$url.'?'.http_build_query($options));

$response =curl_exec($curl);
$data =json_decode($response,true);
curl_close($curl);

echo '<pre>';
print_r($data);

?>
@end

