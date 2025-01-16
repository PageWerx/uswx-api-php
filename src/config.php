<?php
/**
 * Load environment variables from .env
 */
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

require_once __DIR__ . '/Helpers/HelperFunctions.php';