<?php
class Dictionary 
{
	static $_dictionary = array('à' => 'a','á' => 'a','ả' => 'a','ã' => 'a','ạ' => 'a',
	'ă' => 'a','ằ' => 'a','ắ' => 'a','ẳ' => 'a','ẵ' => 'a','ặ' => 'a',
	'â' => 'a','ầ' => 'a','ấ' => 'a','ẩ' => 'a','ẫ' => 'a','ậ' => 'a',
	'đ' => 'd',
	'è' => 'e','é' => 'e','ẻ' => 'e','ẽ' => 'e','ẹ' => 'e',
	'ê' => 'e','ề' => 'e','ế' => 'e','ể' => 'e','ễ' => 'e','ệ' => 'e',
	'ì' => 'i','í' => 'i','ỉ' => 'i','ĩ' => 'i','ị' => 'i',
	'ò' => 'o','ó' => 'o','ỏ' => 'o','õ' => 'o','ọ' => 'o',
	'ô' => 'o','ồ' => 'o','ố' => 'o','ổ' => 'o','ỗ' => 'o','ộ' => 'o',
	'ơ' => 'o','ờ' => 'o','ớ' => 'o','ở' => 'o','ỡ' => 'o','ợ' => 'o',
	'ù' => 'u','ú' => 'u','ủ' => 'u','ũ' => 'u','ụ' => 'u',
	'ư' => 'u','ừ' => 'u','ứ' => 'u','ử' => 'u','ữ' => 'u','ự' => 'u',
	'ỳ' => 'y','ý' => 'y','ỷ' => 'y','ỹ' => 'y','ỵ' => 'y');


	public static function formatUrl($transferedUrl, $charset = 'UTF-8'){
    $strlen = strlen(utf8_decode($transferedUrl));
    while($strlen){
        $array[] = mb_substr($transferedUrl,0,1,$charset);
        $transferedUrl = mb_substr($transferedUrl, 1, $strlen, $charset);
        $strlen = mb_strlen($transferedUrl,$charset);
    }


    for($i=0;$i<count($array);$i++){
        foreach(self::$_dictionary as $_key => $_value) {
            if ($array[$i] == $_key){
                $array[$i] = $_value;
            }
        }
    }

	return implode("", $array);
	}

	public static function explodeWithCharset($input, $charset = 'UTF-8'){
		$strlen = mb_strlen($input, $charset);
    	while($strlen){
        	$array[] = mb_substr($input,0,1,$charset);
        	$transferedUrl = mb_substr($input, 1, $strlen, $charset);
        	$strlen = mb_strlen($input, $charset);
    	}
    	return $array;
	}
}