<?php
  include_once 'database.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Toshiba Appliances Ordering System : Invoice</title>
</head>
<body>
  <center>
    Toshiba Sdn. Bhd. <br>
    Lot F20 & F21, 1st Floor, Pusat Beli-belah AEON Nilai <br>
    Persiaran Pusat Bandar, Putra Point, Putra Nilai<br>
    71800 <br>
    Negeri Sembilan <br>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a187991_pt2, tbl_staffs_a187991_pt2,
        tbl_customers_a187991_pt2, tbl_orders_details_a187991_pt2 WHERE
        tbl_orders_a187991_pt2.FLD_STAFF_ID = tbl_staffs_a187991_pt2.FLD_STAFF_ID AND
        tbl_orders_a187991_pt2.FLD_CUST_ID = tbl_customers_a187991_pt2.FLD_CUST_ID AND
        tbl_orders_a187991_pt2.FLD_ORDER_ID = tbl_orders_details_a187991_pt2.FLD_ORDER_ID AND
        tbl_orders_a187991_pt2.FLD_ORDER_ID = :oid");


      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Order ID: <?php echo $readrow['FLD_ORDER_ID'] ?>
    <hr>
    Staff: <?php echo $readrow['FLD_STAFF_NAME']?>
    |
    Customer ID: <?php echo $readrow['FLD_CUST_ID'] ?>
    |
    Date: <?php echo date("d M Y"); ?>

    <hr>
    <table border="1">
      <tr>
        <td>No</td>
        <td>Product</td>
        <td>Quantity</td>
        <td>Price(RM)/Unit</td>
        <td>Total(RM)</td>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a187991_pt2,
            tbl_products_a187991_pt2 where 
            tbl_orders_details_a187991_pt2.FLD_PRODUCT_ID = tbl_products_a187991_pt2.FLD_PRODUCT_ID AND
            tbl_orders_details_a187991_pt2.FLD_ORDER_ID = :oid");
       
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      /*foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['FLD_PRODUCT_NAME']; ?></td>
        <td><?php echo $detailrow['FLD_ORDER_DETAIL_QUANTITY']; ?></td>
        <td><?php echo $detailrow['FLD_PRODUCT_PRICE']; ?></td>
        <!-- TOTAL = PRICE * QUANTITY-->
        <td><?php echo $detailrow['FLD_PRODUCT_PRICE']*$detailrow['FLD_ORDER_DETAIL_QUANTITY']; ?></td>
      </tr>
      <?php
        $grandtotal = $grandtotal + $detailrow['FLD_PRODUCT_PRICE']*$detailrow['FLD_ORDER_DETAIL_QUANTITY'];
        $counter++;
      } // while*/

foreach($result as $detailrow) {

//   echo "Product Name: " . $detailrow['FLD_PRODUCT_NAME'] . "<br>";
// echo "Quantity: " . $detailrow['FLD_ORDER_DETAIL_QUANTITY'] . "<br>";
// echo "Price: " . $detailrow['FLD_PRICE'] . "<br>";

?>
  <tr>
    <td><?php echo $counter; ?></td>
    <td><?php echo $detailrow['FLD_PRODUCT_NAME']; ?></td>
    <td><?php echo $detailrow['FLD_ORDER_DETAIL_QUANTITY']; ?></td>
    <td><?php echo isset($detailrow['FLD_PRICE']) ? $detailrow['FLD_PRICE'] : "N/A"; ?></td>
    <!-- TOTAL = PRICE * QUANTITY-->
    <td>
      <?php 
        if(isset($detailrow['FLD_PRICE']) && isset($detailrow['FLD_ORDER_DETAIL_QUANTITY'])) {
          echo $detailrow['FLD_PRICE'] * $detailrow['FLD_ORDER_DETAIL_QUANTITY'];
        } else {
          echo "N/A";
        }
      ?>
    </td>
  </tr>
<?php
  $grandtotal += (isset($detailrow['FLD_PRICE']) && isset($detailrow['FLD_ORDER_DETAIL_QUANTITY'])) 
    ? $detailrow['FLD_PRICE'] * $detailrow['FLD_ORDER_DETAIL_QUANTITY']
    : 0;
  $counter++;
} // foreach


     
      $conn = null;
      ?>
      <tr>
        <td colspan="4" align="right">Grand Total</td>
        <td><?php echo $grandtotal ?></td>
      </tr>
    </table>
    <hr>
    Computer-generated invoice. No signature is required.
 
  </center>
</body>
</html>