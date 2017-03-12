function doLogout()
{
	localStorage.removeItem("loggedInUser");
    window.open("index.php",'_self');
}