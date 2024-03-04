<?php 

/**
 *  database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("DATABASE", "polydb");    // The database name.
define("USER", "polydbu");    // The database username. 
define("PASSWORD", "F6du0c~68");    // The database password. 
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

$ynt_files = "https://www.seotimi.com/ynt_files";

/* ANA DİZİN  / LI */

define("BASE", "/");

/* YÖNETİM DİZİN  / LI */

define("BASE_ADMIN", "/yonetim/");


/* ANA DİZİN URL FORMATINDA   / SIZ */
define("URLBASE", "/");



/* UPLOAD DIZINI   / sız */
define("UPLOADDIR", "../upload");




/* UPLOAD DIZINI / ile */
define("MAXFILESIZE", "11000000");
// Aşağı yukarı 10 MB yapıyor canım



// timezone
date_default_timezone_set('Europe/Istanbul');


?>