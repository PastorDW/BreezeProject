<?php

/*
* Helper function I've used for a long time to simplify using mysql
* Pass it the string of the list name and the where criteria and it returns the query result
*/
function mysqlQuery($list, $where)
{
  //echo "SELECT * FROM $list WHERE $where". "<br />\n";
  $q = mysql_query("SELECT * FROM $list WHERE $where");
  return $q;

}


  /*
  * Helper function I've used for a long time to simplify using mysql
  * Pass it the string of the list name and the where criteria and it returns the mysql object
  */
  function mysqlFetchObject($list, $where)
  {
    //echo "SELECT * FROM $list WHERE $where". "<br />\n";
    $q = mysql_query("SELECT * FROM $list WHERE $where");
    if(mysql_num_rows($q) > 0)
      return mysql_fetch_object($q);
    else
      return 0;

  }

  /*
  * Helper function I've used for a long time to simplify using mysql
  * Pass it the string of the table to insert into and the keys and values arrays
  */
  function mysqlInsertArray($into, $keys, $values)
  {
    $keys = implode("`, `", $keys);
  	$values = implode("', '",$values);

  	//echo "INSERT INTO $into (`$keys`)VALUES('".$values."')". "<br />\n";
  	mysql_query("INSERT INTO $into (`$keys`)VALUES('".$values."')");
  }

  /*
  * Helper function I've used for a long time to simplify using mysql
  * Pass the table, keys array, values array, and the where criteria
  */
  function mysqlUpdateArray($table, $keys, $values, $where)
  {
    $set = array();
    for($i = 0; $i < count($keys); $i++)
    {
      $set[] = "`".$keys[$i]."` = '".addslashes($values[$i])."'";
    }

    $sets = implode(", ", $set);

    //echo "UPDATE $table SET $sets WHERE $where". "<br />\n";
    mysql_query("UPDATE $table SET $sets WHERE $where");

  }

?>
