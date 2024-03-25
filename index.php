<?php
    $text = $_POST["text"];
    $serviceCode = $_POST['serviceCode'];
    $phonenumber = $_POST['phoneNumber'];
    

    include 'connection.php';
    $query = "SELECT * FROM `accounts` WHERE phone = '+250781899482'";
    $result = mysqli_query($conn,$query);
    $isValidLogin = mysqli_num_rows($result);
    $detail = mysqli_fetch_assoc($result);
    $name = $detail['name'];
    $balance = $detail['balance'];
    $password = $detail['password'];




    if($text = ''){
        $response = "CON Dear" . $name . "wellcome\n";
        $response .= "1. Account Balance \n";
        $response .= "2. Mini Statement";
    }
    elseif($text == "1"){
        $response = "END Dear" . $name . "Your account balance is" . $balance ;
    }
    elseif($text == "2"){
        $sql = "SELECT * FROM `transaction` WHERE phone '$phonenumber' ORDER BY id DESC LIMIT 10
        ";
        $run = mysqli_query($conn,$sql);
        if($run ->num_rows >0){
            while($row = mysqli_fetch_assoc($run)){
                $transaction .=$row['t_code']. '||' . $row['amount'] . '||' . $row['date'] . "##";
            }
            $response = "END your last transaction is ". $transaction;
        }
        else{
            $response = "END No transaction found!";
        }
    }
    header('Content-type: text/plain');
    echo($response);