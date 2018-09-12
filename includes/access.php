<?php
class Access
{
	public static function notLoggedIn()
	{
        return !isset($_SESSION['loggedin']);
	}

    public static function notLoggedInOrPaid()
	{
        return !isset($_SESSION['loggedin']) || !isset($_SESSION['paid']);
	}
}
?>
