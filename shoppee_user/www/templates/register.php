<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Shopping Assistance</title>

    <!-- Bootstrap CSS -->    
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="../css/bootstrap-theme.css" rel="stylesheet"/>
    <link href="../css/elegant-icons-style.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet"/>
    <link href="../css/customcss/registration.css" rel="stylesheet"/>
    <link href="../css/style-responsive.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script src="../js/buttonFunctions.js"></script>
    <script src="../js/registrationCalls.js"></script>
    <script src="../js/baseUrl.js"></script>
  </head>
  <body>
    <nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;position:fixed;height:50px;top:0px;border:none;box-shadow:none;color:white; z-index: 100">
        <div class="panel-body" style="border:none;text-align:center;">
            <label style="float:left;left:auto" onclick="goToLogin()">Cancel</label>
            <label style="font-weight:bold;">Create Account</label>
        </div>
    </nav>
    <div id="profilePic" style="background-color:#00aff0;width:100%;height:160px;text-align:center;z-index: -5">
        <div class="cameraButton">
            <i class="fa fa-camera fa-3x" style="margin-top:18px;opacity:0.5;"></i>
        </div>
    </div>
    <div class="panel panel-default" id="registrationForm" style="z-index:60 ;top:0px;">
        <div class="panel-body" style="border:none;">
            <label>full name</label>
            <input type="text" class="textFields" id="firstName" placeholder="First Name"/>
            <br/>
            <input type="text" class="textFields" id="lastName" placeholder="Last Name"/>
            <label>email id</label>
            <input type="text" class="textFields" id="emailId" placeholder="Required"/>
            <label>password</label>
            <input type="password" class="textFields" id="password" placeholder="Required"/>
            <input type="password" class="textFields" id="confirmPassword" placeholder="Repeat Password"/>
            <label>phone number</label>
            <input type="text" class="textFields" id="phoneNumber" placeholder="Phone Number"/>
            <input type="button" class="form-button" value="Create Account" onclick="doRegistration()"/>
            <div id='registrationStatus'></div>
        </div>
    </div>
  </body>
  <script type="text/javascript">
  function goToLogin()
  {
    window.open("login.php",'_self');
  }
  </script>>
</html>