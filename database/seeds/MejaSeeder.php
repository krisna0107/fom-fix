<?php

use Illuminate\Database\Seeder;
use App\Meja;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++){
            Meja::insert([
                'meja' => "meja ".$i
            ]);
        }
    }
}
