<?php



return [
    'dsn' => env('QB_DSN'),
    'encryption_key' => env('APP_KEY'),
    'sandbox' => env('QBO_SANDBOX'),
    'token' => env('QB_TOKEN'),
    'oauth_consumer_key' => env('QB_OAUTH_CONSUMER_KEY', 'ABMxfpr7qZNqo16JnmSDGQO83FhZ6vG4bdExs5EQNPbYyIXgGK'),
    'oauth_consumer_secret' => env('QB_OAUTH_CONSUMER_SECRET', 'iZViRdz6EkJEIke3Gfd0e0YIOv6Yn8k1xEe78gWF'),
    'quickbooks_oauth_url' => env('QB_OAUTH_URL', '/oauth2/v1/tokens/bearer'),
    'quickbooks_success_url' => env('QB_SUCCESS_URL', ''),
    'the_username' => env('QB_USERNAME', 'janasir35@gmail.com'),
    'the_tenant' => env('QB_TENANT', '')

];
