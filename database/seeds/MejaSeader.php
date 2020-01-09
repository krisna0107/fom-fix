<?php

use Illuminate\Database\Seeder;
use App\Meja;

class MejaSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++){
            Konten::insert([
                'meja' => "meja $i",
            ]);
        }
    }
}
