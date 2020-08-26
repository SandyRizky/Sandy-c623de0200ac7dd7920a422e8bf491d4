<?php
    header('Content-Type: application/json');
    require_once("../config/koneksi.php");
//    $db = new Db();
    
    //Update login data
    $arr = array();
    $arr["result"] = "NG";
    if (isset($_POST['name'])) {
        $name               = $_POST["name"];
        $password           = $_POST["password"];
        $time               = date("Y-m-d H:i:s");
        $status             = "loggedin";

        //Get login data
        if ($result = mysqli_query($conn, "select username, login_time from user where username ='".$name."' and password ='".$password."'")) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $sql = $conn->prepare("UPDATE user SET login_time=?, login_state=? WHERE username =? and password =?");
                $sql->bind_param('ssss', $time, $status, $name, $password);
                $sql->execute();
                if ($sql) {
                    $arr["result"] = "OK";
                    $arr["name"] = $row["username"];
                    $arr["login_time"] = $time;
                }
            }
            echo json_encode($arr);
        } else {
            echo json_encode($arr);
        }
    }else{
        echo json_encode($arr);
    }

    mysqli_close($conn);

    //Update Data
    // $sql = $conn->prepare("UPDATE produk SET nama_produk=?, tipe_produk=?, harga=?, stok=? WHERE id=?");
    // $sql->bind_param('ssddd', $nama_produk, $tipe_produk, $harga, $stok, $id);
    // $sql->execute();
    // if ($sql) {
    //     //echo json_encode(array('RESPONSE' => 'SUCCESS'));
    //     header("location:../readapi/tampil.php");
    // } else {
    //     echo json_encode(array('RESPONSE' => 'FAILED'));
    // }


    // $cat_list = $db->query("select username, login_time from user where username ='".$name."' and password ='".$password."'");
    // $arr = array();
    
    // $arr["result"] = "OK";
    // $arr["name"] = $cat_list[0]["username"];
    // $arr["login_time"] = $cat_list[0]["login_time"];

    // echo json_encode($arr);
?>