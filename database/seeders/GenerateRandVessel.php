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
        $owner = ['Dipa', 'Syarif', 'Syafik'];
        $ownersKey = array_rand($owner);
        $company = [
            'name' =>  "Shumaru Lab", 'registration_number' => rand(1000, 5000), 'phone' => '08123456789', 'owner' => $owner[$ownersKey], 'address' => "Jl. Celeng no 19, Indramayu"
        ];

        $perusahaan = Company::create($company);

        $harbor = [
            'name' => 'Pelabuhan Ratu'
        ];
        $fourDigitStr = '4525';
        $randMmsi = $fourDigitStr . (string) mt_rand(10000, 99999);
        // dd($randMmsi);
        $intRandMmsi = (int) $randMmsi;
        $type = ['Passenger', 'Crew'];
        $pelabuhan = Pelabuhan::create($harbor);
        for ($index = 0; $index < 5; $index++) {
            $start = strtotime('1990-01-01');
            $end = time();
            $timestamp = mt_rand($start, $end);
            $key = array_rand($type);
            $vessel = [
                'company_id' => $perusahaan['id'],
                'msg_type' => 18,
                'no_ais' => mt_rand(1000, 9999),
                'mmsi' => mt_rand(100000000, 999999999),
                'name' => 'SMR' . rand(1000, 2000),
                'imo' => rand(1000000, 9999999),
                'call_sign' => $this->generateRandomString(),
                'type' => $type[$key],
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
                    'mmsi' => $intRandMmsi,
                    'name' => 'SMR' . rand(1000, 2000),
                    'imo' => rand(1000000, 9999999),
                    'call_sign' => $this->generateRandomString(),
                    'type' => $type[$key],
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
