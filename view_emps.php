<html>
  <head>
    <title>Add Employee</title>
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

    $sql = "SELECT * FROM sakila.staff";
    $result = $conn->query($sql);

    print "<h1>Employee Table</h1>";
    print "<div id=\"table\">";
    print "<table>";
    print "<tr><th>Last Name</th> <th>First Name</th> <th>City</th>
           <th>Country</th> </th><th>Address</th> <th>District</th>
           <th>Postal Code</th> <th>Phone Number</th> <th> Email Address</th></tr>";
    if ($result->num_rows > 0) {
    // output data of each row

      while($row = $result->fetch_assoc()) {
        print "<tr><td>".$row["last_name"]."</td><td>".$row["first_name"]."</td>";
          //Getting address from foreign key
          if($row["address_id"] !== null) {
            $addressId = $row["address_id"];
            $sql2 = "SELECT * FROM sakila.address WHERE address_id= $addressId ORDER BY address_id ";
            $result2 = $conn->query($sql2);

            while($row2 = $result2->fetch_assoc()) {

              //Getting city from foreign key
              if($row2["city_id"] !==null) {
                $cityId = $row2["city_id"];
                $sql3 = "SELECT * FROM sakila.city WHERE city_id=$cityId ORDER BY city_id ";
                $result3 = $conn->query($sql3);

                while($row3 = $result3->fetch_assoc()){
                  print "<td>".$row3["city"]."</td>";

                  //Getting country from foreign key
                  if($row3["country_id"] !==null) {
                    $countryID = $row3["country_id"];
                    $sql4 = "SELECT * FROM sakila.country WHERE country_id=$countryID ORDER BY country_id";
                    $result4 = $conn->query($sql4);

                    while($row4 = $result4->fetch_assoc()) {
                      print "<td>".$row4["country"]."</td>";
                    }
                  }
                  else print("<td>no country</td>");
                }
              }
              else print("<td>no city</td>");

              print "<td>".$row2["address"]."</td><td>".$row2["district"].
              "</td>";
              if ($row2["postal_code"] !== "" || $row2["postal_code"] !== null) {
              //if there is no postal code in db
                print "<td>NO DATA</td>";
            }
            else print "<td>".$row2["postal_code"]."</td>";

            print "<td>".$row2["phone"]."</td>";
            }
          }
          else print("<td>no address</td>");

          print "<td>".$row["email"]."</td>";
      }
    } else {
        echo "0 results";
      }
    print "</table>";
    print "</div>";

    $conn->close();
    ?>
  </body>
</html>
