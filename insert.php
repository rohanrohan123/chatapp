<?php
session_start();
include('conection.php');
$name=$_SESSION["name"];
$active="1";

// sms
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
$sid = 'AC36e4bc1cbd894790c8cdfeac21b4cc08';
 $token = '31eb8e1b113bf9f72a7193ad19451618';
 $client = new Client($sid, $token);
//end



date_default_timezone_set('Asia/Kolkata');
// echo date('d-m-Y H:i');

$time=date("h:i:sa");
// include('./conection.php');
$data=stripslashes(file_get_contents("php://input"));
$mydata=json_decode($data,true);
$msg=$mydata['msgtext'];
$msg2=stripslashes($msg);
// $msg2=nl2br($msg);
//echo $msg2;

if(!empty($msg2)){
    $sql2 = "SELECT * FROM messages where name='Raju'";
    $result=$conn->query($sql2);
    if($result->num_rows>0){
      $row=$result->fetch_assoc();
        if($row['active']==1){

          $sql="INSERT INTO `messages`(`name`, `msg`, `time`, `active`) VALUES ('$name','$msg2','$time','$active')";
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }else{
// sms
              $mgess=$client->messages->create(
        //      //     // the number you'd like to send the message to
             '+919654248616',
            [
        //  // A Twilio phone number you purchased at twilio.com/console
             'from' => '+17406975978',
        //   // the body of the text message you'd like to send
             'body' => str_replace("<br/>","\n",$msg2)
            ]
          );


//end
if($mgess){
  echo "Send succ";
}else{
  echo "not send";
}
//echo str_replace("<br/>"," ",$msg2);

          $sql="INSERT INTO `messages`(`name`, `msg`, `time`, `active`) VALUES ('$name','$msg2','$time','$active')";
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }




        }
      

    }

    // $sql="INSERT INTO `messages`(`name`, `msg`, `time`, `active`) VALUES ('$name','$msg','$time','$active')";
    //  if ($conn->query($sql) === TRUE) {
    //    echo "New record created successfully";
    // } else {
    //   echo "Error: " . $sql . "<br>" . $conn->error;
    // }



}else{
    echo "Fill All Fields";
}
