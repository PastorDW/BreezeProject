<?php
include("connection.php");
if(!$testing)
  include("functions.php");

if(!$testing)
  $filename = $_GET['filename'];

$folder = ($testing)? "testfiles":"uploads";

$row = 1;
$table = "";
$keys = "";
$id_name = "";
$id_index = 0;
$group_index = 0;
$error = 0;
$peopleHeaders = array("person_id", "first_name", "last_name", "email_address", "group_id", "state");
$groupHeaders = array("group_id", "group_name");

ini_set('auto_detect_line_endings',TRUE);

if (($handle = fopen("$folder/$filename", "r")) !== FALSE)
{
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
        $num = count($data);

        //Process header row
        if($row == 1)
        {
          if($num == 6)
          {
            $table = "People";
            $id_name = "person_id";
          }
          else if($num == 2)
          {
            $table = "Groups";
            $id_name = "group_id";
          }
          //Handle error
          else
          {
            $error = 1;
            if(!$testing) echo "<h2>Uh oh!</h2><p>There is a problem with your upload. Check that you have the proper data columns.<br /><br />Please check your file and try again.</p>";
            break;
          }

          if($table)
            $keys = $data;

          //if the headers are not what they should be, throw an error
          if(($table == "People" && array_diff($peopleHeaders, $keys)) || ($table == "Groups" && array_diff($groupHeaders, $keys)))
          {
            $error = 2;
            if(!$testing) echo "<h2>Uh oh!</h2><p>There is a problem with your upload. Check that you have the proper headers for your data columns.<br /><br />Please check your file and try again.</p>";
            break;
          }

          //find the column with the id number in it in case it's not the first column
          $id_index = array_search($id_name, $keys);

          $group_index = array_search("group_id", $keys);

        }
        //Process data rows
        else
        {


          $id = $data[$id_index];


          //check to see if assigned to a group not yet existing
          $group_id = $data[$group_index];
          if($table == "People" && !mysqlFetchObject("Groups", "group_id = '$group_id'"))
          {
            $error = 3;
            if(!$testing) echo "<h2>Uh oh!</h2><p>There is a problem with your upload. Looks like you assigned one or more persons to a group that is not in our records.<br /><br />Please check your file and try again.</p>";
            break;
          }



          if($table == "Groups")
          {
            $group_name_index = ($id_index)? 0:1;
            $group_name = $data[$group_name_index];

            //if group name is blank, throw an error
            if(!$group_name)
            {
              $error = 4;
              if(!$testing) echo "<h2>Uh oh!</h2><p>There is a problem with your upload. You have a group without a name!<br /><br />Please check your file and try again.</p>";
              break;

            }

            //check to see if a duplicate group name is being added without an id
            if(!$group_id && mysqlFetchObject("Groups", "group_name = '$group_name'"))
            {
              $error = 5;
              if(!$testing) echo "<h2>Uh oh!</h2><p>There is a problem with your upload. You have a duplicate group masquerading as a new group!<br /><br />Please check your file and try again.</p>";
              break;

            }

          }

          //check to see if id is already taken
          if(mysqlFetchObject($table, "$id_name = '$id'"))
          {
            //if id taken, then update that row
            mysqlUpdateArray($table, $keys, $data, "$id_name = '$id'");

          }
          else
          {
            //If id not already taken, then insert a new row
            mysqlInsertArray($table, $keys, $data);
          }
        }
        $row++;

    }
    fclose($handle);
}
ini_set('auto_detect_line_endings',FALSE);

/*
* Now display the data from the database
*/

if(!$error && !$testing):

echo "<h2>Below is your current list of groups with active members.</h2>";

$groups = mysqlQuery("Groups", "1");

while($group = mysql_fetch_object($groups))
{
  $group_name = $group->group_name;
  $group_id = $group->group_id;
  echo "<h2>$group_name</h2>";

  echo "<table class=\"tablesorter table table-striped\">
  <thead>
  <tr><th>person_id</th><th>first name</th><th>last name</th><th>email</th><th>state</th></tr>
  </thead>
  <tbody>";

  $people = mysqlQuery("People", "group_id = '$group_id'");
  while($person = mysql_fetch_object($people))
  {
    $pid = $person->person_id;
    $first_name = $person->first_name;
    $last_name = $person->last_name;
    $email = $person->email_address;
    $state = $person->state;


    echo "<tr><td>$pid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$state</td></tr>";

  }
  echo "</tbody></table>";

}

//add the call to tablesorter now that the tables are created.
echo "<script type=\"text/javascript\">
  $(\".tablesorter\").tablesorter();
</script>";

endif;

if($testing)
{
  $error_text = $error_codes[$error];
  echo "$filename = $error_text<br />";
}







?>
