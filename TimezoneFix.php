
STEP-Add two
1)  /var/www/fieldsales/config/app.php

<!-- start -->
'timezone' => env('DB_TIMEZONE', 'UTC'),
    'cron_timezone' => env('CRON_TIMEZONE', 'UTC'),
<!-- end -->

2) /var/www/fieldsales/app/Console/Kernel.php

<!-- start -->
DB_TIMEZONE = 'Asia/Kolkata'
CRON_TIMEZONE='Asia/Kolkata'
<!-- end -->
