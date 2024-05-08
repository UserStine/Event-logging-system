<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "valco_incident";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $incident_date = $_POST["incident_year"] . "-" . $_POST["incident_month"] . "-" . $_POST["incident_day"];
    $incident_location = $_POST["incident_location"];
    $severity = $_POST["severity"];
    $incident_description = $_POST["incident_description"];
    $comments = $_POST["comments"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO Incidents (reported_by, incident_date, location, severity, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $incident_date, $incident_location, $severity, $incident_description);

    // Execute SQL query
    if ($stmt->execute() === TRUE) {
        echo "Incident reported successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
