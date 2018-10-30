<!DOCTYPE html>
<html>
<head>
  <title>Insert Employee</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css-files/employee.css">
</head>
  <body>

    <div id="back" onclick="location.href='manager.html'">Back To Manager</div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "sakila";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $eMail = $_POST["emailAddress"];
    $sId = $_POST["storeId"];

    //$sql = "";

    $add = $_POST['address'];
    $dist = $_POST['district'];
    $cId = $_POST['cityId'];
    $pCode = $_POST['postalCode'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO address (address, district, city_id, postal_code, phone)
    VALUES ('$add',''$dist','$cId','$pCode','$phone')";
    $result = $conn->query($sql);


    $sql2 = "SELECT MAX(address_id) FROM address";
    $result2 = $conn->query($sql2);

    $row = mysqli_fetch_assoc($result2);
    $maxAdd = $row['MAX(address_id)'];


    $sql3 = "INSERT INTO staff (first_name, last_name, address_id, email, store_id)
    VALUES ('$fName', '$lName', $maxAdd, '$eMail', '$sId')";
    $result3 = $conn->query($sql);


    $conn->close();
     ?>
  </body>
</html>
