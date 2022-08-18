<?php

namespace App\Console\Commands;

use App\Events\SendLocation;
use App\Models\Position;
use App\Models\Vessel;
use Illuminate\Console\Command;

class GenerateRandLatLng extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:randlatlng';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    function random_float($min, $max)
    {

        return ($min + lcg_value() * (abs($max - $min)));
    }
    public function handle()
    {
        $vesselIds = Vessel::select('id')->pluck('id')->toArray();
        $vessels = Vessel::whereKey($vesselIds)->with('latestPosition')->get();
        // $vessels->forget(1);
        // dd($vessels);
        $count = 0;
        foreach ($vessels as $vessel) {
            $randomLat = round($this->random_float(0.0001, 0.0006), 4);
            $randomLong = round($this->random_float(0.001, 0.006), 4);
            $parseLat = (float)$vessel->latestPosition->latitude;
            $parseLng = (float)$vessel->latestPosition->longitude;
            $lat = round($parseLat - $randomLat, 4);
            $lng = round($parseLng + $randomLong, 4);
            $position = new Position();
            $position->vessel_id = $vessel->id;
            $position->speed = $vessel->latestPosition->speed;
            $position->course = $vessel->latestPosition->course;
            $position->latitude = $lat;
            $position->longitude = $lng;
            $position->navigation_status = $vessel->latestPosition->status;
            $position->save();
            SendLocation::dispatch($vessel);
            // sleep(1);
            $count += 1;
        }
        print($count);
        return print("command sedang berjalan");
    }
}
