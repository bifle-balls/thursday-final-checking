<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient_records.css">
    <title>Patient Records</title>
</head>
<body>

<div class="container">
    <div class="header-and-form">
        <h3>Patient Records</h3>
        <form method="GET">
            <input type="text" name="search" placeholder="Enter search term" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
            
            <select name="search_category">
                <option value="name" <?php echo (isset($_GET['search_category']) && $_GET['search_category'] == 'name') ? 'selected' : ''; ?>>Search in Name</option>
                <option value="services" <?php echo (isset($_GET['search_category']) && $_GET['search_category'] == 'services') ? 'selected' : ''; ?>>Search in Services</option>
                <option value="address" <?php echo (isset($_GET['search_category']) && $_GET['search_category'] == 'address') ? 'selected' : ''; ?>>Search in Address</option>
            </select>
            
            <button type="submit">Search</button>
            <a href="patient_records.php">Reset</a>
        </form>
    </div>

    <div class="half">
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

        // Pagination logic
        $records_per_page = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;

        // Get the search term from the URL (if present)
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $searchCategory = isset($_GET['search_category']) ? $_GET['search_category'] : 'name'; // Default to 'name' if no category is selected

        // Base SQL query to fetch filtered records
        $sql = "SELECT * FROM patient_registry";

        // Adjust the SQL query based on the search category
        if (!empty($searchTerm)) {
            if ($searchCategory == 'name') {
                $sql .= " WHERE first_name LIKE ? OR last_name LIKE ?";
            } elseif ($searchCategory == 'services') {
                // Include full_denture_service and partial_denture_service in search
                $sql .= " WHERE services LIKE ? OR full_denture_service LIKE ? OR partial_denture_service LIKE ?";
            } elseif ($searchCategory == 'address') {
                $sql .= " WHERE address LIKE ?";
            }
        }

        // Apply pagination to the query
        $sql .= " LIMIT ?, ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // If search term is provided, bind it to the query
        if (!empty($searchTerm)) {
            $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for partial matches

            // Bind the appropriate number of parameters based on the search category
            if ($searchCategory == 'name') {
                $stmt->bind_param("ssii", $searchTerm, $searchTerm, $offset, $records_per_page);
            } elseif ($searchCategory == 'services') {
                // Bind search term for services, full_denture_service, and partial_denture_service
                $stmt->bind_param("ssssi", $searchTerm, $searchTerm, $searchTerm, $offset, $records_per_page);
            } else {
                $stmt->bind_param("si", $searchTerm, $offset, $records_per_page);
            }
        } else {
            // No search term, bind only the pagination parameters
            $stmt->bind_param("ii", $offset, $records_per_page);
        }

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='record'>";
                echo "<div><label>Registered Date:</label> " . $row["registry_date"] . "</div>";
                echo "<div><label>Date of Appointment:</label> " . $row["appointment_date"] . "</div>";
                echo "<div><label>Name:</label> " . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . "</div>";
                echo "<div><label>Birthday:</label> " . $row["dob"] . "</div>";
                echo "<div><label>Age:</label> " . $row["age"] . "</div>";
                echo "<div><label>Address:</label> " . $row["address"] . "</div>";
                echo "<div><label>Email:</label> " . $row["email"] . "</div>";
                echo "<div><label>Contact Number:</label> " . $row["mobile"] . "</div>";
                echo "<div><label>Service/s:</label> " . $row["services"] . "</div>";

                if (!empty($row["partial_denture_service"]) && !empty($row["partial_denture_count"])) {
                    $services = explode(", ", $row["partial_denture_service"]);
                    $counts = explode(", ", $row["partial_denture_count"]);
                
                    $formattedServices = [];
                    for ($i = 0; $i < count($services); $i++) {
                        $formattedServices[] = $services[$i] . ": " . $counts[$i];
                    }
                
                    $formattedServiceString = implode(", ", $formattedServices);
                    echo "<div class='sub-category'><label>Partial Denture Service:</label> " . $formattedServiceString . "</div>";
                }

                if (!empty($row["full_denture_service"]) && !empty($row["full_denture_range"])) {
                    $services = explode(", ", $row["full_denture_service"]);
                    $ranges = explode(", ", $row["full_denture_range"]);

                    $formattedServices = [];
                    for ($i = 0; $i < count($services); $i++) {
                        $formattedServices[] = $services[$i] . ": " . $ranges[$i];
                    }

                    $formattedServiceString = implode(", ", $formattedServices);

                    echo "<div class='sub-category'><label>Full Denture Service:</label> " . $formattedServiceString . "</div>";
                }

                echo "<div class='sub-category'><label>Additional Info:</label> " . $row["add_info"] . "</div>";

                echo "<div><button class=\"edit-button\" onclick=\"window.location.href='record_edit.php?id=" . $row["id"] . "&page=" . (isset($_GET['page']) ? $_GET['page'] : 1) . "'\">Edit</button></div>";
                echo "</div>";
            }
        } else {
            echo "<p>No records found.</p>";
        }

        // Get total records to calculate page count based on search term and category
        if (!empty($searchTerm)) {
            if ($searchCategory == 'name') {
                $total_records_sql = "SELECT COUNT(*) as total FROM patient_registry WHERE first_name LIKE ? OR last_name LIKE ?";
                $stmt = $conn->prepare($total_records_sql);
                $stmt->bind_param("ss", $searchTerm, $searchTerm);
            } elseif ($searchCategory == 'services') {
                $total_records_sql = "SELECT COUNT(*) as total FROM patient_registry WHERE services LIKE ?";
                $stmt = $conn->prepare($total_records_sql);
                $stmt->bind_param("s", $searchTerm);
            } elseif ($searchCategory == 'address') {
                $total_records_sql = "SELECT COUNT(*) as total FROM patient_registry WHERE address LIKE ?";
                $stmt = $conn->prepare($total_records_sql);
                $stmt->bind_param("s", $searchTerm);
            }
        } else {
            // Total records without search filter
            $total_records_sql = "SELECT COUNT(*) as total FROM patient_registry";
            $stmt = $conn->prepare($total_records_sql);
        }

        $stmt->execute();
        $total_result = $stmt->get_result();
        $total_row = $total_result->fetch_assoc();
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $records_per_page);

        $conn->close();
        ?>
    </div>
    <div class="page-selector">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            $activeClass= ($i == $page) ? "active-page" : "";
            echo "<a href='?page=$i&search=" . htmlspecialchars($searchTerm) . "&search_category=" . htmlspecialchars($searchCategory) . "' class='$activeClass'>$i</a> ";
        }
        ?>
    </div>
    <div class ="bruh-button">
        <a href="patient_registry.html">Go to Registry</a>
    </div>
</div>

</body>
</html>
