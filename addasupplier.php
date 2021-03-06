<!DOCTYPE html>
<html>
<head>
    <title>G4UItems</title>
    <link href="style.css" 
          rel="stylesheet" 
          type="text/css">
    <link href="ItemsPage.css"
          rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
</head>
<body style="background-color:#a6b2c1">
    <div class="topnav" align="center">
        <button id="back-button" class="btn btn-danger">Back</button>
        <img src="g4uimageprototype.png" id="g4u-logo" alt="G4ULogo"></img>
        <div class="search-box" id="search-bar">
            <input type="text" autocomplete="on" placeholder="Search product..." />
        <div class="result"></div>
        </div>
        <button id="search-button" class="btn btn-success">Search</button>
        <button id="basket-button" class="btn btn-warning">Basket</button>
        <button id="logout-button" class="btn btn-danger">Log Out</button>
    </div>
    <br><br>
</body>
</html>

<?php
    session_start() ;	
    require 'config.php';
    
    //If the POST var "register" exists (our submit button), then we can
    //assume that the user has submitted the registration form.
    if(isset($_POST['register'])){    
        //Retrieve the field values from our registration form.
        $SupplierCode = !empty($_POST['SupplierCode']) ? trim($_POST['SupplierCode']) : null;
        $SupplierID = !empty($_POST['SupplierID']) ? trim($_POST['SupplierID']) : null;
        $SupplierName = !empty($_POST['SupplierName']) ? trim($_POST['SupplierName']) : null;
        $SupplierAddress = !empty($_POST['SupplierAddress']) ? trim($_POST['SupplierAddress']) : null;

        //TO ADD: Error checking (stafftitle characters, staffname length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.
        
        //Now, we need to check if the supplied stafftitle already exists.
        
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(SupplierCode) AS num FROM supplier WHERE SupplierCode = :SupplierCode";
        $stmt = $pdo->prepare($sql);
        
        //Bind the provided stafftitle to our prepared statement.
        $stmt->bindValue(':SupplierCode', $SupplierCode);
        
        //Execute.
        $stmt->execute();
        
        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //If the provided stafftitle already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
            die('That product already exists!');
        }
        
        //Hash the staffname as we do NOT want to store our staffnames in plain text.
        //$staffnameHash = staffname_hash($pass, staffname_BCRYPT, array("cost" => 12));
        $sqlQuery = $pdo->query('SELECT SupplierCode FROM supplier ORDER BY SupplierCode DESC LIMIT 1');
        $row=$sqlQuery->fetch();
        $staffnumber = $row['SupplierCode']+1;
        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO product (SupplierCode, SupplierID, SupplierName, SupplierAddress) VALUES (:SupplierCode, :SupplierID, :SupplierName, :SupplierAddress)";
        $stmt = $pdo->prepare($sql);
        
        //Bind our variables.
        $stmt->bindValue(':SupplierCode', $SupplierCode);    
        $stmt->bindValue(':SupplierID', $SupplierID);
        $stmt->bindValue(':SupplierName', $SupplierName);
        $stmt->bindValue(':SupplierAddress', $SupplierAddress);
    
        
        //Execute the statement and insert the new account.
        $result = $stmt->execute();
        
        //If the signup process is successful.
        if($result){
            //What you do here is up to you!
            echo 'Thank you for registering with our website.';
            header('location:login.php');
        }        
    } 
?>

<!DOCTYPE html>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../style.css">
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1 align="center">Add a Supplier</h1>
		<div class="outputresults">
        <form action="addasupplier.php" method="post" align="center">
            <label for="SupplierCode" style="width: 150px">Supplier Code</label>
            <input type="text" id="SupplierCode" name="SupplierCode" class="form-control" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierID" style="width: 150px">Supplier ID</label>
            <input type="SupplierID" id="SupplierID" class="form-control" name="SupplierID" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierName" style="width: 150px">Supplier Name</label>
            <input type="SupplierName" id="SupplierName" class="form-control" name="SupplierName" minlength="2" maxlength="20" style="width: 200px; display: inline-block">
            <br><br>
            <label for="SupplierAddress" style="width: 150px">Supplier Address</label>
            <input type="text" id="SupplierAddress" class="form-control" name="SupplierAddress" style="width: 200px; display: inline-block">
            <br><br>
            <div style="float: none; display: inline-block">			
                <input type="submit" name="register" class="form-control" value="Register"></button>
            </div>
        </form>
    </body>
</html>