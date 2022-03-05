<?php

namespace App\Console;

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RouletteController;
use App\Http\Controllers\XRouletteController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->bootstrap();
        $schedule->call(function () {


            $inventory["inventory"] = InventoryController::getInventory(config("rustix.depositId"));
            Storage::disk('local')->put('depositInventory.json', json_encode($inventory));

        })->everyMinute()->runInBackground();
        $schedule->call(function () {
            PriceController::updateAllItemPrices();
        })->hourly()->runInBackground();
        $schedule->call(function () {
            BotController::loginDeposit();
            BotController::loginBot(1);
            BotController::loginBot(2);
            BotController::loginBot(3);
        })->hourly()->runInBackground();
        $schedule->call(function () {
            UserController::resetFaucet();
        })->daily()->runInBackground();
        //main loop
        $schedule->call(function () {
            sleep(29);
            RouletteController::newOutcome();
            XRouletteController::newOutcome();
            sleep(30);
            RouletteController::newOutcome();
            XRouletteController::newOutcome();

        })->everyMinute()->runInBackground();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\Administrator::class,
    ];
}
