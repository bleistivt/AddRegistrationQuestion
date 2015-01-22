Thanks for using the Plugin.

Some notes that may help you understand vanilla registration itself. (you may have to read this a few times to soak in, it may be confusing, but it will become crystal clear if you read it a few times).

there are four different types of registration available from dashboard. which is part of the vanilla core and nothing to do with this plugin!

Basic method from dashboard equates to Captcha in config.php

this is for your protection so your forum is not wide open to spammers.

all other registration options from the dashboard are as expected.

your choice is reflected in config.php

e.g. these are the four options from the dashboard.

Dashboard Setting| 	|  respective setting in config.php
============================================================================================
Approval 	        |  $Configuration['Garden']['Registration']['Method'] = 'Approval';
Basic 	                |  $Configuration['Garden']['Registration']['Method'] = 'Captcha';
Invitation 	        |  $Configuration['Garden']['Registration']['Method'] = 'Invitation';
Connect 	        |  $Configuration['Garden']['Registration']['Method'] = 'Connect';

A fifth option is available via config.php

the most basic registration method....

$Configuration['Garden']['Registration']['Method'] = 'Basic'; // just absolute basic no Captcha




Only if you want to set up Basic Registration... (see below).
---------------------------------------------------------------------------------------------------------------------------------

$Configuration['Garden']['Registration']['Method'] = 'Basic';

the above option is not available by the dashboard registration settings.

BE AWARE - if you have changed the Registration method in config.php if you disable the addregistration question plugin, you should go back into the registrations settings page and reset your registration options.


further detailed explanation ....

To set this up, you have to edit the Vanilla configuration file (/conf/config.php). Where the setting is:

$Configuration['Garden']['Registration']['Method'] = 'Captcha';

change "Captcha" to "Basic". It should look like this when you finish:

$Configuration['Garden']['Registration']['Method'] = 'Basic';

(If it says something other than "Captcha", when you first go in, that's okay, just change whatever it says to "Basic" "Captcha" is Vanilla's default - and it corresponds to their "Basic" setting in the admin control panel under Users/Registration).

This "Basic" config.php setting is not the same as the "Basic" setting that you'll see in the Vanilla admin panel under Users/Registration. When you save the config.php file, then go back to the Vanilla admin panel to Users/Registration and verify that NONE of the methods are selected.
This is as it should be because you have just changed the setting in the config.php file itself - to a "Basic" method that is not the same as the default "Basic" setting that comes with Vanilla.

Now, try to register a new user account. You should see that the registration form contains the AddRegistration question that you've created but does not contain the captcha. If you want to use both captcha and the AddRegistration question, then go back to Users/Registration in the Vanilla admin panel and this time select "Basic" and save. By doing this, it will show both elements.
