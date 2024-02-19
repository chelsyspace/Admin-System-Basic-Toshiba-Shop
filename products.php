<?php
  include_once 'products_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Toshiba Appliances Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
      Product ID
      <input name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; ?>"> <br>
      Name
      <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>"> <br>
      Price
      <input name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>"> <br>
      Category
      <select name="category">
        <option value="Home" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORY']=="Home") echo "selected"; ?>>Home</option>
        <option value="Kitchen" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORY']=="Kitchen") echo "selected"; ?>>Kitchen</option>
        <option value="Computer" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORY']=="Computer") echo "selected"; ?>>Computer</option>
        <option value="Other" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORY']=="Other") echo "selected"; ?>>Other</option>
      </select> <br>
      Colour
      <input name="colour" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_COLOUR']; ?>"> <br>
      Model
      <input name="model" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_MODEL']; ?>"> <br>
      Warranty
      <input name="warranty" type="radio" value="Yes" <?php if(isset($_GET['edit'])) if($editrow['FLD_WARRANTY']=="New") echo "checked"; ?>> Yes
      <input name="warranty" type="radio" value="No" <?php if(isset($_GET['edit'])) if($editrow['FLD_WARRANTY']=="No") echo "checked"; ?>> No <br>

      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Price</td>
        <td>Brand</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a187991_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <!-- WHAT TO DISPLAY ON MYPT/PRODUCTS-->   
      <tr>
        <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
        <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
        <td><?php echo $readrow['FLD_PRICE']; ?></td>
        <td><?php echo $readrow['FLD_CATEGORY']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>">Details</a>
          <a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
 
    </table>
  </center>
</body>
</html>