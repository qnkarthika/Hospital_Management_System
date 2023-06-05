<!DOCTYPE html>
<html>
<head>
  <title>Patient Details</title>
  <style>
body{
    background: radial-gradient(circle, #B0E0E6, #90EE90);
}
.container {
max-width: 800px;
margin: 0 auto;
padding: 20px;
}

.container h1 {
text-align: center;
color: #333;
}

.container form {
margin-top: 20px;
}

.container label {
display: block;
margin-bottom: 5px;
color: #555;
}

.container input[type="text"],
.container input[type="number"],
.container input[type="tel"] {
width: 100%;
padding: 8px;
margin-bottom: 10px;
border: 1px solid #ccc;
border-radius: 4px;
}

.container input[type="submit"] {
width: 100%;
padding: 10px;
background-color: #4CAF50;
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
}

.container input[type="submit"]:hover {
background-color: #45a049;
}

.container .error-message {
color: red;
margin-top: 10px;
}

.container table {
width: 100%;
border-collapse: collapse;
}

.container th,
.container td {
padding: 8px;
text-align: left;
border-bottom: 1px solid #ddd;
}

.container th {
background-color: #4CAF50;
color: #fff;
}

.container tr:hover {
background-color: #f2f2f2;
}

.container .search-form {
margin-top: 20px;
width:980px;
}

.container .search-form input[type="text"] {
width: 80%;
padding: 8px;
margin-bottom: 10px;
border: 1px solid #ccc;
border-radius: 4px;
}

.container .search-form input[type="submit"] {
width: 18%;
padding: 10px;
background-color: #4CAF50;
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
}

.container .search-form input[type="submit"]:hover {
background-color: #45a049;
}
.container a {
      text-decoration: none;
    }
    .container button {
      display: block;
      margin: 20px auto;
      padding:10px 20px;
      font-size: 18px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .container button:hover {
      background-color: #45a049;
    }
   
</style>
</head>
<body>
    <div class="container" style="padding-right:0px;padding-left:680px">
    <a href="index.html"><button>Log out</button></a></div>
  <div class="container">
    <h1>Patient Details</h1>

    <!-- Search Form -->
    <div class="search-form">
      <form action="" method="GET">
        <input type="text" name="search" placeholder="Search by Phone Number">
        <input type="submit" value="Search"><br><br>
      </form>
    </div>

    <!-- Display Patient Records -->
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Phone Number</th>
          <th>Guardian Name</th>
          <th>Guardian Phone</th>
          <th>Room Number</th>
        </tr>
      </thead>
      <tbody>
      <?php
        // Database connection code
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'hospital_management';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch all patient records initially
        $query = "SELECT * FROM registration";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['phone_number']."</td>";
            echo "<td>".$row['guardian_name']."</td>";
            echo "<td>".$row['guardian_ph']."</td>";
            echo "<td>".$row['room_no']."</td>";
            echo "</tr>";
          }
        } else if (!$result) {
          echo "<tr><td colspan='7'>Error executing query: " . mysqli_error($conn) . "</td></tr>";
        } else {
          echo "<tr><td colspan='7'>No records found</td></tr>";
        }

        // Perform search if a phone number is provided
        if (isset($_GET['search'])) {
          $search = $_GET['search'];
          $query = "SELECT * FROM registration WHERE phone_number = '$search'";
          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            echo "<tr><td colspan='7'>Search Patient Details</td></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>".$row['name']."</td>";
              echo "<td>".$row['age']."</td>";
              echo "<td>".$row['gender']."</td>";
              echo "<td>".$row['phone_number']."</td>";
              echo "<td>".$row['guardian_name']."</td>";
              echo "<td>".$row['guardian_ph']."</td>";
              echo "<td>".$row['room_no']."</td>";
              echo "</tr>";
            }
          } else if (!$result) {
            echo "<tr><td colspan='7'>Error executing query: " . mysqli_error($conn) . "</td></tr>";
          } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
          }
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
