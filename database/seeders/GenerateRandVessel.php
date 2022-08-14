<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Pelabuhan;
use App\Models\Position;
use App\Models\User;
use App\Models\Vessel;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
        $path = Storage::disk('local')->get('flags.json');
        $mmsi = json_decode($path, true);
        $key = array_rand($mmsi);
        // dd($mmsi[$key]['mid']);

        $user =  User::where('role', 'owner')->firstOrFail();
        $company = [
            'user_id' => $user->id,
            'name' =>  "Shumaru Lab",
            'registration_number' => rand(1000, 5000),
            'phone' => '08123456789',
            'address' => "Jl. Celeng no 19, Indramayu",
            'owner' => $user->name,
        ];

        $perusahaan = Company::create($company);

        $harbor = [
            'name' => 'Pelabuhan Ratu'
        ];
        $firstThreeDigitMmsi = '525';
        $type = ['Passenger', 'Crew'];
        $pelabuhan = Pelabuhan::create($harbor);
        for ($index = 0; $index < 5; $index++) {
            $start = strtotime('1990-01-01');
            $end = time();
            $timestamp = mt_rand($start, $end);
            $keyType = array_rand($type);
            $vessel = [
                'company_id' => $perusahaan['id'],
                'msg_type' => 18,
                'no_ais' => mt_rand(1000, 9999),
                'mmsi' =>  $mmsi[$key]['mid'] .  (string) mt_rand(100000, 999999),
                'name' => 'SMR' . rand(1000, 2000),
                'imo' => rand(1000000, 9999999),
                'call_sign' => $this->generateRandomString(),
                'type' => $type[$keyType],
                'image' => 'asd',
                'length' => mt_rand(1, 70),
                'width' => mt_rand(1, 10),
                'netto' => mt_rand(1, 10),
                'gt' => mt_rand(30, 500),
                'years' => date('Y', $timestamp),
            ];

            if ($index === 0 || $index === 1 || $index === 2) {

                $vesselCreated =  Vessel::create($vessel);
            } else {
                $vesselCreated = Vessel::create([
                    'company_id' => $perusahaan['id'],
                    'msg_type' => 18,
                    'no_ais' => mt_rand(1000, 9999),
                    'mmsi' => $firstThreeDigitMmsi .  (string) mt_rand(100000, 999999),
                    'name' => 'SMR' . rand(1000, 2000),
                    'imo' => rand(1000000, 9999999),
                    'call_sign' => $this->generateRandomString(),
                    'type' => $type[$keyType],
                    'image' => 'asd',
                    'length' => mt_rand(1, 70),
                    'width' => mt_rand(1, 10),
                    'netto' => mt_rand(1, 10),
                    'gt' => mt_rand(30, 500),
                    'years' => date('Y', $timestamp),
                ]);
            }
            if ($index === 0 || $index === 1 || $index === 2) {
                Position::create([
                    'vessel_id' => $vesselCreated->id,
                    'speed' => round($this->random_float(1, 100), 4),
                    'course' => round($this->random_float(1, 100), 4),
                    'longitude' =>  round(103.8 + $this->random_float(0.100, 1.999), 4),
                    'latitude' => round(5.2 - $this->random_float(0.100, 0.500), 4),
                    'navigation_status' => 'Underway Using Engine'
                ]);
            } else {

                $positionCreated = Position::create([
                    'vessel_id' => $vesselCreated->id,
                    'speed' => round($this->random_float(1, 100), 4),
                    'course' => round($this->random_float(1, 100), 4),
                    'longitude' =>  round(108.3 + $this->random_float(0.100, 1.999), 4),
                    'latitude' => round(-6.2 + $this->random_float(0.100, 1.999), 4),
                    'navigation_status' => 'Underway Using Engine'
                ]);
            }
        }
    }
}
