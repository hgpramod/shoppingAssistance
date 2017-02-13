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
     <link rel="stylesheet" type="text/css" href="css/calendar.css"/>
          <link rel="stylesheet" type="text/css" href="css/drop.css"/>

  <script src="js/calander.js"></script>
  <script src="js/drop.js"></script>
  <script src="js/picupload.js"></script>
  <script language="JavaScript" type="text/javascript">

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
               
                <ul class="nav navbar-nav navbar-center">
                 <li>
                        <a href="index.php"><h4 style="color:white;">Home</h4> <span ></span></a>
                    </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <li>
                     
                        
                    </li>

                  <li>
                        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">


              <span class="semi-bold">User</span> <span class="text-master">Name</span>
            </div>
            <div class="dropdown pull-right">
              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="/frontend/assets/img/profiles/index.jpg" alt="" data-src="frontend/assets/img/profiles/index.jpg" data-src-retina="frontend/assets/img/profiles/index.jpg" width="32" height="32">
            </span>
              </button>
              <ul class="dropdown-menu profile-dropdown" role="menu">
                <li><a href="#"><i class="pg-settings_small"></i> Settings</a>
                </li>
                <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
                </li>
                <li><a href="#"><i class="pg-signals"></i> Help</a>
                </li>
                <li class="bg-master-lighter">
                  <a href="index.php" class="clearfix">
                    <span class="pull-left">Logout</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
                    
                </ul>
               
            
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
    <br></br>
    <br></br>
    <br></br>
    
   
    <div>

    	       <!-- START Login Background Pic Wrapper-->
     <div class="row">
                              <div class="col-md-6">
                                 <form class="form" role="form"  accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Offer Name</label>
                                       <input type="text" class="form-control" id="Offer Name" placeholder="Offer Name" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Description</label>
                                       <input type="email" class="form-control" id="Description" placeholder="Description" required>
                                    </div>
                                   
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">detailed Description</label>
                                       <input type="password" class="form-control" id="confirmPassword" placeholder="detailed Description" required>
                                    </div>

                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Set your location</label>
                                       <input type="password" class="form-control" id="confirmPassword" placeholder="Set your location" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">upload image</label>
                                       <input type="password" class="form-control" id="confirmPassword" placeholder="upload image" required>
                                    </div>
                                     <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Add category</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#">Groceries</a>
    <a href="#">clothing</a>
    <a href="#">gadgets</a>
  </div>
</div>
<br></br>


                                     
                                     <form action="datepicker.cfm" method="post" name="frmMain" id="frmMain">

  Offers starting date: 
  <input type="text" value="Click me!" name="SelectedDate" id="SelectedDate"  onclick="GetDate(this);">
  <br></br>
  

</form>
                                    <form action="datepicker.cfm" method="post" name="frmMain" id="frmMain">

  offers ending date: 
  <input type="text" value="Click me!" name="SelectedDate" id="SelectedDate"  onclick="GetDate(this);">
  <br>
  
</form>
  <form action="picupload1.php" method="post" enctype="multipart/form-data">
<input type="file" name="upload[]"  id="upload" multiple style="height:28px; width:175px;" onchange="return ValidateFileUpload()">
<input type="submit">
</form>
<br></br>
                                   
                                    
                                    

                                    
                                    <div class="col-md-4">            
                                    <input type="button" class="btn btn-success btn-block" value="Save" onclick="doRegister()"/>
                                    <div id='registrationStatus'>

                                    </div>
                                    </div>
                                 </form>
                                 <form action="picupload1.php" method="post" enctype="multipart/form-data">

                              </div>
                           </div>
      
  		
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