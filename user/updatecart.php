<?php
    include "../autoload/autoload.php";
    $key = intval(getInputedit("key"));
    $number = intval(getInputedit("number"));
    $_SESSION['cart'][$key]['number'] = $number;
    echo 1;

?>