<?php include "../../commonassets/header.php"; ?>

    <br><br><br><br><br>
    <h1>Pollution Certification Information</h1>
    <br>

    <form action="../../actions/admin/pollutioncertificate_issue.php" method="POST">
        <h2>Basic Information</h2>
        <table>
            <tr>
                <td>Registration Number:</td>
                <td><input type="text" name="register_no" required></td>
            </tr>
            <tr>
                <td>Testing Center Code:</td>
                <td><input type="number" name="testcode" required></td>
            </tr>
        </table>

        <br><br>
        <h2>Test Results</h2>
        <br>

        <table>
            <tr>
                <th>IDLE RPM</th>
                <th>MAX RPM</th>
                <th>OIL TEMP</th>
                <th>K VALUE</th>
            </tr>
            <tr>
                <td><input type="text" name="idle_rpm1" required></td>
                <td><input type="text" name="max_rpm1" required></td>
                <td><input type="text" name="oil_temp1" required></td>
                <td><input type="text" name="k_value1" required></td>
            </tr>
            <tr>
                <td><input type="text" name="idle_rpm2"></td>
                <td><input type="text" name="max_rpm2"></td>
                <td><input type="text" name="oil_temp2"></td>
                <td><input type="text" name="k_value2"></td>
            </tr>
            <tr>
                <td><input type="text" name="idle_rpm3"></td>
                <td><input type="text" name="max_rpm3"></td>
                <td><input type="text" name="oil_temp3"></td>
                <td><input type="text" name="k_value3"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>AVERAGE:</b></td>
                <td id="avg_k_value">0</td>
            </tr>
            <tr>
                <td>RESULT</td>
                <td>
                    <select name="result">
                        <option value="PASS">PASS</option>
                        <option value="FAIL">FAIL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fee charged:</td>
                <td><input type="number" name="fees" required></td>
            </tr>
        </table>
        <br><br>
        <input type="submit" value="Certify">
    </form>

    <script>
        // Auto Calculate Average K Value
        document.addEventListener("input", function() {
            let k1 = parseFloat(document.querySelector("[name='k_value1']").value) || 0;
            let k2 = parseFloat(document.querySelector("[name='k_value2']").value) || 0;
            let k3 = parseFloat(document.querySelector("[name='k_value3']").value) || 0;

            let count = 0;
            if (k1 > 0) count++;
            if (k2 > 0) count++;
            if (k3 > 0) count++;

            let avg = count > 0 ? (k1 + k2 + k3) / count : 0;
            document.getElementById("avg_k_value").innerText = avg.toFixed(2);
        });
    </script>

<?php include "../../commonassets/footer.php"; ?>
