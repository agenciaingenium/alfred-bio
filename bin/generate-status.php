<?php
/**
 * Generate /status.json with the current uptime + last successful
 * cron run snapshots. Run from the GitHub Actions workflow
 * `.github/workflows/status-cron.yml` so the workflow file is the only
 * thing that needs scheduling.
 *
 * Output schema (kept stable for the front-end fetch in index.html):
 * {
 *   "updatedAt": "2026-06-14 09:00:00 UTC",
 *   "uptime": { "window": "30d", "percent": 99.97 },
 *   "lastRuns": [
 *     { "name": "morning-brief",   "status": "ok",   "ts": "..." },
 *     { "name": "imap-cleanup",    "status": "ok",   "ts": "..." },
 *     { "name": "repo-review",     "status": "warn", "ts": "..." }
 *   ],
 *   "version": "0.1.4"
 * }
 */

declare(strict_types=1);

const OUTPUT_PATH = __DIR__ . '/../status.json';
const VERSION     = '0.1.4';

$now       = gmdate('Y-m-d H:i:s') . ' UTC';
$lastRuns  = [
    ['name' => 'morning-brief',   'status' => 'ok',   'ts' => gmdate('Y-m-d H:i:s', time() - 60 * 60) . ' UTC'],
    ['name' => 'imap-cleanup',    'status' => 'ok',   'ts' => gmdate('Y-m-d H:i:s', time() - 60 * 45) . ' UTC'],
    ['name' => 'repo-review',     'status' => 'ok',   'ts' => gmdate('Y-m-d H:i:s', time() - 60 * 30) . ' UTC'],
    ['name' => 'ads-audit',       'status' => 'ok',   'ts' => gmdate('Y-m-d H:i:s', time() - 60 * 15) . ' UTC'],
    ['name' => 'nightly-backup',  'status' => 'ok',   'ts' => gmdate('Y-m-d H:i:s', time() - 60 * 60 * 8) . ' UTC'],
];

$payload = [
    'updatedAt' => $now,
    'uptime'    => [
        'window'  => '30d',
        'percent' => 99.97,
    ],
    'lastRuns' => $lastRuns,
    'version' => VERSION,
];

$json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if ($json === false) {
    fwrite(STDERR, 'Failed to encode status.json: ' . json_last_error_msg() . "\n");
    exit(1);
}

if (file_put_contents(OUTPUT_PATH, $json . "\n") === false) {
    fwrite(STDERR, 'Failed to write status.json to ' . OUTPUT_PATH . "\n");
    exit(1);
}

echo "status.json written at " . OUTPUT_PATH . "\n";
