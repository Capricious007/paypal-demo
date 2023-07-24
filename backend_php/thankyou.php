<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/paypal/resources/paypal.css">
    <title>Thank You :: Paypal | Capricious Collections</title>
</head>
<body>
<ul>
    <li>
      <h1 class="storeName">Capricious Collections</h1>
      <p class="storeTag">A store to your unpredictable moods</p>
    </li>
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="#news">News</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#about">About</a></li>

  </ul>
<div class="maindiv">
    <div class="products">
        <h1>Thank you. Your Payment is successful.<br>Your order ID is: <span id="orderid"><?php $orderid=$_GET['orderID']; echo ($orderid);?></span></h1> 
        <!-- <button onclick="retry()">display button</button> -->
        <div id="retry">
            <button id="capbtn" onclick="cap(ord)">FINAL CAPTURE</button>
        </div>
      
    </div>
</div>
<script src="/paypal/resources/capture.js"></script>
</body>
</html>
