<?php

use Illuminate\Support\Facades\Artisan;

/**
 * Bright Future Consultancy - Hostinger Web Diagnostic & Setup Tool
 *
 * Access via browser: https://yourdomain.com/hostinger-setup.php
 * Note: Delete or rename this file after completing your live verification.
 */
define('BASE_PATH', dirname(__DIR__));

// Require autoloader to run Laravel bootstrap if available
$autoloadPath = BASE_PATH.'/vendor/autoload.php';
$bootstrapPath = BASE_PATH.'/bootstrap/app.php';

$app = null;
$laravelLoaded = false;

if (file_exists($autoloadPath) && file_exists($bootstrapPath)) {
    require_once $autoloadPath;
    $app = require_once $bootstrapPath;
    $laravelLoaded = true;
}

$action = $_GET['action'] ?? null;
$message = null;
$messageType = 'info';

// Handle Actions
if ($action === 'clear_cache' && $laravelLoaded) {
    try {
        Artisan::call('optimize:clear');
        $message = "Application cache cleared successfully!\n".Artisan::output();
        $messageType = 'success';
    } catch (Throwable $e) {
        $message = 'Error clearing cache: '.$e->getMessage();
        $messageType = 'danger';
    }
}

if ($action === 'storage_link') {
    $target = BASE_PATH.'/storage/app/public';
    $shortcut = __DIR__.'/storage';
    if (! file_exists($shortcut)) {
        if (function_exists('symlink')) {
            @symlink($target, $shortcut);
        }
        if (! file_exists($shortcut)) {
            @mkdir($shortcut, 0755, true);
        }
        $message = 'Storage shortcut configured successfully!';
        $messageType = 'success';
    } else {
        $message = 'Storage link already exists.';
        $messageType = 'info';
    }
}

// Checks
$phpVersion = PHP_VERSION;
$phpOk = version_compare($phpVersion, '8.2.0', '>=');

$sqliteActive = extension_loaded('sqlite3');
$pdoSqliteActive = extension_loaded('pdo_sqlite');

$sqliteFile = BASE_PATH.'/database/database.sqlite';
$sqliteFileExists = file_exists($sqliteFile);
$sqliteFileWritable = $sqliteFileExists && is_writable($sqliteFile);

$databaseDir = BASE_PATH.'/database';
$databaseDirWritable = is_writable($databaseDir);

$storageDir = BASE_PATH.'/storage';
$storageDirWritable = is_writable($storageDir);

$cacheDir = BASE_PATH.'/bootstrap/cache';
$cacheDirWritable = is_writable($cacheDir);

$dbStats = null;
if ($sqliteFileExists && $pdoSqliteActive) {
    try {
        $pdo = new PDO('sqlite:'.$sqliteFile);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $jobStmt = $pdo->query('SELECT COUNT(*) FROM job_posts');
        $jobsCount = $jobStmt ? $jobStmt->fetchColumn() : 0;

        $userStmt = $pdo->query('SELECT COUNT(*) FROM users');
        $usersCount = $userStmt ? $userStmt->fetchColumn() : 0;

        $settingsStmt = $pdo->query('SELECT COUNT(*) FROM site_settings');
        $settingsCount = $settingsStmt ? $settingsStmt->fetchColumn() : 0;

        $dbStats = [
            'jobs' => $jobsCount,
            'users' => $usersCount,
            'settings' => $settingsCount,
        ];
    } catch (Throwable $e) {
        $dbStats = ['error' => $e->getMessage()];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostinger Setup & Diagnostics - Bright Future Consultancy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body { background-color: #f1f5f9; font-family: system-ui, -apple-system, sans-serif; color: #1e293b; }
    .status-badge { font-weight: 700; padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.85rem; }
    .card-box { background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
  </style>
</head>
<body class="py-5">
  <div class="container" style="max-width: 800px;">
    
    <!-- Header -->
    <div class="text-center mb-4">
      <div class="d-inline-flex p-3 bg-success bg-opacity-10 text-success rounded-circle mb-2">
        <i class="fas fa-server fa-2x"></i>
      </div>
      <h2 class="fw-bold text-dark">Hostinger Deployment Diagnostics</h2>
      <p class="text-secondary small">Bright Future Consultancy • Laravel & SQLite Live Checker</p>
    </div>

    @if($message)
    <div class="alert alert-{{ $messageType }} alert-dismissible fade show rounded-3 mb-4">
      <pre class="mb-0" style="white-space: pre-wrap;">{{ $message }}</pre>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- System Requirements Check -->
    <div class="card-box p-4 mb-4">
      <h5 class="fw-bold text-dark mb-3"><i class="fas fa-check-double text-success me-2"></i> System & Extensions</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>PHP Version (>= 8.2)</strong>
            <small class="text-secondary d-block">Current: PHP <?= $phpVersion ?></small>
          </div>
          <span class="status-badge <?= $phpOk ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $phpOk ? 'PASS' : 'UPGRADE REQUIRED' ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>SQLite3 Extension</strong>
            <small class="text-secondary d-block">Required for file-based database operations</small>
          </div>
          <span class="status-badge <?= $sqliteActive ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $sqliteActive ? 'ACTIVE' : 'MISSING' ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>PDO_SQLite Extension</strong>
            <small class="text-secondary d-block">Required by Laravel Eloquent SQLite driver</small>
          </div>
          <span class="status-badge <?= $pdoSqliteActive ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $pdoSqliteActive ? 'ACTIVE' : 'MISSING' ?>
          </span>
        </li>
      </ul>
    </div>

    <!-- SQLite Database Status -->
    <div class="card-box p-4 mb-4">
      <h5 class="fw-bold text-dark mb-3"><i class="fas fa-database text-primary me-2"></i> SQLite Database File</h5>
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>database/database.sqlite exists</strong>
            <small class="text-secondary d-block">File size: <?= $sqliteFileExists ? round(filesize($sqliteFile) / 1024, 1).' KB' : '0 KB' ?></small>
          </div>
          <span class="status-badge <?= $sqliteFileExists ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $sqliteFileExists ? 'FOUND' : 'MISSING' ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>database.sqlite Writable (chmod 664/666)</strong>
            <small class="text-secondary d-block">Allows inserts, updates, and user submissions</small>
          </div>
          <span class="status-badge <?= $sqliteFileWritable ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $sqliteFileWritable ? 'WRITABLE' : 'READ-ONLY (CHMOD 666)' ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>database/ Folder Writable (chmod 775/777)</strong>
            <small class="text-secondary d-block">Required for SQLite journal locking files</small>
          </div>
          <span class="status-badge <?= $databaseDirWritable ? 'bg-success text-white' : 'bg-warning text-dark' ?>">
            <?= $databaseDirWritable ? 'WRITABLE' : 'CHECK PERMISSIONS' ?>
          </span>
        </li>
      </ul>

      @if($dbStats && !isset($dbStats['error']))
      <div class="row g-3 text-center pt-2">
        <div class="col-4">
          <div class="p-3 bg-light rounded-3">
            <h4 class="fw-bold text-success mb-0"><?= $dbStats['jobs'] ?></h4>
            <small class="text-secondary">Job Posts</small>
          </div>
        </div>
        <div class="col-4">
          <div class="p-3 bg-light rounded-3">
            <h4 class="fw-bold text-primary mb-0"><?= $dbStats['users'] ?></h4>
            <small class="text-secondary">Admin Users</small>
          </div>
        </div>
        <div class="col-4">
          <div class="p-3 bg-light rounded-3">
            <h4 class="fw-bold text-dark mb-0"><?= $dbStats['settings'] ?></h4>
            <small class="text-secondary">Site Settings</small>
          </div>
        </div>
      </div>
      @elseif(isset($dbStats['error']))
      <div class="alert alert-warning mb-0 small">
        <i class="fas fa-exclamation-triangle me-1"></i> Database Error: <?= htmlspecialchars($dbStats['error']) ?>
      </div>
      @endif
    </div>

    <!-- Storage & Permissions Check -->
    <div class="card-box p-4 mb-4">
      <h5 class="fw-bold text-dark mb-3"><i class="fas fa-folder-open text-warning me-2"></i> Storage & Cache Permissions</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>storage/ Directory</strong>
            <small class="text-secondary d-block">Logs, framework cache, and uploaded files</small>
          </div>
          <span class="status-badge <?= $storageDirWritable ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $storageDirWritable ? 'WRITABLE' : 'PERMISSION DENIED' ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <div>
            <strong>bootstrap/cache/ Directory</strong>
            <small class="text-secondary d-block">Compiled routes and package manifests</small>
          </div>
          <span class="status-badge <?= $cacheDirWritable ? 'bg-success text-white' : 'bg-danger text-white' ?>">
            <?= $cacheDirWritable ? 'WRITABLE' : 'PERMISSION DENIED' ?>
          </span>
        </li>
      </ul>
    </div>

    <!-- Quick Actions -->
    <div class="card-box p-4 mb-4 text-center">
      <h5 class="fw-bold text-dark mb-3">Hostinger Setup Actions</h5>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="?action=clear_cache" class="btn btn-outline-primary fw-bold rounded-pill px-4">
          <i class="fas fa-broom me-1"></i> Clear Application Cache
        </a>
        <a href="?action=storage_link" class="btn btn-outline-success fw-bold rounded-pill px-4">
          <i class="fas fa-link me-1"></i> Create Storage Link
        </a>
        <a href="/" class="btn btn-dark fw-bold rounded-pill px-4">
          <i class="fas fa-home me-1"></i> Go to Live Homepage
        </a>
        <a href="/admin/login" class="btn btn-success fw-bold rounded-pill px-4">
          <i class="fas fa-user-lock me-1"></i> Go to Admin Login
        </a>
      </div>
    </div>

    <!-- Security Warning -->
    <div class="alert alert-info text-center small rounded-3 mb-0">
      <i class="fas fa-shield-alt me-1 text-primary"></i> 
      <strong>Security Tip:</strong> After confirming that your website and admin portal are live on Hostinger, you can delete or rename <code>public/hostinger-setup.php</code> to keep your server secure.
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
