<?php require "application/config/database.php";

// Gets data from URL parameters.
if(isset($_GET['add_stadium'])) {
    add_stadium();
}


function add_stadium(){
    $con=mysqli_connect ("localhost", '1506436', 'b9mafia786','db1506436');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    // Inserts new row with stadium data. (admin panel)
    $query = sprintf("INSERT INTO wd_stadiums " .
        " (stadiumID, team, sName, city, stadium, capacity, lat, lng, country) " .
        " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
        mysqli_real_escape_string($con,$lat),
        mysqli_real_escape_string($con,$lng));

    $result = mysqli_query($con,$query);
    echo json_encode("Inserted Successfully");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
}
function get_stadium(){
    $con=mysqli_connect ("localhost", '1506436', 'b9mafia786','db1506436');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // select coordinates from table
    $sqldata = mysqli_query($con,"SELECT lng,lat from wd_stadiums");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}

?>
