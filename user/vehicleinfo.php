<?php
        $conn = mysqli_connect("localhost","root","SQLroot@MySQL","IRTLS");
        $username = $_COOKIE['uname'];

        $query = "SELECT * FROM CommonUsers WHERE UserID='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            $LicenseNo = $row["LicenseNo"];
        }

        $query = "SELECT RegisterNo FROM OwnedBy WHERE LicenseNo='$LicenseNo'";
        $result = mysqli_query($conn, $query);
        $vehicles = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), "RegisterNo");

        // Convert the array of vehicle RegisterNos into a comma-separated string
        $vehicleList = implode("','", array_map(function($vehicle) use ($conn) {
            return mysqli_real_escape_string($conn, $vehicle);
            }, $vehicles));

        // Add single quotes around the vehicle IDs for SQL syntax and add the IN clause
        $query = "SELECT * FROM VehicleInfo WHERE RegisterNo IN ('$vehicleList')";
        $result = mysqli_query($conn, $query);

        $allvehicles = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $allvehicles[] = $row;
        }
    ?>

<?php include "../commonassets/header.php"; ?>
    <h1>Vehicle Information</h1>
    <p>Select a vehicle to view its details.</p>
    <br>

    <form>
        <label for="vehicleSelect">Select Your Vehicle:</label>
        <select id="vehicleSelect" name="vehicleSelect">
            <option value="" disabled selected>Select a vehicle</option>
            <?php foreach ($allvehicles as $vehicle): ?>
                <option value="<?= $vehicle['RegisterNo'] ?>"><?= htmlspecialchars($vehicle['MakerName']) ?> <?= htmlspecialchars($vehicle['ModelName']) ?> (<?= htmlspecialchars($vehicle['RegisterNo']) ?>)</option>
            <?php endforeach; ?>
        </select>
    </form>

    <br>

    <!-- Vehicle Details -->
    <div id="vehicleDetails" class="info-box">
        <h2>Vehicle Details</h2>
        <p><b>Registration Number:</b> <span id="vehicleReg">-</span></p>
        <p><b>Maker Name:</b> <span id="vehicleMaker">-</span></p>
        <p><b>Model Name:</b> <span id="vehicleModel">-</span></p>
        <p><b>Body Type:</b> <span id="vehicleBodyType">-</span></p>
        <p><b>Make Month & Year:</b> <span id="vehicleMakeMonthYear">-</span></p>
        <p><b>Seating Capacity:</b> <span id="vehicleSeatingCapacity">-</span></p>
        <p><b>Emission Norms:</b> <span id="vehicleEmissionNorms">-</span></p>
        <p><b>Fuel:</b> <span id="vehicleFuel">-</span></p>
        <p><b>Engine Number:</b> <span id="vehicleEngineNo">-</span></p>
        <p><b>Class:</b> <span id="vehicleClass">-</span></p>
        <p><b>Registration Validity:</b> <span id="vehicleRegistrationValidity">-</span></p>
        <p><b>Date of Registration:</b> <span id="vehicleDateOfRegistration">-</span></p>
        <p><b>Chassis Number:</b> <span id="vehicleChassisNo">-</span></p>
        <p><b>Number of Cylinders:</b> <span id="vehicleNoOfCylinders">-</span></p>
        <p><b>Colour:</b> <span id="vehicleColour">-</span></p>
        <p><b>Cubic Capacity:</b> <span id="vehicleCubicCapacity">-</span></p>
        <p><b>Unladen Weight:</b> <span id="vehicleUnladenWeight">-</span></p>
    </div>

    <div id="insureDetails" class="info-box">
        <h2>Insurance Details</h2>
        <p><b>Provider:</b> <span id="insuranceProvider">-</span></p>
        <p><b>Policy Number:</b> <span id="insurancePolicy">-</span></p>
        <p><b>Expiry Date:</b> <span id="insuranceExpiry">-</span></p>
    </div>

    <div id="pollutionDetails" class="info-box">
        <h2>Pollution Details</h2>
            <p><b>Certificate Number:</b> <span id="pollutionCert">-</span></p>
            <p><b>Issued Date:</b> <span id="pollutionIssued">-</span></p>
            <p><b>Expiry Date:</b> <span id="pollutionExpiry">-</span></p>
    </div>

    <script>
        document.getElementById("vehicleSelect").addEventListener("change", function () {
            let vehicleId = this.value;
            if (vehicleId) {
                fetch("../actions/fetch_vehicle_info.php?vehicle_id=" + vehicleId)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("vehicleReg").innerText = data.registration_no;
                        document.getElementById("vehicleMaker").innerText = data.maker_name;
                        document.getElementById("vehicleModel").innerText = data.model_name;
                        document.getElementById("vehicleBodyType").innerText = data.body_type;
                        document.getElementById("vehicleMakeMonthYear").innerText = data.make_month_year;
                        document.getElementById("vehicleSeatingCapacity").innerText = data.seating_capacity;
                        document.getElementById("vehicleEmissionNorms").innerText = data.emission_norms;
                        document.getElementById("vehicleFuel").innerText = data.fuel;
                        document.getElementById("vehicleEngineNo").innerText = data.engine_no;
                        document.getElementById("vehicleClass").innerText = data.class;
                        document.getElementById("vehicleRegistrationValidity").innerText = data.registration_validity;
                        document.getElementById("vehicleDateOfRegistration").innerText = data.date_of_registration;
                        document.getElementById("vehicleChassisNo").innerText = data.chassis_no;
                        document.getElementById("vehicleNoOfCylinders").innerText = data.no_of_cylinders;
                        document.getElementById("vehicleColour").innerText = data.colour;
                        document.getElementById("vehicleCubicCapacity").innerText = data.cubic_capacity;
                        document.getElementById("vehicleUnladenWeight").innerText = data.unladen_weight;

                        document.getElementById("insuranceProvider").innerText = data.insurance_provider;
                        document.getElementById("insurancePolicy").innerText = data.insurance_policy;
                        document.getElementById("insuranceExpiry").innerText = data.insurance_expiry;

                        document.getElementById("pollutionCert").innerText = data.pollution_cert;
                        document.getElementById("pollutionIssued").innerText = data.pollution_issued;
                        document.getElementById("pollutionExpiry").innerText = data.pollution_expiry;
                        
                        document.getElementById("vehicleDetails").style.display = "block";
                        document.getElementById("insureDetails").style.display = "block";
                        document.getElementById("pollutionDetails").style.display = "block";
                    })
                    .catch(error => console.error("Error fetching vehicle details:", error));
            }
        });
    </script>

<?php include "../commonassets/footer.php"; ?>
<style>
form {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    font-weight: bold;
}

select {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
/* Vehicle Details */
.info-box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    max-width: 600px;
    margin: auto;
    margin-top: 32px;
    display: none;
}

}
</style>
