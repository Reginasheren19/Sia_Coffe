<?php
    session_start();
    
    include("config/koneksi_mysql.php");
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = mysqli_query($koneksi,
                "SELECT 
                    * 
                FROM 
                    transaksi_login 
                WHERE 
                    username ='$username' and 
                    password_md5 = '$password'");
    $cek = mysqli_num_rows($sql);
    if($cek > 0){
        $data = mysqli_fetch_assoc($sql);
        if($data['role'] == "admin"){
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "admin";
            header("location:admin/dashboard_admin.php");
        } else{
            header("location:index.php?pesan=gagal");
        }
    } else{
        header("location:index.php?pesan=gagal");
    }
?>
