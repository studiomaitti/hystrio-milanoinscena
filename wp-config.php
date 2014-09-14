<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file definisce le seguenti configurazioni: impostazioni MySQL,
 * Prefisso Tabella, Chiavi Segrete, Lingua di WordPress e ABSPATH.
 * E' possibile trovare ultetriori informazioni visitando la pagina: del
 * Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Editing wp-config.php}. E' possibile ottenere le impostazioni per
 * MySQL dal proprio fornitore di hosting.
 *
 * Questo file viene utilizzato, durante l'installazione, dallo script
 * di creazione di wp-config.php. Non � necessario utilizzarlo solo via
 * web,� anche possibile copiare questo file in "wp-config.php" e
 * rimepire i valori corretti.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - E? possibile ottenere questoe informazioni
// ** dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'misce_DB_f4d7fcm');

/** Nome utente del database MySQL */
define('DB_USER', 'misce_UT_f2k8lw9');

/** Password del database MySQL */
define('DB_PASSWORD', 'X_-Rs9A3KP8j_643jB78Pua6J');

/** Hostname MySQL  */
define('DB_HOST', 'localhost');

/** Charset del Database da utilizare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha
idea di cosa sia. */
define('DB_COLLATE', '');

define( 'AUTOMATIC_UPDATER_DISABLED', true );

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * E' possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * E' possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ci� forzer� tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3IN%wIS0v226vdXBY?6P}y6db%s68&+&|L|r2(lp-hS!N3e!12<MK}uu*tIq!wgo');
define('SECURE_AUTH_KEY',  'CUEUlLnb2/30/Zq|X`r7({Q*uDz<yQx`o!0[6QE.5IENXlEySul?*|hA]1/h&WM&');
define('LOGGED_IN_KEY',    '/~6J`[XD%QA]&LNaC|7M4)y[>F?7~sCdAWAS3z{&7yXL--@ICW`-RKu+OmR2D]^b');
define('NONCE_KEY',        'v~(t2F]-#E*-|^1RUs3(+?z@Ix?tuEbH8[uV--1T;/e7BtI&afWp#*F/TYD2sK_i');
define('AUTH_SALT',        'I77k=#m= _j,:HTtl9Pm`d|g>R6?er5)g|JK_`#TEZ.jOpj)0Dt>kks<jZQHhY,&');
define('SECURE_AUTH_SALT', 'qfIGl5De<= ^,vdMwupc(-~M5lj]m*8X%K.8i~{29F?,;0/utAOcO]9<D#0P-+$x');
define('LOGGED_IN_SALT',   'zk1P1I]izm+:uzggdjw@C0@#m(F*|y&rIfF)qXok %YQ:t-4R1HOT<>uq@cywUqW');
define('NONCE_SALT',       'M0+P1!sji2-(p<CzwJ&j)-~nGip]]9wH~-IVSMT.^YbTg69htv8{~27d8>t3P9gW');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress .
 *
 * E' possibile avere installazioni multiple su di un unico database if you give each a unique
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'mis39hcjkl_';

/**
 * Lingua di Localizzazione di WordPress, di base Inglese.
 *
 * Modificare questa voce per localizzare WordPress. Occorre che nella cartella
 * wp-content/languages sia installato un file MO corrispondente alla lingua
 * selezionata. Ad esempio, installare de_DE.mo in to wp-content/languages ed
 * impostare WPLANG a 'de_DE' per abilitare il supporto alla lingua tedesca.
 *
 * Tale valore � gi� impostato per la lingua italiana
 */
define('WPLANG', 'it_IT');

/**
 * Per gli sviluppatori: modalit� di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * E' fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all'interno dei loro ambienti di sviluppo.
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta lle variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');
