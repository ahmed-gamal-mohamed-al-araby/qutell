<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        for ($i = 1; $i < 605; $i++ ) {
            Page::create([
                'id' => $i,
                'uuid' => '8c2e3-dde4-48cc-'.$i.'a90-c80a6'.$i.'2d9bd'

            ]);
        }
    }
}
