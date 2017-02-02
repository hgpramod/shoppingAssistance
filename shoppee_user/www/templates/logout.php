<!DOCTYPE html>
<html lang="en">
<head>
	<script src="../js/baseUrl.js"></script>
</head>
<body>
	<script type="text/javascript">
		if(typeof(Storage)!="undefined")
		{
			localStorage.removeItem("user");
			localStorage.removeItem("timestamp");
			window.open("../templates/login.php",'_self');
		}
	</script>
</body>
</html>