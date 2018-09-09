# Black Rabbit Joomla Component Creator (Open Source)

---

Easily create a fully installable Joomla 2.5/3.X component from scratch just by filling in the form!

### Final Stats

After the 3 years run, this component creator helped the [Joomla](https://www.joomla.org) community develop custom components/modules.

Here are some stats before I took it off-line and placed it here for the community to use:

* **Total Lines of Code Created:** 51,843,240
* **Total Components Created:** 25,194
* **Total Number of Files Created:** 3,589,922
* **Total Time Saved In All:** 216,013:30:0
	* 15 seconds allocated per line of code

### Terms of Use

This code set was written [5 years ago](https://twitter.com/calebnance/status/335807921076178944). I haven't updated it in more than a year, and the hosted site for this was hacked a couple months back. I didn't have time to fix everything, so I have decided to give the code to the Joomla community and let you all do with it as you'd like.

Literally anything goes, take this code apart, add to it, fork it, clone it, rebrand it, make money from it... **I don't care what you do with this code**. It's for whoever wants it.

I only ask that you leave my name somewhere in the code, it can be in the comments, where only a developer could see it, that's fine.

Please note I will keep this repo up, and if people want to improve on it, by all means do so. **Just hit up the pull requests** and have at it. I'll try and pull in the code that works.

Also this is OLD CODE, it could be cleaned up A LOT, I understand that, so with that being said, please test this on a local environment, before you put it out there on any production server. Putting this out on a production server will be **done at your own risk**. Like I said, this code set was hacked. But honestly I just didn't sanitize the uploads well enough I think.

Please take a look below and I will show you step by step, how to get this thing going on your dev environment!

Enjoy, and share the love.

:heart: Caleb Nance

### Installation

1. Open file `/includes/configuration.php`
	- Set $host, **$db_user**, **$db_pass**, **$db_name** for connection.
	- Edit all other variables in this file (**$base_url**, etc.)
2. Set up database... import sql into database (file: `/install/database.sql`)
3. Now that the database is installed and hooked up, go to url: `/admin/index.php`
4. This will allow you to set up the admin user.
5. Then you will want to create an account. Via Sign-Up
6. Make sure to change the **$email_to**, **$email_from** in the file: `/includes/configuration.php`
7. To get past the "Pay", set the user field `paypal_payment_status` to `1` or `true`.
8. Logout from the user frontend and log back in, and you should be good to go!
9. Component and Module mangers now should be running fine on your local environment!
