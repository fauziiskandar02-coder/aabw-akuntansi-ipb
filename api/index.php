<?php

/**
 * Vercel Serverless Function Bridge for CodeIgniter 4
 */

// Tell CodeIgniter it's running in Vercel environment
$_ENV['VERCEL'] = '1';

// Forward request to CodeIgniter 4 front controller
require __DIR__ . '/../public/index.php';
