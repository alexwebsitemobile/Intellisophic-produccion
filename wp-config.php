<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'intellisophic');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'developer');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost:3306');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'czdU_<)A}$`XPa%geQ`wudYFQs%pbFH`i_`l/?ap;hD&4F8L8rxAV72gM?U`3/+p');
define('SECURE_AUTH_KEY', '#?$[@B^U,GOyS[)u{wj~mZE_hph&S7.z 1<)uO2Int1i]<k@IFV!o-o|Z1^U/ElI');
define('LOGGED_IN_KEY', 'Ok6h,jQjDHh8cyUZ@F05bw/X[8W{a8I .vfE0.(K&98}:XpwuGbJ-ZIfN666l^4L');
define('NONCE_KEY', 'ET)S(z]yIH3*-uPQJu0t9w:~#2a5B2+M24t| PwG{t~KnHJ#:6y>?4~JZo10Xx3G');
define('AUTH_SALT', 'bCmJ*7rRFIy?I}Lqd=90IUknU{:9zO72u`yvu#l,W#CA%+PGH|v>8if(N|Bj2[Wa');
define('SECURE_AUTH_SALT', 'r_m>GIowqoY9Wu$.Ij_x`ZSH]M-r/8X_4SJ}$Nwf68C@0=0n .IY@EXe-^/d^c7B');
define('LOGGED_IN_SALT', 'dzyfe{oNUi!:e rA0W[{^4*R^d7lHGR~dWSE9sBeZOn-pbzh?81LF?s1L :}#9oM');
define('NONCE_SALT', 'r_j7kpSXTEjKNV*!Q7J~L<-.,2z/2rjlu>3$,+$N+`b@iXpn8tNW+?$Z-fAhsHT=');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('DISALLOW_FILE_EDIT', true);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

