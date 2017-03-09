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
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/customcss/login.css" rel="stylesheet"/>
    <link href="../css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/baseUrl.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../js/loginCalls.js"></script>
  </head>
  <body style="background-color:#880E4F;color:white;text-align:center;font-family:'Poiret One'">
    
    <div class="panel panel-default" style="background-color:#880E4F;">
      <div class="panel-body" style="border:none;background-color:#880E4F;">
        <img src="../images/brandname.png" width="150" height="75"/>
      </div>
      <div class="panel-body" style="border:none;" id="loginDiv">
        <form method="POST">
          <table class="center">
            <tr><td><label id="loginStatus"></label></td></tr>
            <tr>
              <td>
                <input type="text" id="emailId" class="textFields" placeholder="Registered Email Id"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" id="password" class="textFields" placeholder="Password"/>
              </td>
            </tr>

          </table>
        </form>
        <a href="forgotPassword.php" style="color:grey">Forgot Password?</a>
    </div>

    <button type="button" class="btn btn-danger" onclick="doLogin()" style="background-color: #C2185B;color:#ffffff; border-radius:12px"><b>Login</b></button>
    
      <input type="button" id="footer" value="Create Account" onclick="registerCalls();" />
  </body>
  <script>
  function registerCalls()
  {
    window.open("register.php",'_self');
  }
  </script>
</html>