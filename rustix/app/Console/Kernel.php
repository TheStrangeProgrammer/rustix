<?php

namespace App\Console;

use App\Http\Controllers\InventoryController;
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

        $schedule->call(function () {
            $this->bootstrap();

            $data["inventory"] = InventoryController::getInventory(config("rustix.depositId"));
            sleep(27);
            $data["rouletteRoll"]=rand(0,14);
            Storage::disk('local')->put('scheduleData.json', json_encode($data));
            sleep(30);
            $data["rouletteRoll"]=rand(0,14);
            Storage::disk('local')->put('scheduleData.json', json_encode($data));

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
