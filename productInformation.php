<!DOCTYPE html>
<html lang="en">
<head>
  <title>Toys Product Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="stylesheet" href="website.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
  <br>
  <?php
    require ("config.php");
    $ProductCode=$_GET['ProductCode'];
    $sqlQuery = $pdo->prepare('SELECT * FROM product WHERE ProductCode = :ProductCode');
    $sqlQuery->execute(['ProductCode' => $ProductCode]);
    while($row = $sqlQuery->fetch())
    {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-4">    
        <div class="card">
          <a href='<?php echo "productInformation.php?ProductCode=".$row['ProductCode'].""; ?>'>
            <h4 class="card-title"><?php echo $row['ProductName']; ?></h4>
          </a>
          <?php echo" <img class=center class =ProductImage src='pictures/".$row['ProductImage']."'";  "onclick=location.href='productInformation.php?ProductCode=".$row['ProductCode']."'" ?>
          <div class="card-body">
            <?php
              echo "<align = center>Product Code: ".$row['ProductCode']."<br>";
              echo "<align = center>Product Name: ".$row['ProductName']."<br>";
              echo "<align = center>Current Stock Level: ".$row['CurrentStockLevel']."<br>";
              echo "<align = center>Low Stock Level: ".$row['LowStockLevel']."<br>";
            ?>
          </div>
        </div>
  <?php } ?>

  <div class="col-8">
    <div class="card">    
      <div class="card-body">  
        <h5 class="card-title">List of Suppliers to choose from</h5>
      </div> 
    </div>   
    <br>
    <?php
      require ("config.php");
      $ProductCode=$_GET['ProductCode'];
      $sqlQuery = $pdo->prepare('SELECT * FROM suppliedproducts INNER JOIN product ON suppliedproducts.ProductCode = product.ProductCode WHERE product.ProductCode = :ProductCode ');
      $sqlQuery->execute(['ProductCode' => $ProductCode]);
      while($row = $sqlQuery->fetch())
      {
    ?>
      <div class="carinfo"> 
    <?php
    ?>
      <form method="post" action="basketlist.php?action=add&SuppliedProductsID=<?php echo $row["SuppliedProductsID"]; ?>">
        <div class="card"  style="background-color:#ffff00 ">      
          <div class="card-body">
            <h4 class="text-info">Supplier Name: <?php echo $row["SupplierName"]; ?></h4>
            <h4 class="text-info">Delivery Time: <?php echo $row["DeliveryTime"]; ?> days</h4>
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="ProductName" value="<?=$product['ProductName']?>">
            <input type="hidden" name="ProductCode" value="<?=$product['ProductCode']?>">
            <input type="hidden" name="SuppliedProductsID" value="<?=$product['SuppliedProductsID']?>">	
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" onclick=Highlight(this)/>
            <input type="radio" name="Button" class="ButtonState" checked id="Button1" value="1"/>
            <label class="Button" for="Button1">Button 1</label>
            <input type="radio" name="Button" class="ButtonState" id="Button2" value="2"/>
            <label class="Button" for="Button2">Button 2</label>
            <input type="radio" name="Button" class="ButtonState" id="Button3" value="3"/>
            <label class="Button" for="Button3">Button 3</label>
            <h4 class="text-danger">£ <?php echo $row["TotalCost"]; ?></h4>
            <input type="hidden" name="ProductName" value="<?php echo $row["ProductName"]; ?>" />
            <input type="hidden" name="SupplierName" value="<?php echo $row["SupplierName"]; ?>" />
            <input type="hidden" name="DeliveryTime" value="<?php echo $row["DeliveryTime"]; ?>" />
            <input type="hidden" name="TotalCost" value="<?php echo $row["TotalCost"]; ?>" />
            <?php 
              if (isset($_GET["msg"]) && $_GET["msg"] == 'itemadded') {
                echo "Added Item";
              }
              if (isset($_GET["msg"]) && $_GET["msg"] == 'passwordfailed') {
                echo "Wrong Password";
              }
            ?>
          </div>
        </div>
        <br>
      </form>
    <?php } ?>
    <a href="#" class="btn btn-primary">Go somewhere</a>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="col-sm">
    <form class="form-inline">
      <div class="form-group mb-2">
      </div>         
    </form>
  </div>
  <?php 
    // Sedot Code
    //mulai session 
    //Jika user belum login maka buat sebuah session yang isinya adalah url yang lagi dibukanya, 
    $_SESSION['redirectme'] = $_SERVER['REQUEST_URI'];
    //Arahkan kehalaman login.php
  ?>
  <br>
  <script>
    function Highlight(button) {
      $(".Highlight").removeClass("Highlight");
      $(button).addClass("Highlight");
    }
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
          $.get("backend-search.php", {term: inputVal}).done(function(data){
            // Display the returned data in browser
            resultDropdown.html(data);
            });
        } else{
          resultDropdown.empty();
        }
      });
      // Set search input value on click of result item
      $(document).on("click", ".result p", function(){
        $(this).parents(".search_bar").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
      });
    });
  </script>
</body>
</html>
