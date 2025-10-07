<?php
defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);


// DB
defined('DBDRIVER') or define('DBDRIVER', 'mysql');
defined('DBHOST') or define('DBHOST', 'localhost');
defined('DBNAME') or define('DBNAME', 'db_default');
defined('DBUSER') or define('DBUSER', 'root');
defined('DBPASS') or define('DBPASS', '');


// Contacts
defined('CONTACT_EMAIL_NAME') or define('CONTACT_EMAIL_NAME', 'Contact');
defined('CONTACT_EMAIL') or define('CONTACT_EMAIL', 'contact@dicermvc');


defined('APP_NAME') or define('APP_NAME', 'dicermvc');
defined('APP_ROOT') or define('APP_ROOT', 'C:/xampp/htdocs/github/dicer-mvc');
defined('APP_URL') or define('APP_URL', '/github/dicer-mvc/');


defined('APP_ASSETS_PATH') or define('APP_ASSETS_PATH', APP_ROOT . DS . "assets");
defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', APP_ROOT . DS . "view");
