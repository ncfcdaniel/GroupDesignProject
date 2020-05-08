<?php
    session_start() ;
	    if(!isset($_SESSION['auth']))
    {
    header("Location:../../../Login/Homepage.php") ;
    }
    ?><!DOCTYPE html>
<html>
<head>
  <title>G4U</title>
  <link rel="stylesheet" href="../../../style.css" type="text/css">
  <link rel="stylesheet" href="../../../website.css" type="text/css">
  <link rel="stylesheet" href="Admin.css"  type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#AEB9C7">
    <div style="background-color:#a6b2c1;" class="topnav" align="center">
        
        <img src="../../../Back.png" onclick="goBack()" id="back" alt="back" style=width:50%; height="50%"></img>
        <img src="../../../g4uimageprototype.png" onclick="window.location.href = '../../adminpage.php'" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
       
        <img src="../../../LogoutButton.png" id="logout-button" alt="logout-button" onclick="window.location.href = '../../../logout.php'" ></img>
       </div>
    <br>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>
    <div class="form">
            <h1 align="center"> Add a staff memeber </h1>
            <br>
            <div class="outputresults">
            <form name="register" action="register.php" method="post" align="center">
            <label for="staffid" style="width: 150px">Staff ID</label>
                <input class="form-control" style="width: 200px; display: inline-block" name="staffid" type="text" ><br>       <br>
                <label for="stafftitle" style="width: 150px">Staff Title</label>
                <input class="form-control" style="width: 200px; display: inline-block" name="stafftitle" type="text"><br>       <br>
                <label for="staffname" style="width: 150px">Staff Name</label>

                <input  class="form-control" style="width: 200px; display: inline-block" name="staffname" type="text" ><br>       <br>
                <label for="staffrole" style="width: 150px">Staff Role</label>

                <input class="form-control" style="width: 200px; display: inline-block" name="staffrole" type="text" #><br>       <br>
                <label for="storeid" style="width: 150px">Store ID</label>
                <select class="form-control" style="width: 200px; display: inline-block" name="storeid" id="storeid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Store ID</option>
            <?php
            $data=load_storeid();
            foreach ($data as $row): 
            echo '<option value="'.$row["storeid"].'">'.$row["storeid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <br><br><label for="StoreName" style="width: 150px">Store Name</label>
            <select class="form-control" style="width: 200px; display: inline-block" name="StoreName" id="StoreName" searchable="Search here" >
            <option value="" disabled selected>Store Name</option>
         </select>
                <br> <br>
                <label for="departmentid" style="width: 150px">Department ID:</label>
                <select class="form-control" style="width: 200px; display: inline-block" name="departmentid" id="departmentid" searchable="Search here" >
            <option value="" selected="true" disabled="disabled">Select Department ID </option>
            <?php
            $data=load_departmentid();
            foreach ($data as $row): 
            echo '<option value="'.$row["departmentid"].'">'.$row["departmentid"].'</option>';
            ?>
            <?php endforeach ?>
            </select>
            <br> <br>
            <label for="password" style="width: 150px">Password</label>

                <input class="form-control" style="width: 200px; display: inline-block" name="upassword" type="password"><br> <br>
                <div style="float: none; display: inline-block">

                <input name="submit" name="register" class="form-control" type="submit">
                </div>
            </form>
    </div>


    <?php function load_departmentid()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT departmentid FROM department ORDER BY departmentid ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>

<?php function load_storeid()
{
  $data='';
  require 'config.php';
  $sqlMake=$pdo->prepare('SELECT DISTINCT storeid FROM store ORDER BY storeid ASC');
  $sqlMake ->execute();
  $data=$sqlMake-> fetchAll();
  return $data;
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script type="text/javascript" src="./js/main.js"></script>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>
	<script>
$(document).ready(function(){
 $('#storeid').change(function(){

   var store_id = $(this).val();
   $.ajax({
    url:"FetchStoreName.php",
    method:"POST",
    data:{ storeid:store_id},
    success:function(data){
		
     $('#StoreName').html(data);
    }
   })
  
 });
});
</script>