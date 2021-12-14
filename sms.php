<?php
// // require_once "Twilio/autoload.php";
// // Required if your environment does not handle autoloading
 require __DIR__ . '/vendor/autoload.php';

// // Use the REST API Client to make requests to the Twilio REST API
 use Twilio\Rest\Client;
// use Twilio\Rest\Client;

// // Your Account SID and Auth Token from twilio.com/console
 $sid = 'AC36e4bc1cbd894790c8cdfeac21b4cc08';
 $token = '31eb8e1b113bf9f72a7193ad19451618';
 $client = new Client($sid, $token);

// // Use the client to do fun stuff like send text messages!
 $client->messages->create(
//     // the number you'd like to send the message to
    '+919654248616',
     [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+17406975978',
//         // the body of the text message you'd like to send
         'body' => 'Hey Rohan! Good luck on the project!'
   ]
 );



 
 if($message){
    echo "Message Send";
}else{
    echo "some Error Message Send";
}




?>
