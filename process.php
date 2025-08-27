<?php
// Club Registration Form Processing
// TODO: Add your PHP processing code here starting in Step 3

/* 
Step 3 Requirements:
- Process form data using $_POST
- Display submitted information back to user
- Handle name, email, and club fields

Step 4 Requirements:
- Add validation for all fields
- Check for empty fields
- Validate email format
- Display appropriate error messages

Step 5 Requirements:
- Store registration data in arrays
- Display list of all registrations
- Use loops to process array data

Step 6 Requirements:
- Add enhanced features like:
  - File storage for persistence
  - Additional form fields
  - Better error handling
  - Search functionality
*/

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$club = $_POST['club'] ?? '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($club)) {
        $errors[] = "Please select a club.";
    }

    if ($errors) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Display submitted info
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Club: $club</p>";
    }
}


session_start();

if (!isset($_SESSION['registrations'])) {
    $_SESSION['registrations'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) {
    $_SESSION['registrations'][] = [
        'name' => $name,
        'email' => $email,
        'club' => $club
    ];
}

// Display all registrations
if (!empty($_SESSION['registrations'])) {
    echo "<h2>All Registrations</h2><ul>";
    foreach ($_SESSION['registrations'] as $reg) {
        echo "<li>Name: {$reg['name']}, Email: {$reg['email']}, Club: {$reg['club']}</li>";
    }
    echo "</ul>";
}
?>
