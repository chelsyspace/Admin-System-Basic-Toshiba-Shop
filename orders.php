<?php
  include_once 'orders_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Toshiba Appliances Ordering System : Orders</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="orders.php" method="post">
      Order ID
       <input name="oid" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_ORDER_ID']; ?>"> <br>
      <!-- Order Date
      <input name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"> <br> -->
      Staff
      <select name="sid">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a187991_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $staffrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['FLD_STAFF_ID']==$staffrow['FLD_STAFF_ID'])) { ?>
          <option value="<?php echo $staffrow['FLD_STAFF_ID']; ?>" selected><?php echo $staffrow['FLD_STAFF_NAME'];?></option>
        <?php } else { ?>
          <option value="<?php echo $staffrow['FLD_STAFF_ID']; ?>"><?php echo $staffrow['FLD_STAFF_NAME'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> <br><br>
      Customer
      <select name="cid">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a187991_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $custrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['FLD_CUST_ID']==$custrow['FLD_CUST_ID'])) { ?>
          <option value="<?php echo $custrow['FLD_CUST_ID']; ?>" selected><?php echo $custrow['FLD_CUST_NAME']?></option>
        <?php } else { ?>
          <option value="<?php echo $custrow['FLD_CUST_ID']; ?>"><?php echo $custrow['FLD_CUST_NAME']?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order ID</td>
        <td>Staff Name</td>
        <td>Customer Name</td>
        <td></td>
      </tr>
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a187991_pt2, tbl_staffs_a187991_pt2, tbl_customers_a187991_pt2 WHERE ";
        $sql = $sql."tbl_orders_a187991_pt2.FLD_STAFF_ID = tbl_staffs_a187991_pt2.FLD_STAFF_ID and ";
        $sql = $sql."tbl_orders_a187991_pt2.FLD_CUST_ID = tbl_customers_a187991_pt2.FLD_CUST_ID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
      ?>
      <tr>
        <td><?php echo $orderrow['FLD_ORDER_ID']; ?></td>
        <td><?php echo $orderrow['FLD_STAFF_NAME']; ?></td>
        <td><?php echo $orderrow['FLD_CUST_NAME']; ?></td>
        <td>
          <a href="orders_details.php?oid=<?php echo $orderrow['FLD_ORDER_ID']; ?>">Details</a>
          <a href="orders.php?edit=<?php echo $orderrow['FLD_ORDER_ID']; ?>">Edit</a>
          <a href="orders.php?delete=<?php echo $orderrow['FLD_ORDER_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
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