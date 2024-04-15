<?php
$db = mysqli_connect("localhost", "copo4474_fidelilium", "sFhOyiKn8i21yOpH6U", "copo4474_fidelilium");
if (!$db) {
    echo "failed";
    die("Connection failed: " . mysqli_connect_error());
}
