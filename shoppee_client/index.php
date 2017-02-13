<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Shopping Assistance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="frontend/assets/img/logo_01.jpg" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="frontend/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="frontend/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="frontend/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="frontend/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="frontend/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="frontend/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="frontend/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="frontend/pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/bootstrap-social.css"/>
    <script language="javascript" type="text/javascript" href="js/login.js"></script>
    <script language="javascript" type="text/javascript" href="js/register.js"></script>
    <script src="js/login.js"></script>
     <script src="js/register.js"></script>
    <!--[if lte IE 9]>
        <link href="frontend/pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="frontend/pages/css/windows.chrome.fix.css" />'
    }
    function funct(s)
    {
      var e=window.document.getElementById(s);
      e.hidden=true;
    }
    function funct1(source,em,name)
{
      var source=window.document.getElementById(source);
      source.hidden=true;
      var mn=window.document.getElementById(em);
      mn.style.color="black";
      var border=window.document.getElementById(name);
      border.style.borderColor="#ccc";
      border.style.boxShadow = 'inset 0 0 5px #ccc';
}
    </script>
  </head>
  <body class="fixed-header ">
     <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        

         
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                     <li>
                        <a href="#"></a>
                    </li>
                     <li>
                        <a href="#"></a>
                    </li>
                     <li>
                        <a href="#"></a>
                    </li>
                     <li>
                        <a href="#"></a>
                    </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-center">
                 <li>
                        <h1 style="color:white;align:center;" align="center">Shopping Assistance</h1>
                    </li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                      <a href="" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                          <li>
                            <div class="row">
                              <div class="col-md-12">
                                <form class="form" role="form" accept-charset="UTF-8" id="login-nav">
                                  <div class="form-group">
                                      <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                      <input type="email" class="form-control" id="emailId1" placeholder="Email address" required>
                                  </div>
                                  <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="password" class="form-control" id="regPassword1" placeholder="Password" required>
                                  </div>
                                    
                                  <div class="form-group">
                                       <input type="button" class="btn btn-success btn-block" value="Login" onclick="doLogin()"/>
                                      <div id='LoginStatus'>
                                      
                                      </div>
                                  </div>
                                 </form>
                              </div>
                           </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                           <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                           <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
                        </li>
                     </ul>
                  </li>
                    </li>
                    <li class="dropdown">
                     <a href="" class="dropdown-toggle" data-toggle="dropdown">Register <b class="caret"></b></a>
                     <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form" role="form"  accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Full name</label>
                                       <input type="text" class="form-control" id="fullName" placeholder="Full name" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                       <input type="email" class="form-control" id="emailId" placeholder="Email address" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="password" class="form-control" id="regPassword" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Confirm Password</label>
                                       <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                                    </div>

                                    
                                    <div class="form-group">            
                                    <input type="button" class="btn btn-success btn-block" value="Register" onclick="doRegister()"/>
                                    <div id='registrationStatus'>

                                    </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </li>
                        <li class="divider"></li>
                        
                     </ul>
                  </li>
                </ul>    
               
            
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
    
    <div class="login-wrapper ">
      

    	       <!-- START Login Background Pic Wrapper-->
      <img src="frontend/assets/img/demo/shop.jpg" data-src="frontend/assets/img/demo/shops.jpg" data-src-retina="frontend/assets/img/demo/shop.jpg" alt="" class="lazy" width="100%">
      
  		
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      
</div>

      
   
              
    <script src="frontend/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
    <script src="frontend/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="frontend/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="frontend/assets/plugins/bootstrap-select2/select2.min.js"></script>
    <script type="text/javascript" src="frontend/assets/plugins/classie/classie.js"></script>
    <script src="frontend/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="frontend/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="frontend/pages/js/pages.min.js"></script>
    <script type="text/javascript" src="frontend/assets/js/myerror.js"></script>
    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
  </body>
</html>