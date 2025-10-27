<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code


/** Table Name */
define('ADMIN_TABLE', 'admin');
define('VENDOR_TABLE', 'vendor');
define('CUSTOMER_TABLE', 'customer');
define('CATEGORY_TABLE', 'category');
define('PRODUCT_TABLE', 'product');
define('OTP_LIST_TABLE', 'otp_list');
define('REQUEST_LIST_TABLE', 'request');
define('PRODUCT_RATING_LIST_TABLE', 'product_rating');
define('PRODUCT_IMAGE_TABLE', 'product_image');
define('EMAIL', 'sales@foundrybiz.com');
define('EMAIL_APP_NAME', 'FoundryBiz');
define('VENDOR_REGISTER_EMAIL_SUBJECT_FOR_SELLER', 'Thank you for registering with FoundryBiz as a Seller');
define('VENDOR_REGISTER_EMAIL_BODY', 'We’re reviewing your account, and once it’s activated, your login credentials will be shared with you via email.');






////////////////////
define('ACTIVE_STATUS', 'active');
define('INACTIVE_STATUS', 'inactive');
define('DELETED_STATUS', 'deleted');

define('OTP_LIST_FORGOT_PASSWORD', 'forgot_password');

define('USER_TYPE_ADMIN', 'admin');
define('USER_TYPE_VENDORS', 'vendor');
define('USER_TYPE_CUSTOMER', 'customer');

define('ADMIN_JWT_TOKEN', 'admin_jwt_token');
define('VENDOR_JWT_TOKEN', 'vendor_jwt_token');
define('CUSTOMER_JWT_TOKEN', 'customer_jwt_token');
define('FOOTER_EMAIL', 'shankar@foundrybiz.in');
define('FOOTER_PHONE', '+91 7821839934');
define('COMMOUNUTY_URL_LINK', 'https://www.skool.com/foundry-club-9501/about');
