<?php
    session_start();
    include "connection.php";    
    $user=$_POST['user'];
    $pass=$_POST['password'];

    //jika belum diisi form nya
    if(empty($user)){
        $_SESSION['info']='masukan user name anda';
                header("Location: login.php");
                exit();
    }else{
        if(empty($pass)){
            $_SESSION['info']='masukan password anda';
            header("Location: login.php");
            exit();
        }else{
            //cocokan dengan database
            $sql = "SELECT * FROM user WHERE User_Name LIKE '$user' AND Password LIKE '$pass'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)===1){
                $row = mysqli_fetch_assoc($result);

                if($row['User_Name']===$user && $row['Password']===$pass){
                    $_SESSION['login']='ok';

                }
            }else{
                $_SESSION['info']='login salah, masukan data dengan benar';
                header("Location: login.php");
                exit();
            }           
            //jika sudah berhasil login tapi masuk halaman login akan diarahkan ke halaman index
            if(isset($_SESSION['login'])){
                header("Location:index.php?m=1&n=1");
            }else{
                header("Location: login.php");
                exit();
            }
        }
    }

    


    

?>