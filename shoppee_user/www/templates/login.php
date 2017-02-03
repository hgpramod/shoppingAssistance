<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>OfferMonk</title>

    <!-- Bootstrap CSS -->    
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="../css/bootstrap-theme.css" rel="stylesheet"/>
    <link href="../css/elegant-icons-style.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/customcss/login.css" rel="stylesheet"/>
    <link href="../css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/baseUrl.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../js/loginCalls.js"></script>
  </head>
  <body style="background-color:#00aff0;color:white;text-align:center;font-family:'Poiret One'">
    <div class="panel panel-default" style="background-color:#00aff0;border:none;box-shadow:none;">
      <div class="panel-body" style="border:none;">
        <img src="../images/brandname.png" width="100" height="100"/>
        <br/>
        <label style="font-weight:bold;">Sign In</label>
      </div>
    </div>
    <div class="panel panel-default" id="loginDiv">
      <div class="panel-body" style="border:none;">
        <form method="POST">
          <table class="center">
            <tr>
              <td>
                <input type="text" id="emailId" class="textFields" placeholder="Email Id"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" id="password" class="textFields" placeholder="Password"/>
              </td>
            </tr>
          </table>
        </form>
        <a href="forgotPassword.php">Forgot Password?</a>
    </div>

    <div class="panel panel-default" style="background-color:#00aff0;border:none;box-shadow:none;">
      <img src="../images/arrow.png" height="50px" onclick="doLogin()">
    </div>
    <label id="loginStatus"></label>
      <input type="button" id="footer" value="Create Account" onclick="registerCalls();" />
  </body>
  <script>
  function registerCalls()
  {
    window.open("register.php",'_self');
  }
  </script>
</html>