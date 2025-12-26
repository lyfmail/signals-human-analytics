<?php
/**
 * Human Analytics – Global Configuration
 * v1 (Production)
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    | Used for future debugging / logging levels
    */
    'environment' => 'production', // production | development


    /*
    |--------------------------------------------------------------------------
    | Human Verification
    |--------------------------------------------------------------------------
    | Minimum score required to count a visit as a real human
    */
    'human_score_threshold' => 70,


    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    | v1 defaults to file-based logging
    */
    'log' => [
        'driver' => 'file', // file | database (database = future)
        'path'   => __DIR__ . '/../storage/logs/visits.log',
    ],


    /*
    |--------------------------------------------------------------------------
    | Security & Privacy
    |--------------------------------------------------------------------------
    | Used ONLY for hashing (never reversible)
    */
    'security' => [
        'hash_salt' => 'CHANGE_THIS_TO_A_RANDOM_STRING',
    ],


    /*
    |--------------------------------------------------------------------------
    | Admin Panel
    |--------------------------------------------------------------------------
    */
    'admin' => [
        'enabled' => true,
        'session_key' => 'human_analytics_admin',
    ],


    /*
    |--------------------------------------------------------------------------
    | Feature Flags (future-safe)
    |--------------------------------------------------------------------------
    */
    'features' => [
        'enable_admin_dashboard' => true,
        'enable_db_logging'      => false,
    ],
];
