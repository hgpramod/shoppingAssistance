<?php  
    session_unset($_SESSION[email2]);
    unset($_SESSION[email2]);
    unset($_SESSION[password2]);
    unset($_SESSION[emailId]);
    
    session_destroy();  
?>  
<!DOCTYPE html>
<html>
  <head>
    <script>
      localStorage.removeItem("loggedInUser");
      window.open("index.php",'_self');
    </script>
  </head>
</html>