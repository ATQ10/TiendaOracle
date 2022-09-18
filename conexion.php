<?php
@session_start();
function conectar(){
    $conn = oci_connect('hr', 'hr', '25.10.253.194/xepdb1','AL32UTF8');
    if (!$conn) {
        $m = oci_error();
        trigger_error(htmlentities($m['message']), E_USER_ERROR);
    }
    return $conn;
}
?>