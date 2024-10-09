<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

  // Schedule the vaccination reminder to run daily at 9 PM
  Schedule::command('email:send-vaccination-reminder')->dailyAt('21:00')->timezone('Asia/Dhaka');
