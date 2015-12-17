<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$advId = $_POST['test'];

header("location: ./adventure.php?id=$advId");