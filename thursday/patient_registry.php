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

// Function to calculate age based on DOB
function calculateAge($dob) {
    if (empty($dob)) {
        return null; // Return null if DOB is empty
    }
    $dobDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($dobDate)->y;
    return $age;
}

// Collect form data
$registryDate = $_POST['registryDate'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$givenName = $_POST['givenName'] ?? '';
$middleName = $_POST['middleName'] ?? '';
$dob = $_POST['dob'] ?? '';
$age = calculateAge($dob); 
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$appointmentDate = $_POST['appointmentDate'] ?? '';
$appointmentStartTime = $_POST['appointmentStartTime'] ?? '';  // Appointment Start Time
$appointmentEndTime = $_POST['appointmentEndTime'] ?? '';  // Appointment End Time
$addInfo = $_POST['addInfo'] ?? '';

// Combine date and time for start and end time
$appointmentStartDatetime = $appointmentDate . ' ' . $appointmentStartTime;
$appointmentEndDatetime = $appointmentDate . ' ' . $appointmentEndTime;

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

// Step 1: Check if the appointment date already exists
$sqlCheckDate = "SELECT * FROM patient_registry WHERE appointment_date = ?";
$stmtCheckDate = $conn->prepare($sqlCheckDate);
$stmtCheckDate->bind_param("s", $appointmentDate);
$stmtCheckDate->execute();
$result = $stmtCheckDate->get_result();

// Step 2: Check for time conflicts if the appointment date exists
$timeConflict = false;
if ($result->num_rows > 0) {
    // Check if the appointment time overlaps with an existing time on the same date
    while ($row = $result->fetch_assoc()) {
        $existingStartTime = $row['appointment_start_time'];
        $existingEndTime = $row['appointment_end_time'];

        // Allow appointments to start exactly when the previous one ends
        // Time conflict if the new appointment's start time is before the existing one ends
        // or if the new appointment's end time is after the existing one starts
        if (($appointmentStartTime < $existingEndTime && $appointmentEndTime > $existingStartTime)) {
            $timeConflict = true;
            break; // Exit loop once conflict is detected
        }
    }
}

if ($timeConflict) {
    echo "<script>alert('This appointment time overlaps with an existing appointment. Please choose another time.'); window.location.href = 'patient_registry.html';</script>";
    exit();
} else {
    // Proceed with the INSERT query if no conflict
    $sql = "INSERT INTO patient_registry (
        registry_date, last_name, first_name, middle_name, dob, age, email, address, mobile, appointment_date, 
        appointment_start_time, appointment_end_time, services, partial_denture_service, partial_denture_count, full_denture_service, full_denture_range, add_info
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssississsssssss", 
        $registryDate, $lastName, $givenName, $middleName, $dob, $age, $email, $address, 
        $mobile, $appointmentDate, $appointmentStartTime, $appointmentEndTime, $services, $partialDentureStr, 
        $partialDentureCountStr, $fullDentureStr, $fullDentureRangesStr, $addInfo
    );

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Patient registered successfully.'); window.location.href = 'patient_registry.html';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the connection
$stmtCheckDate->close();
$stmt->close();
$conn->close();
?>
