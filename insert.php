<?php
// Define variables and initialize them as empty
$name = $email = $phone = $room_type = $pax = $date = $time = $message  = "";
$nameErr = $emailErr = $phoneErr = $roomErr = $paxErr = $dateErr = $timeErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["room_type"])) {
        $roomErr = "Room type is required";
    } else {
        $room_type = test_input($_POST["room_type"]);
    }

    if (empty($_POST["pax"])) {
        $paxErr = "pax is required";
    } else {
        $pax = test_input($_POST["pax"]);
    }

    if (empty($_POST["date"])) {
        $dateErr = "Date is required";
    } else {
        $date = test_input($_POST["date"]);
    }

    if (empty($_POST["time"])) {
        $timeErr = "Time is required";
    } else {
        $time = test_input($_POST["time"]);
    }

    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If no errors, insert the booking data into the database
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($roomErr) && empty($paxErr) && empty($dateErr) && empty($timeErr) && empty($messageErr)) {

        $servername = "localhost";
        $username = "root"; 
        $password = "arjay040419";      
        $dbname = "booking_process";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the bookings table
        $sql = "INSERT INTO bookings (name, email, phone, room_type, pax, date, time, message) VALUES ('$name', '$email', '$phone', '$room_type', '$pax', '$date', '$time', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Booked Sucessful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
