<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "oro-va_dental_records"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$patientId = $_POST['id'] ?? '';
$registryDate = $_POST['registryDate'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$givenName = $_POST['givenName'] ?? '';
$middleName = $_POST['middleName'] ?? '';
$dob = $_POST['dob'] ?? '';
$age = $_POST['age'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$appointmentDate = $_POST['appointmentDate'] ?? '';
$addInfo = $_POST['addInfo'] ?? '';

// Handle the services (checkboxes)
$services = isset($_POST['services']) ? implode(", ", $_POST['services']) : '';

// Handle partial denture data (with pontic counts from select)
$partialDenture = [];
$partialDentureCount = [];
if (isset($_POST['partial_denture'])) {
    // Iterate over the selected partial denture types
    foreach ($_POST['partial_denture'] as $key => $value) {
        if (isset($_POST["partial_denture"][$key . "_pontic_count"])) {
            $count = $_POST["partial_denture"][$key . "_pontic_count"];
            $partialDenture[] = $value;
            $partialDentureCount[] = $count;
        }
    }
}
$partialDentureStr = implode(", ", $partialDenture);
$partialDentureCountStr = implode(", ", $partialDentureCount);

// Handle full denture data (with range)
$fullDenture = [];
$fullDentureRanges = [];
if (isset($_POST['full_denture'])) {
    // Iterate over the selected full denture types
    foreach ($_POST['full_denture'] as $key => $value) {
        if (isset($_POST["full_denture"][$key . "_range"])) {
            $range = $_POST["full_denture"][$key . "_range"];
            $fullDenture[] = $value;
            $fullDentureRanges[] = $range;
        }
    }
}
$fullDentureStr = implode(", ", $fullDenture);
$fullDentureRangesStr = implode(", ", $fullDentureRanges);

// Prepare SQL query
$sql = "UPDATE patient_registry SET 
    registry_date = ?, 
    first_name = ?, 
    middle_name = ?, 
    last_name = ?, 
    dob = ?, 
    age = ?, 
    email = ?, 
    address = ?, 
    mobile = ?, 
    appointment_date = ?, 
    services = ?, 
    partial_denture_service = ?, 
    partial_denture_count = ?, 
    full_denture_service = ?, 
    full_denture_range = ?, 
    add_info = ? 
WHERE id = ?";

// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssissssssssssi", 
    $registryDate, $lastName, $givenName, $middleName, $dob, $age, $email, $address, 
    $mobile, $appointmentDate, $services, $partialDentureStr, $partialDentureCountStr, 
    $fullDentureStr, $fullDentureRangesStr, $addInfo, $patientId
);

$page = isset($_GET['page']) ? $_GET['page'] : 1;  // Capture page number

if ($stmt->execute()) {
    echo "<script>
            alert('Record Updated successfully.');
            window.location.href = 'patient_records.php?page=" . $page . "';
          </script>";
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
