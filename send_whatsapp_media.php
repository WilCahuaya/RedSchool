<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid ="AC9c4872acc6d847280b8b531767b41636";
$token ="24b23d804a34dd7230dd2763dff9b3e4";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("whatsapp:+51998608345", // to
                           [
                            "from" => "whatsapp:+14155238886",
                            "body" => "Hola Wilder como estas?",
                            "mediaUrl" => ["https://images.unsplash.com/photo-1545093149-618ce3bcf49d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80"],

                           ]
                  );

print($message->sid);
