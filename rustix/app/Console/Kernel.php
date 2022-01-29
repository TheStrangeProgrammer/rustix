<?php

namespace App\Console;

use App\Http\Controllers\InventoryController;

use App\Http\Controllers\RouletteController;
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

        })->everyMinute();
        $schedule->call(function () {
            sleep(27);
            RouletteController::newOutcome();
            sleep(30);
            RouletteController::newOutcome();

        })->everyMinute();
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

}
