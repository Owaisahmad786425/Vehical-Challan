<?php
    $regno = $_GET['vehicle_id'];
    $conn = mysqli_connect("localhost","root","SQLroot@MySQL","IRTLS");
    $query = "SELECT * FROM VehicleInfo WHERE RegisterNo='$regno'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $retRegisterNo = $row["RegisterNo"];
        $retMakerName = $row["MakerName"];
        $retModelName = $row["ModelName"];
        $retBodyType = $row["BodyType"];
        $retMakeMonthYear = $row["MakeMonthYear"];
        $retSeatingCapacity = $row["SeatingCapacity"];
        $retEmissionNorms = $row["EmissionNorms"];
        $retFuel = $row["Fuel"];
        $retEngineNo = $row["EngineNo"];
        $retClass = $row["Class"];
        $retRegistrationValidity = $row["RegistrationValidity"];
        $retDateOfRegistration = $row["DateOfRegistration"];
        $retChassisNo = $row["ChassisNo"];
        $retNoOfCylinders = $row["NoOfCylinders"];
        $retColour = $row["Colour"];
        $retCubicCapacity = $row["CubicCapacity"];
        $retUnladenWeight = $row["UnladenWeight"];
    }

    $query = "SELECT * FROM InsuranceDetails WHERE RegisterNo='$regno' ORDER BY IssueDate DESC";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $insurance_provider = $row["FinancierName"];
        $insurance_policy = $row["PackageName"];
        $insurance_issue = $row["IssueDate"];
        $insurance_expiry = $row["EndDate"];
    }
    else{
        $insurance_provider = '';
        $insurance_policy = '';
        $insurance_issue = '';
        $insurance_expiry = '';
    }

    $query = "SELECT * FROM PollutionCertificate WHERE RegisterNo='$regno' ORDER BY DateTime DESC";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $pollution_cert = $row["CertificateSlNo"];
        $pollution_issued = $row["DateTime"];
        $pollution_expiry = $row["ValidUpto"];
    }
    else{
        $pollution_cert = '';
        $pollution_issued = '';
        $pollution_expiry = '';
    }

    echo json_encode([
        'registration_no' => $retRegisterNo,
        'maker_name' => $retMakerName,
        'model_name' => $retModelName,
        'body_type' => $retBodyType,
        'make_month_year' => $retMakeMonthYear,
        'seating_capacity' => $retSeatingCapacity,
        'emission_norms' => $retEmissionNorms,
        'fuel' => $retFuel,
        'engine_no' => $retEngineNo,
        'class' => $retClass,
        'registration_validity' => $retRegistrationValidity,
        'date_of_registration' => $retDateOfRegistration,
        'chassis_no' => $retChassisNo,
        'no_of_cylinders' => $retNoOfCylinders,
        'colour' => $retColour,
        'cubic_capacity' => $retCubicCapacity,
        'unladen_weight' => $retUnladenWeight,
        'insurance_provider' => $insurance_provider,
        'insurance_policy' => $insurance_policy,
        'insurance_expiry' => $insurance_expiry,
        'insurance_issue' => $insurance_issue,
        'pollution_cert' => $pollution_cert,
        'pollution_issued' => $pollution_issued,
        'pollution_expiry' => $pollution_expiry
    ]);


?>
