<?php
// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "SQLroot@MySQL", "IRTLS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$registerNo = $_POST['register_no'];
$class = $_POST['class_of_vehicle'];
$makerName = $_POST['maker_name'];
$modelName = $_POST['model_name'];
$licenceOwner = $_POST['licence_owner'];
$colour = $_POST['vehicle_colour'];
$seatingCapacity = $_POST['seating_capacity'];
$bodyType = $_POST['body_type'];
$makeMonthYear = $_POST['make_month_year'];
$chassisNo = $_POST['chassis_no'];
$engineNo = $_POST['engine_no'];
$unladenWeight = $_POST['unladen_weight'];
$cubicCapacity = $_POST['cubic_capacity'];
$noOfCylinders = $_POST['no_of_cylinders'];
$fuel = $_POST['fuel_type'];
$emissionNorms = $_POST['emission_norms_stage'] . " " . $_POST['emission_norms_level'];

$dateOfRegistration = date("Y-m-d");
$registrationValidity = date("Y-m-d", strtotime("+15 years")); // Example: 15-year validity

// Insert Query
$query = "INSERT INTO VehicleInfo 
    (RegisterNo, MakerName, ModelName, BodyType, MakeMonthYear, SeatingCapacity, EmissionNorms, Fuel, EngineNo, Class, 
    RegistrationValidity, DateOfRegistration, ChassisNo, NoOfCylinders, Colour, CubicCapacity, UnladenWeight) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssisssssssssii",
        $registerNo, $makerName, $modelName, $bodyType, $makeMonthYear, $seatingCapacity, 
        $emissionNorms, $fuel, $engineNo, $class, $registrationValidity, $dateOfRegistration, 
        $chassisNo, $noOfCylinders, $colour, $cubicCapacity, $unladenWeight
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Vehicle Registered Successfully!";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
