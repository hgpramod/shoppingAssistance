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
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script src="../js/baseUrl.js"></script>
    <script src="../js/forgotPasswordCalls.js"></script>
  </head>
  <body style="background-color:#00aff0;color:white;text-align:center;font-family:'Poiret One'">
    <div class="panel panel-default" style="background-color:#00aff0;border:none;box-shadow:none;">
      <div class="panel-body" style="border:none;">
        <img src="../images/brandname.png" width="100" height="100"/>
        <br/>
        <label style="font-weight:bold;">Forgot Password</label>
      </div>
    </div>
    <div class="panel panel-default" id="loginDiv">
      <div class="panel-body" style="border:none;">
        <form method="POST">
          <table class="center">
            <tr>
              <td>
                <input type="text" id="emailId" class="textFields" placeholder="Registered Email Id"/>
              </td>
            </tr>
          </table>
        </form>
    </div>
    <div id='passwordStatus' style='text-align:center;'></div>
    <div class="panel panel-default" style="background-color:#00aff0;border:none;box-shadow:none;">
      <img src="../images/arrow.png" height="50px" onclick="doReset()">
    </div>
    <input type="button" value="Create Account" id="footer" onclick="registerCalls();" />
  </body>
  <script>
  function registerCalls()
  {
    window.open("register.php",'_self');
  }
  </script>
</html>