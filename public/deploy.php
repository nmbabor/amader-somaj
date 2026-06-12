<?php

/**
 * ===========================================================================
 *  ONE-TIME DEPLOYMENT HELPER  —  DELETE THIS FILE IMMEDIATELY AFTER USE.
 * ===========================================================================
 *
 *  Because FTP-only shared hosting has no SSH/terminal, this script lets you
 *  run the required Artisan commands once from your browser.
 *
 *  HOW TO USE
 *  1. Set $SECRET below to a long random string (and keep it private).
 *  2. Upload this file to your public/ folder (the document root).
 *  3. Visit:  https://amadersomaj.org/deploy.php?token=YOUR_SECRET&seed=1
 *       - Include &seed=1 ONLY on the very first deploy (it inserts sample
 *         data + the admin user). Omit it on later runs so data isn't reset.
 *  4. When it prints DONE, DELETE this file from the server. Leaving it is a
 *     security risk.
 */

$SECRET = 'CHANGE_ME_TO_A_LONG_RANDOM_STRING';

if ($SECRET === 'CHANGE_ME_TO_A_LONG_RANDOM_STRING') {
    http_response_code(403);
    exit('Open deploy.php and set a unique $SECRET first.');
}

if (! hash_equals($SECRET, (string) ($_GET['token'] ?? ''))) {
    http_response_code(403);
    exit('Forbidden.');
}

header('Content-Type: text/plain; charset=utf-8');

require __DIR__ . '/../vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

/** @var \Illuminate\Contracts\Console\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

function run($kernel, string $command, array $params = []): void
{
    echo "\n$ php artisan {$command}\n";
    try {
        $kernel->call($command, $params);
        echo $kernel->output();
    } catch (\Throwable $e) {
        echo 'ERROR: ' . $e->getMessage() . "\n";
    }
}

// Clear any stale cached config/routes first (important after changing .env).
run($kernel, 'config:clear');
run($kernel, 'cache:clear');

// Run migrations. Add ?seed=1 only on the first deploy.
$migrate = ['--force' => true];
if (($_GET['seed'] ?? '') === '1') {
    $migrate['--seed'] = true;
}
run($kernel, 'migrate', $migrate);

// Public symlink so uploaded images are reachable at /storage/...
run($kernel, 'storage:link');

// Cache config/routes/views for production speed.
run($kernel, 'config:cache');
run($kernel, 'route:cache');
run($kernel, 'view:cache');

echo "\n\n============================================================\n";
echo " DONE. Now DELETE public/deploy.php from the server.\n";
echo "============================================================\n";
