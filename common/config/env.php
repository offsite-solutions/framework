<?php
/**
 * Setup application environment through .env parameter file
 *
 */
$dotEnv = new \Dotenv\Dotenv(realpath(__DIR__.'/../../'));
$dotEnv->load();

// When YII_DEBUG and YII_ENV parameters are not set they will be initialized as false and prod respectively
defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ? : 'prod');
