<?php
  include_once 'database.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Toshiba Appliances Ordering System : Products Details</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $pid = $_GET['pid'];
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a187991_pt2 WHERE FLD_PRODUCT_ID = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
     
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Product ID: <?php echo $readrow['FLD_PRODUCT_ID'] ?> <br>
    Name: <?php echo $readrow['FLD_PRODUCT_NAME'] ?> <br>
    Price: RM <?php echo $readrow['FLD_PRICE'] ?> <br>
    Category: <?php echo $readrow['FLD_CATEGORY'] ?> <br>
    Colour: <?php echo $readrow['FLD_COLOUR'] ?> <br>
    Model: <?php echo $readrow['FLD_MODEL'] ?> <br>
    Warranty: <?php echo $readrow['FLD_WARRANTY'] ?> <br>
    <img src="products/<?php echo $readrow['FLD_IMAGE'] ?>" width="50%" height="50%">
  </center>
</body>
</html>