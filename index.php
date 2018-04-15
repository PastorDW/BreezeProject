<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Breeze Project</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript" src="jquery.tablesorter.js"></script>

    <style type="text/css">
      #container{width:60%;}
      h2{margin-top:25px;}
      th{cursor:pointer;}
    </style>

    <script type="text/jscript">
      $(function() {
            $("#upload-button").click(function()
            {
              $("#upload-form").ajaxForm({target: '#showdata'}).submit();
            });

        });
    </script>


  </head>
  <body>
<center>
<div id="container">


<h2>Bulk Uploader</h2>
<p>
  You can use this page to upload CSV files for Groups and for People. Upload Groups first so that when you upload People, they have groups to be assigned to. After you upload, your current list of groups with active members will show up below.
</p>
<form id="upload-form" enctype="multipart/form-data" style="margin:0px;" action="upload.php" method="post">
<div class="input-group">
    <input type="file" id="fileinput" class="form-control" name="filename" accept=".csv">
    <button id="upload-button" class="btn" type="submit">Upload</button>

</div>
</form>




  <div id="showdata">

  </div>

</div>

</center>






  </body>
</html>
