<?php 

/**
 *  database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "t06seodbu");    // The database username. 
define("PASSWORD", "Pp123456");    // The database password. 
define("DATABASE", "t06seodb");    // The database name.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!




/* ANA DİZİN  / LI */

define("BASE", "/");

/* YÖNETİM DİZİN  / LI */

define("BASE_ADMIN", "/yonetim/");


/* ANA DİZİN URL FORMATINDA   / SIZ */
define("URLBASE", "/");



/* UPLOAD DIZINI   / sız */
define("UPLOADDIR", "../upload");



/* UPLOAD DIZINI / ile
define("MAXFILESIZE", "11000000");
// Aşağı yukarı 10 MB yapıyor canım
 */


// timezone
date_default_timezone_set('Europe/Istanbul');


?>