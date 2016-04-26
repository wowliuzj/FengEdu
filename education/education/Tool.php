<?php
class Tool
{
   	public static function toResJson($stat,$data)
   	{
   		$res = array();
   		$res['s'] = $stat;
   		$res['data'] = $data;
   		return $res;
   	}
   	public static  function md5_xx($str){
        return md5($str . "凤凰教育平台");
    }

    /**
     * 通过加盐生成hash值
     * @param $hash
     * @param $salt
     * @return string
     */
    public static function salt_hash($hash, $salt){
        $count = count($salt);
        return \Tool::_hash(substr($salt, 0, $count / 2) . $hash . $salt);
    }
    /**
     * 单独封装hash函数
     * @param      $str
     * @param bool $raw_output 为true时返回二进制数据
     * @return string
     */
    public static function _hash($str, $raw_output = false){
        return hash("sha256", $str, $raw_output);
    }

    /**
     * 生成随机字符
     * @param int $len
     * @return string
     */
    public static function salt($len = 40){
        $output = '';
        for($a = 0; $a < $len; $a++){
            $output .= chr(mt_rand(33, 126)); //生成php随机数
        }
        return $output;
    }

    public static function saveFile($fileFormName)
    {
        $file = yii\web\UploadedFile::getInstanceByName($fileFormName);
        if($file === null){
            return "";
        }
        $fileName ='uploads/' . time() . '_' . rand(1,1000) . '.' . $file->extension;
        $file->saveAs($fileName);
        return $fileName;
    }

    public function guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
            return $uuid;
        }
    }
}
