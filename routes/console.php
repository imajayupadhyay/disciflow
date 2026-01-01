<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Register custom artisan commands here

// Schedule budget alert checks to run daily at 9:00 AM
Schedule::command('budget:check-alerts')->dailyAt('09:00');
