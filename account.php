<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'capitalg';
$DATABASE_PASS = 'Edwards12345@';
$DATABASE_NAME = 'capitalg_capitalguard';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$errorMsg = ''; // Initialize an error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the registration form
    $cotCode = $_POST['cotCode'];
    $imfCode = $_POST['imfCode'];
    $tacCode = $_POST['tacCode'];
    $accountNumber = $_POST['accountNumber'];
    $username = $_POST['username']; // Retrieve the username

    // Query the database to check if the input values match default values
    $query = "SELECT * FROM accounts WHERE
              cotCode = '$cotCode' AND
              imfCode = '$imfCode' AND
              tacCode = '$tacCode'";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Registration is successful, update the accountNumber field
        $updateQuery = "UPDATE accounts SET accountNumber = '$accountNumber' WHERE
                        cotCode = '$cotCode' AND
                        imfCode = '$imfCode' AND
                        tacCode = '$tacCode'";

        if (mysqli_query($con, $updateQuery)) {
            // Registration successful, redirect to a success page
            header("Location: success.php");
            exit();
        } else {
            // Handle the update error
            $errorMsg = 'Registration failed. Please try again.';
        }
    } else {
        // Input values do not match default values
        // Query the database to find the account associated with the username
        $deleteQuery = "DELETE FROM accounts WHERE username = '$username'";
        if (mysqli_query($con, $deleteQuery)) {
            // Account deleted, set an error message
            $errorMsg = 'The federal COT is required for this transaction to be completed successfully. you can visit any of our branches or contact our online customer care representative for details of the codes.';
        } else {
            // Handle the delete error
            $errorMsg = 'transaction failed. ';
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
<!--TITLE-->
<title>Register</title>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
  body{
    font-family: "Inter";
    font-size: 14px;
  }
input{
    margin-bottom: 10px;
    width: 250px;
    height: 30px;
    border-radius: 5px;
    border: 1px solid gray;
}
#submit{
    background-color: #780b54de;
    color: white;
}
.divss1{
  border-bottom: 1px solid gray; 
}
 .centered-div {
            text-align: center;
            margin-bottom: 10px ;
            border:1px solid black;
            width: 50%;
            padding: 10px;
            
        }

</style>
<!--ICON-->
<link rel="shortcut icon" href="images/newlogo.jpg">
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="Responsive.css">
<link href="https://fonts.googleapis.com/icon?family=Inter" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  </head>
  <body>
   <div id="starter">
  <h3 id="needhelp">Need help? Contact Us</h3>
   <p id="p1" >capitalg@capitalguard.cc</p>
   <i  class="material-icons" style="padding-left:255px ;position: relative;top: -45%;color: #f31a1ade ;">mail_outline</i>
   <button id="botnz" class="bot1"><a href="sign-in.html" style="color: white;">Sign in</a></button>
   <button id="botnz" class="bot2"><a href="index.html" style="color: white;">Home</a></button>
   <select id="languages" name="languages"   >
      <option>Select Language</option>
      <option value="af">Afrikaans</option>
      <option value="sq">Albanian - shqip</option>
      <option value="ar">Arabic - ةيبرعلا>/option>
      <option value="hy">Armenian - հայերեն</option>
      <option value="ast">Asturian - asturianu</option>
      <option value="az">Azerbaijani - azərbaycan dili</option>
      <option value="be">Belarusian - беларуская</option>
      <option value="bs">Bosnian - bosanski</option>
      <option value="bg">Bulgarian - български</option>
      <option value="ca">Catalan - català</option>
      <option value="zh">Chinese - 中文</option>
      <option value="co">Corsican</option>
      <option value="hr">Croatian - hrvatski</option>
      <option value="cs">Czech - čeština</option>
      <option value="da">Danish - dansk</option>
      <option value="nl">Dutch - Nederlands</option>
      <option value="en">English</option>
      <option value="en-GB">English (United Kingdom)</option>
      <option value="en-US">English (United States)</option>
      <option value="et">Estonian - eesti</option> 
      <option value="fil">Filipino</option>
      <option value="fi">Finnish - suomi</option>
      <option value="fr">French - français</option>
      <option value="ka">Georgian - ქართული</option>
      <option value="de">German - Deutsch</option>
      <option value="de-AT">German (Austria) - Deutsch (Österreich)</option>
      <option value="el">Greek - Ελληνικά</option>
      <option value="hu">Hungarian - magyar</option>
<option value="is">Icelandic - íslenska</option>
<option value="id">Indonesian - Indonesia</option>
<option value="ga">Irish - Gaeilge</option>
<option value="it-IT">Italian (Italy) - italiano (Italia)</option>
<option value="ja">Japanese - 日本語</option>
<option value="la">Latin</option>
<option value="mk">Macedonian - македонски</option>
<option value="mt">Maltese - Malti</option>
<option value="pl">Polish - polski</option>
<option value="pt">Portuguese - português</option>
<option value="ru">Russian - русский</option>
<option value="es">Spanish - español</option>
<option value="sw">Swahili - Kiswahili</option>
<option value="tr">Turkish - Türkçe</option>
      </select>
  </div>
 
  <div style="position: sticky;top: 0;background-color: #fafafb;height: 80px; z-index: 5000;box-shadow: 0 0px 5px 0 rgba(0, 0, 0, 0.998),  0 0px 5px 0 rgba(0, 0, 0, 0.19)" >
    <img src="images/newlogo.jpg" id="ingo">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()" id="span">&#9776;</span>
    
    <div style="position: absolute;left: 20%;" id="dropID" >
    <ul style="margin-top: 0;margin-bottom:20px ;" >

<li onclick="dropdown(1)">
<p id="color">Banking Services <i class="arrow down"></i></p>
<p id="colorz">Accounts and Services</p>
<li>

<li onclick="dropdown(2)">
  <p id="color">Borrowing  		<i class="arrow down"></i></p>
  <p id="colorz">Loans and Mortgages</p>
</li>

<li onclick="dropdown(3)">
  <p id="color">Investing 	<i class="arrow down"></i> </p>
  <p id="colorz">Products and Analysis</p>
</li>

<li onclick="dropdown(4)">
  <p id="color">Insurance 	<i class="arrow down"></i></p>
  <p id="colorz">Property and family</p>
</li>

<li onclick="dropdown(5)">
  <p id="color" >Life Events 	<i class="arrow down"></i> </p>
  <p id="colorz">Help and Support</p>
</li>
</ul>
</div>


 <!--drop down page 1-->
 <div style="height: 350px;width: 90%; display: none;"  class="stack" id="dropdown1">
  <div id="current" style="border-right: 1px solid #780b54de;position: relative;top:-42%;" >
    <h2 id="bluez">Current Accounts</h2>
    <p><a href="capitalguard_acct.html">capitalguard account</a></p>
    <p><a href="advance-acc.html">Advance account</a></p>
    <p><a href="student_acc.html">Student account</a></p>
    <p><a href="bank_acc.html">Bank account</a></p>
  </div>
  <div  id="current" style="border-right: 1px solid #780b54de; position: relative;top:-42%;">
    <h2 id="bluez">Savings</h2>
    <p><a href="savings.html">ISAs</a></p>
            <p><a href="savings.html">Online bonus saver</a></p>
            <p><a href="savings.html">flexible saver</a></p><br>
  </div>
  <div id="current" style="position: relative;top:-24%;">
    <h2 id="bluez">Credit cards</h2>
    <p><a href="Credit-cards.html">32 month transfer credit card</a></p>
    <p><a href="Credit-cards.html">Advance Credit Card</a></p>
    <p><a href="Credit-cards.html">Dual credit card </a></p>
    <p><a href="classic credit card"></a></p>
    <p><a href="Credit-cards.html">capitalguard credit card</a> </p>
    <p><a href="Credit-cards.html">capitalguard world elite mastercard</a></p>
    <p><a href="Credit-cards.html">Student credit card</a></p>
  </div>
  <div id="current" style="background-color:  #780b54de;color: white; height: 330px;;"class="currentz" >
    <h2 style="margin-top: 25px;" >Services</h2>
    <p><a href="services.html">ways to bank</a></p>
    <p><a href="services.html">Voice ID</a></p>
    <p><a href="services.html">Contact and Support</a></p>
    <p><a href="services.html">Find a branch</a></p>
    <h2>International Services</h2>
    <p ><a href="international_services.html">Currency Account</a></p>
    <p><a href="international_services.html">International payments</a></p>
    <p><a href="international_services.html">Travel money</a></p>
  </div>
  <button onclick="close1()" style="position: absolute;top: 87%;left: 45%;height: 40px;width: 100px;color: white;background-color: #780b54de;border-radius: 15px;">Close</button>
  <script>
    function close1(){
    document.getElementById("dropdown1").style.display="none";
  }
  </script>
</div>



 <!--drop down page2-->
 <div style="height: 350px;width: 90%; display: none;"  class="stack" id="dropdown2">
  <div id="current" style="border-right: 1px solid #780b54de;position: relative;top:-20%;">
    <h2 id="bluez">Loan</h2>
    <p><a href="personal-loans.html">personal loan</a></p>
    <p><a href="car-loans.html">Car loan</a></p>
    <p><a href="flexible-loan.html">flexiloan</a></p>
    <p><a href="capitalguard-loan.html">capitalguard personal loan</a></p>
    <p><a href="graduate-loan.html">Graduate loan</a></p>
  </div>
  <div  id="current" style="border-right: 1px solid #780b54de; position: relative;top:-10%;">
    <h2 id="bluez">Mortgages</h2>
    <p><a href="First time buyer.html">First time buyer</a></p>
    <p><a href="95percent-Mortgages.html">95% Mortgages</a></p>
    <p><a href="Remortgage.html">Remortgage</a></p>
    <p><a href="buy to let.html">Buy to let</a></p>
    <p><a href="mortgage rates.html">Mortgage rates</a></p>
    <p><a href="armed forces.html">Armed forces personel</a></p>
  </div>
  <div id="current" style="position: relative;top:-10%;">
    <h2 id="bluez">Credit cards</h2>
    <p><a href="Credit-cards.html">32 month transfer credit card</a></p>
            <p><a href="Credit-cards.html">Advance Credit Card</a></p>
            <p><a href="Credit-cards.html">Dual credit card </a></p>
            <p><a href="classic credit card"></a></p>
            <p><a href="Credit-cards.html">capitalguard credit card</a> </p>
            <p><a href="Credit-cards.html">capitalguard world elite mastercard</a></p>
            <p><a href="Credit-cards.html">Student credit card</a></p>
  </div>
  <div id="current" style="background-color:  #780b54de;color: white; height: 330px;position: relative;top:-2%;;" class="currentz">
    <h2 style="margin-top: 25px;" >Services</h2>
    <p><a href="borrowingService.html">Help & Support</a></p>
    <p><a href="borrowingService.html">Money worries</a></p>
    <h2><a href="borrowingService.html">Tools & Guides</a></h2>
    <p><a href="borrowingService.html">Overpayment calculator</a></p>
    <p><a href="borrowingService.html">Base rate information</a></p> 
    <br><br> 
  </div>
  <button onclick="close2()" style="position: absolute;top: 87%;left: 45%;height: 40px;width: 100px;color: white;background-color: #780b54de;border-radius: 15px;">Close</button>
  <script>
    function close2(){
    document.getElementById("dropdown2").style.display="none";
  }
  </script>
</div>

  <!--drop down pages3-->
  <div style="height: 350px;width: 90%; display: none;"  class="stack" id="dropdown3">
    <div id="current" style="border-right: 1px solid #780b54de;position: relative;top:1%;" >
      <h2 id="bluez"> Investments</h2>
      <p><a href="investmentfund.html">Investment Funds</a></p>
              <p><a href="WorldselectionISA.html">World Selection ISA</a></p>
              <p><a href="sharedealing.html">Sharedealing</a></p>
              <p><a href="financial advice.html">capitalguard financial advice</a></p>
              <p><a href="onshoreinvestment.html">Onshore investment bond</a></p>
              <p><a href="child trust fund.html">Child trust fund</a></p>
    </div>
    <div  id="current" style="border-right: 1px solid #780b54de;position: relative;top:-45%;">
      <h2 id="bluez">Why invest in us</h2>
      <p><a href="why invest.html">Find out more</a></p>
    </div>
    <div id="current" style="position: relative;top:0%">

    </div>
    <div id="current" style="background-color:  #780b54de;color: white; height: 330px;position: relative;top:-50%;;" class="currentz">
      <h2 style="margin-top: 25px;" >Customer Support</h2>
      <p><a href="services.html">Getting Started with Investing</a></p>
    </div>
    <button onclick="close3()" style="position: absolute;top: 87%;left: 45%;height: 40px;width: 100px;color: white;background-color: #780b54de;border-radius: 15px;">Close</button>
    <script>
      function close3(){
      document.getElementById("dropdown3").style.display="none";
    }
    </script>
  </div>

     <!--drop down page4-->
     <div style="height: 350px;width: 90%; display: none;"   class="stack" id="dropdown4">
      <div id="current" style="border-right: 1px solid #780b54de;position: relative;top:-10%">
        <h2 id="bluez">Insurance</h2>
        <p><a href="home insurance.html">Home Insurance</a></p>
        <p><a href="travel insurance.html">Travel Insurance</a></p>
        <p><a href="student insurance.html">Student Insurance</a></p>
      </div>
      <div  id="current" style="border-right: 1px solid #780b54de;">
        <h2 id="bluez">Life Insurance</h2>
        <p><a href="life insurance.html">Life Cover</a></p>
        <p><a href="life insurance.html">Critical Illness Cover</a></p>
        <p><a href="life insurance.html">Income Cover</a></p>
        <p><a href="protection telephone advice.html">Telephone Protection Advice</a></p>
      </div>
      <div id="current" style="position: relative;top:-9%" >
        <h2 id="bluez">Insurance Claims</h2>
        <p><a href="home insurance.html">Home insurance claims</a></p>
        <p><a href="travel insurance.html">Travel insurance claims</a></p>
        <p><a href="car insurance.html">Car insurance claims</a></p>
      </div>
      <div id="current" style="background-color:  #780b54de;color: white; height: 330px;position: relative;top:-11%" class="currentz">
        <h2 style="margin-top: 25px;" >capitalguard Customers</h2>
        <p><a href="travel insurance.html">Travel insurance claims</a></p>
        <p><a href="car insurance.html">Car insurance claims</a></p>
      </div>
      <button onclick="close4()" style="position: absolute;top: 87%;left: 45%;height: 40px;width: 100px;color: white;background-color: #780b54de;border-radius: 15px;">Close</button>
      <script>
        function close4(){
        document.getElementById("dropdown4").style.display="none";
      }
      </script>
    </div>

    <!--drop down page 5-->
    <div style="height: 350px;width: 90%; display: none;"  class="stack" id="dropdown5">
      <div id="current" style="border-right: 1px solid #780b54de;position: relative;top:-40%">
        <h2 id="bluez">Life Event</h2>
       <p><a href="berievement.html">Bereavement Support</a></p> 
        <p><a href="seperation.html">Separation Support</a></p>
      </div>
      <div  id="current" style="border-right: 1px solid #780b54de;position: relative;top:-48%">
        <h2 id="bluez">Planning Tools</h2>
       <p><a href="review.html">Financial Health Check</a> </p>
     
      </div>
      <div id="current" style="position: relative;top:-55%">
       
      </div>
      <div id="current" style="background-color:  #780b54de;color: white; height: 330px;position: relative;top:-10%" class="currentz">
        <h2 style="margin-top: 25px;" >Customer Support</h2>
        <p><a href="services.html">Ways we can help</a></p>
      
        <h2 >Individual Review</h2>
        <p><a href="review.html">Book Your Review Today For a quick <br> <br> Financial Checkup</a></p>
      </div>
      <button onclick="close5()" style="position: absolute;top: 87%;left: 45%;height: 40px;width: 100px;color: white;background-color: #780b54de;border-radius: 15px;">Close</button>
      <script>
        function close5(){
        document.getElementById("dropdown5").style.display="none";
      }
      </script>
    </div>
  </div>



<div>
    <ul style="height: 50px;width: 82%;background-color:#780b54de ;margin-left: 8%" id="ul" >
      <li ><a>Online Registration</a></li>
      <li id="p"><a>Terms & conditions</a></li>
      <li id="p"><a>User Information</a></li>
      <li id="p"><a>Completed</a></li>
    </ul>



<div  class="divss1" style="display: block;">
 <h2>Complete your registration</h2> 
<p>Please enter the following codes to complete your registration and get your unique account number</p>
<br>
<h2 style="color: #780b54de;">Fill in the Information</h2>


    <form method="POST" action="">
        <label for="cotCode">COT Code:</label><br>
        <input type="text" id="cotCode" name="cotCode" required><br>

        <label for="imfCode">IMF Code:</label><br>
        <input type="text" id="imfCode" name="imfCode" required><br>

        <label for="tacCode">TAC Code:</label><br>
        <input type="text" id="tacCode" name="tacCode" required><br>

        <label for="accountNumber">Account Number:</label><br>
        <input type="text" id="accountNumber" name="accountNumber" required><br><br>
   <h2 style="color: #780b54de;">Please re-enter your username for security purpose</h2>
    <input type="text" id="username" name="username" required><br><br>
    
     <?php if (!empty($errorMsg)) { ?>
            <div class="centered-div">
                <?php echo $errorMsg; ?>
            </div>
        <?php } ?>
        
        <input type="submit" value="Complete registration" id="submit">
    </form>



  
 <p><a href="sign-in.html">Already registered? Login Here</a></p>

</div>






</div>
<div style="height: 150px;box-shadow: 0 4px 15px 0 rgba(0, 0, 0, 0.998),  0 6px 15px 0 rgba(0, 0, 0, 0.19);display: none;">
  <div style="margin-left: 8%;padding-top: 20px;">
    <h1 style="color:#780b54de">Connect with us</h1>
<p>Listening to what you have to say about our services matters to us.</p></div>

</div>

<div id="foots" style="display: none;">
  <div id="footer" >
  <div>
  <h3>HELP AND SUPPORT </h3>
  <p>Got a question? We are here to help <br>you</p>
</div>
    
<div>
  <h3>OUR PERFORMANCE</h3>
  <p>Get information about our <br> performance</p>
</div>
  
<div>
  <h3>ABOUT BRIDGE WATER BANK</h3>
  <p>Careers, media, investor and corporate information</p>
</div>
</div>
  
  <div>
      <p style="text-align: center;">
        Federally-insured by the National Credit Administration. we do business in accordance with the Fair Law and Equal oppurtunity Credit Act.
      </p>
      <br>
      <p style="text-align: center;margin-top: 0%;">PO Box: Ermyn Way, Leatherhead KT24 6UX</p>
    </div>
    <img id="imago" src="images/logo.jpg" alt="logo" style="height: 80px;width: 80px; position: relative;top: -15%;left: 12%;">
  
  <p style="text-align: center; margin-top: -3%;color: rgb(216, 211, 211);">© 2023 capitalguard Bank- All rights reserved.</p>
  </div>





  <div id="mySidenav" class="sidenav">
    <h3 style="color: white;text-align: center;">Menu</h3>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <button onclick="smallscreen(1)" id="but1" ><p><b>Banking Services (Accounts and Services)</b></p></button>
    <div id="smalla1" class="divas2" >
<div >
        <p style="color: #1af33bde;">Current Accounts</p>
        <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="capitalguard_acct.html">capitalguard account</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="advance-acc.html">Advance account</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="student_acc.html">Student account</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="bank_acc.html">Bank account</a></p>
      <hr>
        <p style="color: #1af33bde;">Savings</p>
        <p> <a style="font-size: smaller;padding: 0;margin-left: 10px;" href="savings.html">ISAs</a></p>
                <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="savings.html">Online bonus saver</a></p>
                <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="savings.html">flexible saver</a></p><br>
     <hr>
        <p style="color: #1af33bde;">Credit cards</p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">32 month transfer credit card</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">Advance Credit Card</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">Dual credit card </a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="classic credit card"></a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">capitalguard credit card</a> </p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">capitalguard world elite mastercard</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="Credit-cards.html">Student credit card</a></p>
     <hr>
        <p  style="color: #1af33bde;">Services</p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="services.html">ways to bank</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="services.html">Voice ID</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="services.html">Contact and Support</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="services.html">Find a branch</a></p>
        <p style="color: #1af33bde;">International Services</p>
        <p ><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="international_services.html">Currency Account</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="international_services.html">International payments</a></p>
        <p><a  style="font-size: smaller;padding: 0;margin-left: 10px;"  href="international_services.html">Travel money</a></p>
  
      </div>
    </div>
    
      <button onclick="smallscreen(2)"  id="but1" ><p><b>Borrowing ( Loans and Mortgages) </b></p></button>
      <div id="smalla2" class="divas2">
        <div >
          <p style="color: #1af33bde;">Loan</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="personal-loans.html">personal loan</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="car-loans.html">Car loan</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="flexible-loan.html">flexiloan</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="capitalguard-loan.html">capitalguard personal loan</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="graduate-loan.html">Graduate loan</a></p>
       <hr>
        <p style="color: #1af33bde;">Mortgages</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="First time buyer.html">First time buyer</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="95percent-Mortgages.html">95% Mortgages</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Remortgage.html">Remortgage</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="buy to let.html">Buy to let</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="mortgage rates.html">Mortgage rates</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="armed forces.html">Armed forces personel</a></p>
     
       <hr>
          <p style="color: #1af33bde;">Credit cards</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">32 month transfer credit card</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">Advance Credit Card</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">Dual credit card </a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="classic credit card"></a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">capitalguard credit card</a> </p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">capitalguard world elite mastercard</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="Credit-cards.html">Student credit card</a></p>
       <hr>
       <p style="color: #1af33bde;" >Services</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="borrowingService.html">Help & Support</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="borrowingService.html">Money worries</a></p>
          <p style="color: #1af33bde;" >Tools & Guides</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="borrowingService.html">Overpayment calculator</a></p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="borrowingService.html">Base rate information</a></p> 
          
        </div>
      </div>

        <button onclick="smallscreen(3)"  id="but1"><p><b> Investing  (Products and Analysis) </b></p></button>
        <div id="smalla3" class="divas2">
          <p style="color: #1af33bde;"> Investments</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="investmentfund.html">Investment Funds</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="WorldselectionISA.html">World Selection ISA</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="sharedealing.html">Sharedealing</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="financial advice.html">capitalguard financial advice</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="onshoreinvestment.html">Onshore investment bond</a></p>
                  <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="child trust fund.html">Child trust fund</a></p>
      
      <hr>
          <p style="color: #1af33bde;">Why invest in us</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="why invest.html">Find out more</a></p>
      
        <hr>
         <p style="color: #1af33bde;" >Customer Support</p>
          <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="services.html">Getting Started with Investing</a></p>
    
        </div>

          <button onclick="smallscreen(4)"  id="but1" ><p><b> Insurance  (Property and family) </b></p>  </button>
          <div id="smalla4" class="divas2">
            <p style="color: #1af33bde;">Insurance</p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="home insurance.html">Home Insurance</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="travel insurance.html">Travel Insurance</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="student insurance.html">Student Insurance</a></p>
  
          <hr>
            <p style="color: #1af33bde;">Life Insurance</p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="life insurance.html">Life Cover</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="life insurance.html">Critical Illness Cover</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="life insurance.html">Income Cover</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;"  href="protection telephone advice.html">Telephone Protection Advice</a></p>
        
        <hr>
        <p style="color: #1af33bde;">Insurance Claims</p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="home insurance.html">Home insurance claims</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="travel insurance.html">Travel insurance claims</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="car insurance.html">Car insurance claims</a></p>
      
         <hr>
         <p style="color: #1af33bde;">capitalguard Customers</p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="travel insurance.html">Travel insurance claims</a></p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="car insurance.html">Car insurance claims</a></p>
         
          </div>
            <button onclick="smallscreen(5)"  id="but1" ><p><b> Life Events   ( Help and Support) </b></p> </button>
            <div id="smalla5" class="divas2">
              <p style="color: #1af33bde;">Life Event</p>
              <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="berievement.html">Bereavement Support</a></p> 
              <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="seperation.html">Separation Support</a></p>
            <hr>
            <p style="color: #1af33bde;">Planning Tools</p>
            <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="review.html">Financial Health Check</a> </p>
            
              <p style="color: #1af33bde;">Customer Support</p>
              <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="services.html">Ways we can help</a></p>
             
               <p style="color: #1af33bde;">Individual Review</p>
               <p><a style="font-size: smaller;padding: 0;margin-left: 10px;" href="review.html">Book Your Review Today For a quick <br> <br> Financial Checkup</a></p>
      </div>

<script src="student.js"></script>
<script src="register.js"></script>
    <script src="index.js"></script>
                </body>
                </html>

    
