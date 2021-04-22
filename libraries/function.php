<?php


    //get Input
    //post input
    function postInput($string)
    {
         return isset($_POST[$string]) ? $_POST[$string] : '';
    }
    function postInputedit($string)
    {
         return isset($_POST[$string]) ? $_POST[$string] : '';
    }
    function getInputedit($string)
    {
         return isset($_GET[$string]) ? $_GET[$string] : '';
    }
    function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ẵ|ặ|ẳ)/','a',$str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ể|ễ|ệ)/','e',$str);
        $str = preg_replace('/(ì,í,ị,ỉ,ĩ)/','i',$str);
        $str = preg_replace('/(ò|ó|ỏ|õ|ọ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ở|ợ|ỡ)/','o',$str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ứ|ừ|ự|ữ|ử)/','u',$str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/','y',$str);
        $str = preg_replace('/(đ)/','d',$str);
        $str = preg_replace('/[^a-z0-9-\s]/','',$str);
        $str = preg_replace('/([\s]+)/','-',$str);
        return $str;
    }
    function base_url()
    {
        return $url = "http://localhost:81/backend/webbanhang/";
    }
    function modules($url)
    {
        return base_url(). "admin/modules/".$url;       
    }
    function index($url)
    {
        return base_url(). "admin/".$url;
    }
    if(! function_exists('redirectAdmin'))
    {
        function redirectAdmin($url = "")
        {
            header("location: ".base_url()."admin/modules/{$url}");
            exit();
        }
    }
    function upload()
    {
        return base_url() ."uploads/";
    }
    function truncateString($str, $maxChars = 20, $holder = "...")
    {
        if (strlen($str) > $maxChars)
        {
            return trim(substr($str, 0, $maxChars)) . $holder;
        } 
        else 
        {
            return $str;
        }
    }
    function _debug($data)
    {
        echo '<pre style="background: #000;color: #fff;width:100%;overflow:auto"';
        echo '<div>Your ID: '.$_SERVER['REMOTE_ADDR'].'</div>';
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);
        echo '<div>File: '.$debug['file'].'</div>';
        echo '<div>Line: '.$debug['file'].'</div>';
        if(is_array($data) || is_object($data))
        {
            print_r($data);
        }
        else
        {
            var_dump($data);
        }
        echo '</pre>';
    }
    function formatPrice($price)
    {
        $price = intval($price);
        return $number =  number_format($price,0,'.','.');
    }
   
    function formatPhoneNum($phone)
    {
        $phone = preg_replace("/[^0-9]*/",'',$phone);
        if(strlen($phone) != 10) return(false);
        $sArea = substr($phone,0,3);
        $sPrefix = substr($phone,3,3);
        $sNumber = substr($phone,6,2);
        $phone = "".$sArea."-".$sPrefix."-".$sNumber;
        return($phone);
      }
    function formatpriceSale($price,$sale)
    {
        $price = intval($price);
        $sale = intval($sale);
        $price = $price*(100 - $sale)/100;
        return formatPrice($price);
    }
    function vat($price)
    {
        $price = intval($price);
        if($price < 5000000)
        {
            return 0;
        }
        else if($price < 10000000)
        {
            return 5;
        }
        else
        {
            return 10;
        }
    }
    // function checkprice($price)
    // {
    //     $price = intval($price);
    //     if($price == 0)
    //     {
    //         return "<b class='text-danger'> Hết hàng </b>";
    //     }
    //     else if($price > 0 && $price < 5)
    //     {
    //         return "<b class='text-danger'> Sắp hết hàng </b>";
    //     }
    //     else
    //     {
    //         return "<b class='text-danger'> Còn hàng </b>";
    //     }
    // }

?>