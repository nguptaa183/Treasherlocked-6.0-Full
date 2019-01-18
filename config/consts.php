<?php

$document_root = dirname(dirname(__FILE__)) . '/';

/*    Website    */
define(    'SITE_URL',         'https://www.treasherlocked.com/' );
define(    'SSTATIC',             'https://www.treasherlocked.com/_static/' );
define(    'DOCUMENT_ROOT',     $document_root );

/*    Pages    */
define('NON_NAV', -1);
define('HOME', 0);
define('ABOUT', 1);
define('HOW_TO_PLAY', 2);
define('RULES', 3);
define('HINTS', 4);
define('LEADERBOARD', 5);
define('MINI_SERIES', 6);

/* OAuth (OpenID) login types */
define('OAUTH_DEFAULT', 0);
define('OAUTH_FACEBOOK', 1);
define('OAUTH_GOOGLE', 2);
define('OAUTH_TWITTER', 3);

date_default_timezone_set('Asia/Calcutta');

/*    Main Event     */
define('EVENT_START', strtotime('2019-01-11 21:00:00'));
define('EVENT_END', strtotime('2019-01-13 21:00:00'));

/*    Event's Constant    */
define('EVENT_NOT_STARTED', 0);
define('EVENT_STARTED', 1);
define('EVENT_CLOSED', 2);

/*    GAME    */
define('NO_OF_LEVELS', 20);
define('RANKING_LIMIT', 2);

/*** Mini Event ***/
define('MINI_START_DATE', strtotime('2016-11-28 00:00:00'));
define('MINI_END_DATE', strtotime('2016-11-30 00:00:00'));
define('MINI_START_TIME', 21 * 3600);
define('MINI_END_TIME', 23 * 3600 + 59 * 60);
