<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Pelabuhan;
use App\Models\Position;
use App\Models\Vessel;

use Illuminate\Database\Seeder;

class GenerateRandVessel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function random_float($min, $max)
    {
        return ($min + lcg_value() * (abs($max - $min)));
    }
    function generateRandomString($length = 8)
    {
        return 'Y' . substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
    public function run()
    {
        $company = [
            'name' =>  "Shumaru Lab", 'registration_number' => rand(1000, 5000), 'phone' => '08123456789', 'address' => "Jl. Celeng no 19, Indramayu"
        ];
        // dd($randLat);


        $perusahaan = Company::create($company);

        $harbor = [
            'name' => 'Pelabuhan Ratu'
        ];
        $type = ['Passenger', 'Crew'];
        $pelabuhan = Pelabuhan::create($harbor);
        // dd(date('Y', $timestamp));
        for ($index = 0; $index < 110; $index++) {
            $start = strtotime('1990-01-01');
            $end = time();
            $timestamp = mt_rand($start, $end);
            $key = array_rand($type);

            $vessel = [
                'pelabuhan_id' => $pelabuhan['id'],
                'company_id' => $perusahaan['id'],
                'msg_type' => 18,
                'mmsi' => mt_rand(100000000, 999999999),
                'name' => 'SMR' . rand(1000, 2000),
                'imo' => rand(1000000, 9999999),
                'call_sign' => $this->generateRandomString(),
                'type' => $type[$key],
                'length' => mt_rand(1, 70),
                'width' => mt_rand(1, 10),
                'netto' => mt_rand(1, 10),
                'gt' => mt_rand(30, 500),
                'years' => date('Y', $timestamp),
            ];
            // dd($vessel);
            $randLat = $this->random_float(0.100, 1.999);

            $vesselCreated =  Vessel::create($vessel);
            $positionCreated = Position::create([
                'vessel_id' => $vesselCreated->id,
                'speed' => round($this->random_float(1, 100), 4),
                'course' => round($this->random_float(1, 100), 4),
                'longitude' =>  round(108.3 + $randLat, 4),
                'latitude' => round(-6.2 + $this->random_float(0.100, 1.999), 4),
                'navigation_status' => 'Underway Using Engine'
            ]);
        }
    }
}
