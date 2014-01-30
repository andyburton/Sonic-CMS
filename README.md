Sonic CMS
===========

CMS designed to run with the Sonic Framework

Folder structure:
===========

/
/Sonic-Framework
/Sonic-Framework/classes/
...
/Sonic-CMS
/Sonic-CMS/public_html/
...
/smarty
/smarty/Smarty.class.php
/smarty/plugins/
/smarty/sysplugins/
...

Setup
===========

Download the Sonic-Framework to the parent directory from https://github.com/andyburton/Sonic-Framework

Download the Sonic-CMS to the parent directory from https://github.com/andyburton/Sonic-CMS

Download smarty v3 to the parent directory from http://smarty-php.googlecode.com/svn/trunk/distribution/libs

Create a new MySQL database and user for the CMS system and import the /Sonic-CMS/sql/sonic_cms.sql file

Configure the database connection details in /Sonic-CMS/config/dev/db/default.php

If the Sonic-Framework or Smarty directory location is different you can configure this in /Sonic-CMS/config/dev/paths.php and smarty.php

You can configure the SMTP details for outbound email (used by the CMS admin user system to send passwords to new users) in /Sonic-CMS/config/email.php

Create your vhost to point to /Sonic-CMS/public_html adding the framework config variable e.g.

<VirtualHost *:80>

        SetEnv SONIC_CONFIG dev
        ServerName yourdomain.co.uk

        DocumentRoot /var/www/Sonic-CMS/public_html

        <Directory /var/www/Sonic-CMS/public_html>
                Options FollowSymLinks
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

        ErrorLog /var/log/apache2/sonic_cms.error.log
        CustomLog /var/log/apache2/sonic_cms.access.log combined

</VirtualHost>

Open yourdomain.com/admin and login using the default credentials:

Username: andy@andyburton.co.uk
Password: password
