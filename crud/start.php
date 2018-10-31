<?php
session_start();
require 'pdo.php';
echo ("Welcome to FinManager ");
$qq =  $_SESSION['name'];
echo $qq;


$stmt11 = $pdo->prepare('SELECT * FROM user_info where name = :aabb ');
$stmt11->bindValue(':aabb', $qq);
$stmt11->execute();
$cc = $stmt11->fetch(PDO::FETCH_ASSOC);
$pp = $cc['user_id'];
echo("\nUser_id: ");
echo $pp;
$_SESSION['key'] = $pp;


?>
<html>
<head>
</head>
<body>
<h3>Operations</h1>
<a href="account/index_account_info.php">Account_info</a>

</br></br><a href="transaction/index_transaction.php">Transaction_info</a>
</br></br><a href="account/add_account_info.php">Add new account</a>
</br></br><a href="transaction/add_transaction.php">Add new transaction</a>
</br></br><a href="income/add_income.php">Add Income</a>
</br></br><a href="index.php">Sign out</a>
</body>
</html>

