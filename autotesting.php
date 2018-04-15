<?php
include("connection.php");
include("functions.php");

//begin testing with empty arrays
mysql_query("TRUNCATE TABLE People");
mysql_query("TRUNCATE TABLE Groups");

$error_codes = array("No Error", "Invalid Column Count", "Invalid Header Values", "Invalid Group Assignment", "Blank Group Name", "Duplicate Group Name");

$testing = 1;

//run the action script on several prepared files with named errors to check for proper error code

$filename = "Groups.csv";
include("action.php");

$filename = "People.csv";
include("action.php");


$filename = "GroupsHeaderOrderWrong.csv";
include("action.php");

$filename = "GroupsMissingID.csv";
include("action.php");

$filename = "GroupsMissingName.csv";
include("action.php");

$filename = "PeopleArchived.csv";
include("action.php");

$filename = "PeopleHeaderOrderWrong.csv";
include("action.php");

$filename = "PeopleInvalidGroupID.csv";
include("action.php");

$filename = "PeopleMissingGroupID.csv";
include("action.php");

$filename = "PeopleMissingHeaders.csv";
include("action.php");

$filename = "PeopleMissingID.csv";
include("action.php");



 ?>
