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
        $this->bootstrap();
        $schedule->call(function () {


            $inventory["inventory"] = InventoryController::getInventory(config("rustix.depositId"));
            Storage::disk('local')->put('depositInventory.json', json_encode($inventory));

        })->everyMinute();
        $schedule->call(function () {
            sleep(27);
            $roulette["rouletteRoll"]=rand(0,14);
            $roulette["rouletteLast100"]=[];
            if(Storage::disk('local')->exists('rouletteData.json')){
                $roulette["rouletteLast100"]=json_decode(Storage::disk('local')->get('rouletteData.json'))->rouletteLast100;
                if(count($roulette["rouletteLast100"])==0){
                    $roulette["rouletteLast100"]=[];
                }
            }
            if(count($roulette["rouletteLast100"])>=100){
                array_pop($roulette["rouletteLast100"]);
            }
            array_unshift($roulette["rouletteLast100"],$roulette["rouletteRoll"]);

            Storage::disk('local')->put('rouletteData.json', json_encode($roulette));
            sleep(30);
            $roulette["rouletteRoll"]=rand(0,14);
            $roulette["rouletteLast100"]=[];
            if(Storage::disk('local')->exists('rouletteData.json')){
                $roulette["rouletteLast100"]=json_decode(Storage::disk('local')->get('rouletteData.json'))->rouletteLast100;
                if(count($roulette["rouletteLast100"])==0){
                    $roulette["rouletteLast100"]=[];
                }
            }
            if(count($roulette["rouletteLast100"])>=100){
                array_pop($roulette["rouletteLast100"]);
            }
            array_unshift($roulette["rouletteLast100"],$roulette["rouletteRoll"]);
            Storage::disk('local')->put('rouletteData.json', json_encode($roulette));

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
