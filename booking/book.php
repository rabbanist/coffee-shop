<?php 
require "../includes/header.php"; 
require "../config/config.php"; 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error = '';

    if (empty($_POST['first_name'])) {
        $error = 'First Name is Required';
    } elseif (empty($_POST['last_name'])) {
        $error = 'Last Name is Required';
    } elseif (empty($_POST['date'])) {
        $error = 'Date is Required';
    } elseif (empty($_POST['time'])) {
        $error = 'Time is Required';
    } elseif (empty($_POST['message'])) {
        $error = 'Message is Required';
    } else {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date = $_POST['date']; // Assuming the format is Y-m-d
        $time = $_POST['time'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        // Convert current date to the same format (Y-m-d) for comparison
       

        // Validate that the selected date is in the future
        if ($date > date("Y/m/d")) {
            // Prepare the SQL query
            $insert = "INSERT INTO booking (first_name, last_name, date, time, message, user_id) 
                       VALUES (:first_name, :last_name, :date, :time, :message, :user_id)";

            // Prepare statement
            $sql = $conn->prepare($insert);

            // Bind parameters
            $sql->bindParam(':first_name', $first_name);
            $sql->bindParam(':last_name', $last_name);
            $sql->bindParam(':date', $date);
            $sql->bindParam(':time', $time);
            $sql->bindParam(':message', $message);
            $sql->bindParam(':user_id', $user_id);

            // Execute the query
            if ($sql->execute()) {
                $_SESSION['success'] = 'Your Booking Successfully Submitted';
            } else {
                $error = 'Error inserting data';
            }
        } else {
            $error = 'Invalid date. Please select a future date.';
        }
    }

    // Store error message in session if there's an error
    if (!empty($error)) {
        $_SESSION['error'] = $error;
    }

    // Redirect to the same page to display messages
    header("Location: " . APPURL . ""); 
    exit();
}
?>
