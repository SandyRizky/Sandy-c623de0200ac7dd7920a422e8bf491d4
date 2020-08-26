<?php
require_once('../config/koneksi.php');


$arr = array();
$arr["result"] = "NG";
if (isset($_POST['name']) && isset($_POST['password'])) {
        $nama               = $_POST['name'];
        $password           = $_POST['password'];
        $time               = "";
        $status             = "loggedout";

        $sql = $conn->prepare("INSERT INTO user (username, password, login_time, login_state) VALUES (?, ?, ?, ?)");
        $sql->bind_param('ssss', $nama, $password, $time, $status);
        $sql->execute();

        if ($sql) {
            $arr["result"] = "OK";
            $arr["name"] = $nama;
            $arr["login_time"] = $time;
            echo json_encode($arr);
        } else {
            echo json_encode($arr);
        }
} else {
    echo json_encode($arr);
}

?>