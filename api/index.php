<?php

/**
 * Vercel Serverless Function Bridge for CodeIgniter 4
 */

$_ENV['VERCEL'] = '1';

// Normalize SCRIPT_NAME and SCRIPT_FILENAME so CodeIgniter 4 URI detector
// behaves identically to standard public/index.php execution
$_SERVER['SCRIPT_NAME']     = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Normalize document root and working directory
$_SERVER['DOCUMENT_ROOT']   = __DIR__ . '/../public';
chdir(__DIR__ . '/../public');

require __DIR__ . '/../public/index.php';
