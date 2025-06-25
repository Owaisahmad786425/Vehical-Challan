<?php include "../../commonassets/header.php"; ?>
    <h1>Vehicle Registration</h1>
    <br>

    <form action="actions/vehicleregistrationhandler.php" method="POST">
        <h2>Basic Information</h2>
        <table>
            <tr>
                <td>Registration Number</td>
                <td><input type="text" name="register_no" required></td>
            </tr>
            <tr>
                <td>Class of Vehicle</td>
                <td><input type="text" name="class_of_vehicle" required></td>
            </tr>
            <tr>
                <td>Maker Name</td>
                <td><input type="text" name="maker_name" required></td>
            </tr>
            <tr>
                <td>Model Name</td>
                <td><input type="text" name="model_name" required></td>
            </tr>
            <tr>
                <td>License of Registered Owner</td>
                <td><input type="text" name="licence_owner" required></td>
            </tr>
        </table>

        <br><br>
        <h2>Vehicle Description</h2>
        <table>
            <tr>
                <td>Colour of Vehicle</td>
                <td><input type="text" name="vehicle_colour" required></td>
            </tr>
            <tr>
                <td>Seating Capacity</td>
                <td><input type="number" name="seating_capacity" required></td>
            </tr>
            <tr>
                <td>Body Type</td>
                <td><input type="text" name="body_type" required></td>
            </tr>
            <tr>
                <td>Month and Year of Manufacture</td>
                <td><input type="date" name="make_month_year" required></td>
            </tr>
            <tr>
                <td>Chassis Number</td>
                <td><input type="text" name="chassis_no" required></td>
            </tr>
            <tr>
                <td>Engine Number</td>
                <td><input type="text" name="engine_no" required></td>
            </tr>
            <tr>
                <td>Unladen Weight (kg)</td>
                <td><input type="number" name="unladen_weight" required></td>
            </tr>
            <tr>
                <td>Cubic Capacity (cc)</td>
                <td><input type="number" name="cubic_capacity" required></td>
            </tr>
            <tr>
                <td>Number of Cylinders</td>
                <td><input type="number" name="no_of_cylinders" required></td>
            </tr>
            <tr>
                <td>Fuel Type</td>
                <td>
                    <select name="fuel_type">
                        <option>Diesel</option>
                        <option>Petrol</option>
                        <option>Electric</option>
                        <option>Hybrid</option>
                        <option>CNG</option>
                        <option>LPG</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Emission Norms</td>
                <td>
                    <select name="emission_norms_stage" style="width:60%;">
                        <option>Bharat Stage</option>
                        <option>Euro</option>
                    </select>
                    <select name="emission_norms_level" style="width:38.7%;">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </td>
            </tr>
        </table>

        <br>
        <input type="submit" value="Register Vehicle">
    </form>
<?php include "../../commonassets/footer.php"; ?>
