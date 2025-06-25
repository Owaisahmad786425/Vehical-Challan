<?php include "../commonassets/header.php"; ?>
    <h1>User Dashboard</h1>
    <p style="padding-left: 24px;">Welcome to your dashboard! Here you can access all your transport-related information.</p>
    <br>

    <div class="dashboard-container">
        <div class="dashboard-box">
            <img src="icons/vehicle.png" alt="Vehicle">
            <h2>Vehicle Information</h2>
            <p>View details of your registered vehicles.</p>
            <a href="vehicleinfo.php" class="more-btn">More</a>
        </div>

        <div class="dashboard-box">
            <img src="icons/violations.png" alt="Violations">
            <h2>Traffic Violations</h2>
            <p>Check your pending traffic violations and fines.</p>
            <a href="violations.php" class="more-btn">More</a>
        </div>

        <div class="dashboard-box">
            <img src="icons/license.png" alt="License">
            <h2>Driver's License</h2>
            <p>View details of your driver's license.</p>
            <a href="driverinfo.php" class="more-btn">More</a>
        </div>

        <div class="dashboard-box">
            <img src="icons/complaints.png" alt="Complaints">
            <h2>Filed Complaints</h2>
            <p>See complaints filed against your vehicle.</p>
            <a href="complaints.php" class="more-btn">More</a>
        </div>
    </div>
<?php include "../commonassets/footer.php"; ?>

<style>
/* Dashboard Container */
.dashboard-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

/* Dashboard Boxes */
.dashboard-box {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 250px;
    max-width: 100%;
}
.dashboard-box img {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
}
.dashboard-box h2 {
    font-size: 18px;
    color: #000;
    margin-bottom: 10px;
}
.dashboard-box p {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}
.more-btn {
    display: inline-block;
    background: #007bff;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
}
.more-btn:hover {
    background: #0056b3;
}
</style>
