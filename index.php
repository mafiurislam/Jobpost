<?php

/**
 * Bright Future Consultancy - Hostinger Root Fallback Entry Point
 *
 * If your domain's DocumentRoot on Hostinger is pointed directly to public_html/ (the project root)
 * rather than public_html/public, this script smoothly routes requests into the standard Laravel
 * public/index.php front controller.
 */

require_once __DIR__.'/public/index.php';
