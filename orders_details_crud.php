<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
// //Create
// if (isset($_POST['addproduct'])) {
 
//   try {

//     // Retrieve the last used order ID
//     $stmt_last_id = $conn->prepare("SELECT MAX(FLD_ORDER_DETAIL_ID) AS last_id FROM tbl_orders_details_a187991_pt2");
//     $stmt_last_id->execute();
//     $last_id_result = $stmt_last_id->fetch(PDO::FETCH_ASSOC);
        
//     // Increment the last ID
//     $last_id = $last_id_result['last_id'];
//     $incremented_id = incrementOrderId($last_id);
        
 
//     $stmt = $conn->prepare("INSERT INTO tbl_orders_details_a187991_pt2(FLD_ORDER_DETAIL_ID,
//       FLD_ORDER_ID, FLD_PRODUCT_ID, FLD_ORDER_DETAIL_QUANTITY) VALUES(:did, :oid,
//       :pid, :quantity)");
   
//     $stmt->bindParam(':did', $did, PDO::PARAM_STR);
//     $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
//     $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
//     $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       
//     //$did = uniqid('D', true);
//     $did = $incremented_id;
//     $oid = $_POST['oid'];
//     $pid = $_POST['pid'];
//     $quantity= $_POST['quantity'];
     
//     $stmt->execute();
//     }
 
//   catch(PDOException $e)
//   {
//       echo "Error: " . $e->getMessage();
//   }
//   $_GET['oid'] = $oid;
// }


// // Function to increment order details ID
// function incrementOrderId($last_id) {
//     // Extract the numeric part of the last ID
//     $numeric_part = $last_id ? intval(substr($last_id, 1)) : 0;

//     // Increment the numeric part
//     $numeric_part++;

//     // Create the new order ID by combining the prefix and the incremented numeric part
//     $new_id = 'OD' . str_pad($numeric_part, 4, '0', STR_PAD_LEFT);

//     return $new_id;
// }


//Create
if (isset($_POST['addproduct'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_orders_details_a187991_PT2(FLD_ORDER_DETAIL_ID, FLD_ORDER_ID,FLD_PRODUCT_ID, FLD_ORDER_DETAIL_QUANTITY) VALUES(:did, :oid, :pid, :quantity)");
   
    $stmt->bindParam(':did', $did, PDO::PARAM_STR);
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       
    $did = uniqid('D', true);
    $oid = $_POST['oid'];
    $pid = $_POST['pid'];
    $quantity= $_POST['quantity'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  $_GET['oid'] = $oid;
}
 

// // Update
// if (isset($_POST['updateproduct'])) {
//     try {
//         $stmt = $conn->prepare("UPDATE tbl_orders_details_a187991_pt2 
//                                SET FLD_PRODUCT_ID = :pid, 
//                                    FLD_ORDER_DETAIL_QUANTITY = :quantity 
//                                WHERE FLD_ORDER_DETAIL_ID = :did");

//         $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
//         $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
//         $stmt->bindParam(':did', $did, PDO::PARAM_STR);

//         $pid = $_POST['pid'];
//         $quantity = $_POST['quantity'];
//         $did = $_POST['did'];

//         $stmt->execute();
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
//     $_GET['oid'] = $_POST['oid'];
// }


//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_orders_details_a187991_pt2 where FLD_ORDER_DETAIL_ID = :did");
   
    $stmt->bindParam(':did', $did, PDO::PARAM_STR);
       
    $did = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders_details.php?oid=".$_GET['oid']);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
?>