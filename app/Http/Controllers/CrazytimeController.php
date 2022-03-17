<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Events\NewBalance;
use App\Models\User;
use App\Http\Requests\InventoryRequest;
use App\Models\BettingHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CrazytimeController extends Controller
{
    public function crazytime(){
        return view("layouts/crazytime");
    }
}