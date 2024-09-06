<?php

require_once("../utility/Connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submitBtn"])) {

        //taking values from the form
        $name = $_POST["fullName"];
        $email = $_POST["email"];
        $profile = $_POST["profileImg"];
        $phone_no = $_POST["phoneNo"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $adddress = $_POST["address"];


        //check if email and phone number already exists
        
        
    }
}
