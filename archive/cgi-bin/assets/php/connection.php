<?php
$db = mysqli_connect("localhost", "root", "root", "copo4474_fidelilium");
if (!$db) {
    echo "failed";
    die("Connection failed: " . mysqli_connect_error());
}
