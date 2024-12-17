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

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$patient_id = $_GET['id'];

// Fetch patient data from the database
$sql = "SELECT * FROM patient_registry WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id); 
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

// Fetch the services selected for the patient
$selected_services = explode(',', $patient['services']);
$selected_services = array_map('trim', $selected_services);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient_registry.css">
    <title>Edit Patient Record</title>
</head>
<body>
    <div class="container">
        <div class="header">
        <h1>Edit Patient Record</h1>
            <div class="huh-button">
                <a href="patient_records.php">Back</a>
            </div>
        </div>
        <form method="POST" action="record_update.php?page=<?php echo $page; ?>&id=<?php echo $patient_id; ?>">
        <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
            <div class="form-group">
                <label for="registryDate">Date of Registry:</label>
                <input type="date" id="registryDate" name="registryDate" value="<?php echo $patient['registry_date']; ?>">
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $patient['last_name']; ?>">
            </div>

            <div class="form-group">
                <label for="givenName">Given Name:</label>
                <input type="text" id="givenName" name="givenName" value="<?php echo $patient['first_name']; ?>">
            </div>

            <div class="form-group">
                <label for="middleName">Middle Name:</label>
                <input type="text" id="middleName" name="middleName" value="<?php echo $patient['middle_name']; ?>">
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $patient['dob']; ?>">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $patient['age']; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $patient['email']; ?>">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $patient['address']; ?>">
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo $patient['mobile']; ?>">
            </div>

            <div class="form-group">
                <label for="appointmentDate">Appointment Schedule:</label>
                <input type="date" id="appointmentDate" name="appointmentDate" value="<?php echo $patient['appointment_date']; ?>">
            </div>

            <h2>Services:</h2>
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Diagnosis</th>
                            <th>Periodontics (Oral Prophylaxis)</th>
                            <th>Oral Surgery</th>
                            <th>Restorative</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Diagnosis: Consultation" <?php echo (in_array("Diagnosis: Consultation", $selected_services)) ? 'checked' : ''; ?>> Consultation</label><br>
                                <label><input type="checkbox" name="services[]" value="+ Medical Certificate" <?php echo (in_array("+ Medical Certificate", $selected_services)) ? 'checked' : ''; ?>> w/ Medical Certificate</label>
                            </td>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Periodontics (Oral Prohylaxis): Light-Moderate" <?php echo (in_array("Periodontics (Oral Prohylaxis): Light-Moderate", $selected_services)) ? 'checked' : ''; ?>> Light-Moderate</label><br>
                                <label><input type="checkbox" name="services[]" value="Periodontics (Oral Prohylaxis): Heavy" <?php echo (in_array("Periodontics (Oral Prohylaxis): Heavy", $selected_services)) ? 'checked' : ''; ?>> Heavy</label><br>
                                <label><input type="checkbox" name="services[]" value="+ Fluoride Treatment" <?php echo (in_array("+ Fluoride Treatment", $selected_services)) ? 'checked' : ''; ?>> w/ Fluoride Treatment</label>
                            </td>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Oral Surgery: Simple Extraction" <?php echo (in_array("Oral Surgery: Simple Extraction", $selected_services)) ? 'checked' : ''; ?>> Simple Extraction</label><br>
                                <label><input type="checkbox" name="services[]" value="Oral Surgery: Complicated Extraction" <?php echo (in_array("Oral Surgery: Complicated Extraction", $selected_services)) ? 'checked' : ''; ?>> Complicated Extraction</label><br>
                                <label><input type="checkbox" name="services[]" value="Oral Surgery: Odontectomy" <?php echo (in_array("Oral Surgery: Odontectomy", $selected_services)) ? 'checked' : ''; ?>> Odontectomy</label>
                            </td>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Restorative: Temporary" <?php echo (in_array("Temporary", $selected_services)) ? 'checked' : ''; ?>> Temporary</label><br>
                                <label><input type="checkbox" name="services[]" value="Restorative: Composite" <?php echo (in_array("Composite", $selected_services)) ? 'checked' : ''; ?>> Composite</label><br>
                                <label><input type="checkbox" name="services[]" value="Restorative: Additional Surface" <?php echo (in_array("Additional Surface", $selected_services)) ? 'checked' : ''; ?>> Additional Surface</label><br>
                                <label><input type="checkbox" name="services[]" value="Restorative: Pit & Fissure Sealant" <?php echo (in_array("Pit & Fissure Sealant", $selected_services)) ? 'checked' : ''; ?>> Pit & Fissure Sealant</label>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th>Repair</th>
                            <th>Prosthodontics</th>
                            <th>Orthodontics</th>
                            <th>Others</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Repair: Crack" <?php echo (in_array("Repair: Crack", $selected_services)) ? 'checked' : ''; ?>> Crack</label><br>
                                <label><input type="checkbox" name="services[]" value="Repair: Broken with Impression" <?php echo (in_array("Repair: Broken with Impression", $selected_services)) ? 'checked' : ''; ?>> Broken with Impression</label><br>
                                <hr><div>Missing Pontic:</div><hr>
                                <label><input type="checkbox" name="services[]" value="Repair (Missing Pontic): Plastic" <?php echo (in_array("Repair (Missing Pontic): Plastic", $selected_services)) ? 'checked' : ''; ?>> Plastic</label><br>
                                <label><input type="checkbox" name="services[]" value="Repair (Missing Pontic): Porcelain" <?php echo (in_array("Repair (Missing Pontic): Porcelain", $selected_services)) ? 'checked' : ''; ?>> Porcelain</label>
                            </td>
                            <td>
                                <hr>Jacket Crown Per Unit<hr>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics (Jacket Crown per Unit): Plastic" <?php echo (in_array("Prosthodontics (Jacket Crown per Unit): Plastic", $selected_services)) ? 'checked' : ''; ?>> Plastic</label><br>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics (Jacket Crown per Unit): Porcelain Simple Metal" <?php echo (in_array("Prosthodontics (Jacket Crown per Unit): Porcelain Simple Metal", $selected_services)) ? 'checked' : ''; ?>> Porcelain Simple Metal</label><br>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics (Jacket Crown per Unit): Porcelain Tilite" <?php echo (in_array("Prosthodontics (Jacket Crown per Unit): Porcelain Tilite", $selected_services)) ? 'checked' : ''; ?>> Porcelain Tilite</label><br>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics (Jacket Crown per Unit): E-max" <?php echo (in_array("Prosthodontics (Jacket Crown per Unit): E-max", $selected_services)) ? 'checked' : ''; ?>> E-max</label><br>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics (Jacket Crown per Unit): Zirconia" <?php echo (in_array("Prosthodontics (Jacket Crown per Unit): Zirconia", $selected_services)) ? 'checked' : ''; ?>> Zirconia</label><br><hr>
                                <label><input type="checkbox" name="services[]" value="Prosthodontics: Re-cementation" <?php echo (in_array("Prosthodontics: Re-cementation", $selected_services)) ? 'checked' : ''; ?>> Re-cementation</label>
                            </td>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Conventional Metal Brackets" <?php echo (in_array("Orthodontics: Conventional Metal Brackets", $selected_services)) ? 'checked' : ''; ?>> Conventional Metal Brackets</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Ceramic Brackets" <?php echo (in_array("Orthodontics: Ceramic Brackets", $selected_services)) ? 'checked' : ''; ?>> Ceramic Brackets</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Self-Ligating Metal Brackets" <?php echo (in_array("Orthodontics: Self-Ligating Metal Brackets", $selected_services)) ? 'checked' : ''; ?>> Self-Ligating Metal Brackets</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Functional Retainer" <?php echo (in_array("Orthodontics: Functional Retainer", $selected_services)) ? 'checked' : ''; ?>> Functional Retainer</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Retainer with Design" <?php echo (in_array("Orthodontics: Retainer with Design", $selected_services)) ? 'checked' : ''; ?>> Retainer with Design</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Ortho Kit" <?php echo (in_array("Orthodontics: Ortho Kit", $selected_services)) ? 'checked' : ''; ?>> Ortho Kit</label><br>
                                <label><input type="checkbox" name="services[]" value="Orthodontics: Ortho Wax" <?php echo (in_array("Orthodontics: Ortho Wax", $selected_services)) ? 'checked' : ''; ?>> Ortho Wax</label><br>
                            </td>
                            <td>
                                <label><input type="checkbox" name="services[]" value="Others: Teeth Whitening" <?php echo (in_array("Others: Teeth Whitening", $selected_services)) ? 'checked' : ''; ?>> Teeth Whitening</label><br>
                                <label><input type="checkbox" name="services[]" value="Others: Reline" <?php echo (in_array("Others: Reline", $selected_services)) ? 'checked' : ''; ?>> Reline</label><br>
                                <label><input type="checkbox" name="services[]" value="Others: Rebase" <?php echo (in_array("Others: Rebase", $selected_services)) ? 'checked' : ''; ?>> Rebase</label>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h3>Partial Denture per Arch (Upper or Lower)</h3>
                    <table border="1" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Pontic Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label><input type="checkbox" name="partial_denture[Stayplate_Plastic]" value="Stayplate Plastic" <?php if (in_array('Stayplate Plastic', explode(', ', $patient['partial_denture_service']))) echo 'checked'; ?>> Stayplate Plastic</label>
                                </td>
                                <td>
                                    <select name="partial_denture[Stayplate_Plastic_pontic_count]">
                                        <?php 
                                        for ($i = 1; $i <= 8; $i++) { 
                                            $selected = (in_array("Stayplate Plastic", explode(', ', $patient['partial_denture_service'])) && in_array($i, explode(', ', $patient['partial_denture_count']))) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" name="partial_denture[Stayplate_Porcelain]" value="Stayplate Porcelain" <?php if (in_array('Stayplate Porcelain', explode(', ', $patient['partial_denture_service']))) echo 'checked'; ?>> Stayplate Porcelain</label>
                                </td>
                                <td>
                                    <select name="partial_denture[Stayplate_Porcelain_pontic_count]">
                                        <?php 
                                        for ($i = 1; $i <= 8; $i++) { 
                                            $selected = (in_array("Stayplate Porcelain", explode(', ', $patient['partial_denture_service'])) && in_array($i, explode(', ', $patient['partial_denture_count']))) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" name="partial_denture[One_piece_Plastic]" value="One-piece Plastic" <?php if (in_array('One-piece Plastic', explode(', ', $patient['partial_denture_service']))) echo 'checked'; ?>> One-piece Plastic</label>
                                </td>
                                <td>
                                    <select name="partial_denture[One_piece_Plastic_pontic_count]">
                                        <?php 
                                        for ($i = 1; $i <= 8; $i++) { 
                                            $selected = (in_array("One-piece Plastic", explode(', ', $patient['partial_denture_service'])) && in_array($i, explode(', ', $patient['partial_denture_count']))) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" name="partial_denture[One_piece_Porcelain]" value="One-piece Porcelain" <?php if (in_array('One-piece Porcelain', explode(', ', $patient['partial_denture_service']))) echo 'checked'; ?>> One-piece Porcelain</label>
                                </td>
                                <td>
                                    <select name="partial_denture[One_piece_Porcelain_pontic_count]">
                                        <?php 
                                        for ($i = 1; $i <= 8; $i++) { 
                                            $selected = (in_array("One-piece Porcelain", explode(', ', $patient['partial_denture_service'])) && in_array($i, explode(', ', $patient['partial_denture_count']))) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" name="partial_denture[Flexite]" value="Flexite" <?php if (in_array('Flexite', explode(', ', $patient['partial_denture_service']))) echo 'checked'; ?>> Flexite</label>
                                </td>
                                <td>
                                    <select name="partial_denture[Flexite_pontic_count]">
                                        <?php 
                                        for ($i = 1; $i <= 8; $i++) { 
                                            $selected = (in_array("Flexite", explode(', ', $patient['partial_denture_service'])) && in_array($i, explode(', ', $patient['partial_denture_count']))) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Full Denture per Arch (Upper AND/OR Lower)</h3>
                        <table border="1" cellpadding="10">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Range</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="full_denture[Stayplate_Plastic]" value="Stayplate Plastic"
                                            <?php if (in_array("Stayplate Plastic", explode(', ', $patient['full_denture_service']))) echo 'checked'; ?>>
                                            Stayplate Plastic
                                        </label>
                                    </td>
                                    <td>
                                        <select name="full_denture[Stayplate_Plastic_range]">
                                            <?php 
                                            $ranges = ["Upper", "Lower", "Upper AND Lower"];
                                            foreach ($ranges as $option) {
                                                $selected = (in_array("Stayplate Plastic", explode(', ', $patient['full_denture_service'])) && in_array($option, explode(', ', $patient['full_denture_range']))) ? 'selected' : '';
                                                echo "<option value='$option' $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="full_denture[Stayplate_Porcelain]" value="Stayplate Porcelain"
                                            <?php if (in_array("Stayplate Porcelain", explode(', ', $patient['full_denture_service']))) echo 'checked'; ?>> Stayplate Porcelain
                                        </label>
                                    </td>
                                    <td>
                                        <select name="full_denture[Stayplate_Porcelain_range]">
                                            <?php 
                                            $ranges = ["Upper", "Lower", "Upper AND Lower"];
                                            foreach ($ranges as $option) {
                                                $selected = (in_array("Stayplate Porcelain", explode(', ', $patient['full_denture_service'])) && in_array($option, explode(', ', $patient['full_denture_range']))) ? 'selected' : '';
                                                echo "<option value='$option' $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="full_denture[Ivocap]" value="Ivocap"
                                            <?php if (in_array("Ivocap", explode(', ', $patient['full_denture_service']))) echo 'checked'; ?>> Ivocap
                                        </label>
                                    </td>
                                    <td>
                                        <select name="full_denture[Ivocap_range]">
                                            <?php 
                                            $ranges = ["Upper", "Lower", "Upper AND Lower"];
                                            foreach ($ranges as $option) {
                                                $selected = (in_array("Ivocap", explode(', ', $patient['full_denture_service'])) && in_array($option, explode(', ', $patient['full_denture_range']))) ? 'selected' : '';
                                                echo "<option value='$option' $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>   
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="Full_denture[Thermosen]" value="Thermosen"
                                            <?php if (in_array("SThermosen", explode(', ', $patient['full_denture_service']))) echo 'checked'; ?>> Thermosen
                                        </label>
                                    </td>
                                    <td>
                                        <select name="full_denture[Thermosen_range]">
                                            <?php 
                                            $ranges = ["Upper", "Lower", "Upper AND Lower"];
                                            foreach ($ranges as $option) {
                                                $selected = (in_array("Thermosen", explode(', ', $patient['full_denture_service'])) && in_array($option, explode(', ', $patient['full_denture_range']))) ? 'selected' : '';
                                                echo "<option value='$option' $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

            <div class="form-group">
                <label for="addInfo">Additional Info:</label>
                <textarea id="addInfo" name="addInfo"><?php echo $patient['add_info']; ?></textarea>
            </div>

            <div class="button-container">
                <button type="submit">Update Record</button>
            </div>
        </form>
    </div>
</body>
</html>
