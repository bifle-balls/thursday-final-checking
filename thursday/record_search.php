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

// Get the search term from the URL (if present)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Base SQL query to select patient records
$sql = "SELECT * FROM patient_registry";

// If there's a search term, modify the query to filter the results
if (!empty($searchTerm)) {
    $sql .= " WHERE first_name LIKE ? OR last_name LIKE ? OR services LIKE ? OR id LIKE ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// If search term is present, bind it to the query
if (!empty($searchTerm)) {
    $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for partial matches
    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Display the records
while ($row = $result->fetch_assoc()) {
    echo "<div class='record'>";
    echo "<div class='category'><label>Patient ID:</label> " . $row["id"] . "</div>";
    echo "<div class='category'><label>Name:</label> " . $row["first_name"] . " " . $row["last_name"] . "</div>";
    // Display more fields here as needed (e.g., services, appointment date, etc.)
    echo "</div>";
}

// Close the connection
$stmt->close();
$conn->close();
?>
