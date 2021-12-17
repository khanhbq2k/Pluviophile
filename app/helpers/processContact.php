<?php 


if($_SERVER['REQUEST-METHOD' == 'POST']){
    $name = test_input($_POST['name']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['content']);
    $email = filter_var(trim($_POST['email']) , FILTER_SANITIZE_EMAIL);


    $recipient = $email;
    $subject = $subject;
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message: $message\n";

    $email_headers = "From: $name <$email>";
    
    if(mail($recipient, $subject, $email_content, $email_headers)){
        http_response_code(200);
    }else{
        http_response_code(500);
    }


}else{
    http_response_code(403);
}


function test_input($data){
    $data = trim($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    $data = str_replace(array("\r","\n"), array(" ", " "), $data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 





// $fromEmail = $_POST['email'];
// $sendToEmail = 'quockhanh2609qk@gmail.com';

// $subject = '[Pluviophile - Contact Form Submit]' . '[' . $_POST['subject'] . ']';

// $formFields = array('name' => 'Name', 'email' => 'Email', 'content' => 'Content');

// $mailSendSuccess = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
// $mailSendFailed = 'There was an unexpected error while submitting the form. Please try again later';

// try{
//     if(!empty($_POST)){
//         $messageBody = "Pluviophile - You have a new message from contact form\n=============================================";
//         foreach($_POST as $key => $value){
//             if(isset($formFields[$key])){
//                 $messageBody .= "$formFields[$key] : $value\n";
//             }
//         }

//         $headers = array('Center-Type: text/plain; charset="UTF-8"',
//         'From: ' . $fromEmail,
//         'To: ' . $sendToEmail,
//         'Return-Path: ' .$fromEmail,);

//         mail($sendToEmail, $subject, $messageBody, implode("\n", $headers));
//         $responseArray = array('type' => 'success', 'message' => $mailSendSuccess);

//     }
// }catch(\Exception $e){
//     $responseArray = array('type' => 'error', 'message' => $mailSendFailed);
// }

// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//     $encoded = json_encode($responseArray);
//     header('Content-Type: application/json');
//     echo $encoded;
// } else {
//     echo $responseArray['message'];
// }
