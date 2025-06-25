<?php include "commonassets/header.php"; ?>

    <section class="hero">
        <div class="hero-content">
            <h2>Efficient. Transparent. Integrated.</h2>
            <p>Manage your vehicle registrations, licenses, insurance, and violations all in one place.</p>
            <a href="user_login.php" class="btn">Access Your Account</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Key Features</h2>
            <h3 style="margin-bottom: 4px;">Select the module to login</h3>
            <div class="feature-list">
                <div class="feature" onclick="location.replace('user_login.php')">
                    <h3>For Users</h3>
                    <ul>
                        <li>View vehicle & license details</li>
                        <li>Check & renew insurance & certificates</li>
                        <li>Manage fines & violations</li>
                        <li>View complaints against your vehicle</li>
                    </ul>
                </div>
                <div class="feature" onclick="location.replace('admin/admin_login.php')">
                    <h3>For Authorities</h3>
                    <ul>
                        <li>Register vehicles & drivers</li>
                        <li>Track & enforce penalties</li>
                        <li>Manage complaints & violations</li>
                        <li>Ensure real-time data accuracy</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <div class="container">
            <h2>File a complaint against rash driving?</h2>
            <a href="filecomplaint.php" class="btn">Report Here!</a>
        </div>
    </section>

<?php include "commonassets/footer.php"; ?>


<style>
    /* Hero Section */
.hero {
    background: url('road_background.png') no-repeat center center/cover;
    height: 350px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
}

.hero-content {
    background: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
}

.hero h2 {
    font-size: 36px;
}

.hero p {
    font-size: 18px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
}

.btn:hover {
    background: #2980b9;
}

/* Features Section */
.features {
    padding: 40px 20px;
    background: white;
    text-align: center;
}

.feature-list {
    display: flex;
    justify-content: center;
    gap: 50px;
}

.feature {
    background: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    width: 250px;
}

.feature:hover {
    border: 2px solid #0770e3;
}

.feature h3 {
    color: #2c3e50;
}

.feature ul {
    list-style-type: none;
    padding: 0;
}

.feature ul li {
    padding: 5px 0;
}

/* Call to Action */
.cta {
    background: #2c3e50;
    color: white;
    padding: 40px;
    text-align: center;
}

.cta .btn {
    margin: 10px;
}

.admin-btn {
    background: #e74c3c;
}

.admin-btn:hover {
    background: #c0392b;
}
</style>
