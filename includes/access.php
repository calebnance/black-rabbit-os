<?php
class Access
{
	public static function notLoggedIn()
	{
        return !isset($_SESSION['loggedin']);
	}

    public static function notLoggedInOrPaid()
	{
        return (!isset($_SESSION['loggedin']) || !isset($_SESSION['paid']));
	}

	public static function paid()
	{
        return $_SESSION['paid'] === '1';
	}

	public static function notPaid()
	{
        return $_SESSION['paid'] !== '1';
	}
}
?>
