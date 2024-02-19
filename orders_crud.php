<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
// //Create
// if (isset($_POST['create'])) {
 
//   try {

//     // Retrieve the last used order ID
//     $stmt_last_id = $conn->prepare("SELECT MAX(FLD_ORDER_ID) AS last_id FROM tbl_orders_a187991_pt2");
//     $stmt_last_id->execute();
//     $last_id_result = $stmt_last_id->fetch(PDO::FETCH_ASSOC);

//     // Increment the last ID
//     $last_id = $last_id_result['last_id'];
//     $incremented_id = incrementOrderId($last_id);
 
//     $stmt = $conn->prepare("INSERT INTO tbl_orders_a187991_pt2(FLD_ORDER_ID, FLD_STAFF_ID,
//       FLD_CUST_ID) VALUES(:oid, :sid, :cid)");
   
//     $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
//     $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
//     $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
//     //$oid = uniqid('O', true); //RANDOM UNIQUE ID
//     $oid = $incremented_id;
//     $sid = $_POST['sid'];
//     $cid = $_POST['cid'];
     
//     $stmt->execute();
//     }
 
//   catch(PDOException $e)
//   {
//       echo "Error: " . $e->getMessage();
//   }
// }

// // Function to increment order ID
// function incrementOrderId($last_id) {
//     // Extract the numeric part of the last ID
//     $numeric_part = intval(substr($last_id, 1));

//     // Increment the numeric part
//     $numeric_part++;

//     // Create the new order ID by combining the prefix and the incremented numeric part
//     $new_id = 'R' . str_pad($numeric_part, 3, '0', STR_PAD_LEFT);

//     return $new_id;
// }
 

//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_orders_a187991_pt2(FLD_ORDER_ID, FLD_STAFF_ID,
      FLD_CUST_ID) VALUES(:oid, :sid, :cid)");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $oid = uniqid('R', true);
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_orders_a187991_pt2 SET FLD_STAFF_ID = :sid,
      FLD_CUST_ID = :cid WHERE FLD_ORDER_ID = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    //$stmt->bindParam(':oldoid', $oldoid, PDO::PARAM_STR);

    $oid = $_POST['oid'];
    $sid = $_POST['sid'];
    $cid = $_POST['cid'];
    //$oldoid = $_POST['oldoid'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_orders_a187991_pt2 WHERE FLD_ORDER_ID = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
       
    $oid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
    try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a187991_pt2 WHERE FLD_ORDER_ID = :oid");
   
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
       
    $oid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>