<?php
// PHP code validation block from w3schools: https://www.w3schools.com/php/php_form_validation.asp
    function validate_input($userInput) {
        $userInput = trim($userInput); // Trims leading, trailing, and extra white spaces
        $userInput = stripslashes($userInput); // Removes backslashes
        $userInput = htmlspecialchars($userInput); // Converts special characters to HTML entities
        return $userInput; // Returns cleaned up user input
    }
?>