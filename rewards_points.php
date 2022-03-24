<?php
$servername = "localhost";
$username = "studykik_study";
$password = ",!y@E;zZZ+UJ";
$dbname = "studykik_studykik";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * from `0gf1ba_subscriber_list` where answers_get='2'";
$result = mysqli_query($conn, $sql);
echo"<pre>";
print_r($wpdb);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {}
}
else {
    echo "0 results";
}
mysqli_close($conn);
?>