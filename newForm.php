<?php

if(isset($_POST['email'])) {
    if(!empty($_POST['email'])) {
        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            
            exit("invalid email format");
            
        }

        $api_key = "c08e269f8865412682846391270e7d37";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email=$email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response, true);

        if ($data['deliverability'] === "UNDELIVERABLE") {
            
            exit("This email does not exist");
            
        }

        if ($data["is_disposable_email"]["value"] === true) {
            
            exit("This is a Disposable Mail");
            
        }

        echo "email address is valid";

    }
}
?>

<form action="" method="POST">

<input type="email" name="email" placeholder="Your Email Here " required>
<input type="submit" name="submit" value="submit">

</form>