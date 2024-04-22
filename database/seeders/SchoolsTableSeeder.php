<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //run as php artisan db:seed --class=SchoolsTableSeeder
        DB::table('schools')->insert([
          /*   ['code' => 'UM-MATINA', 'school_name' => 'UNIVERSITY OF MINDANAO - MATINA'],
            ['code' => 'UMTC', 'school_name' => 'UNIVERSITY OF MINDANAO - TAGUM CAMPUS'],
            ['code' => 'USEP-MINTAL', 'school_name' => 'UNIVERSITY OF SOUTHEASTERN PHILIPPINES - MINTAL CAMPUS'],
            ['code' => 'USEP-OBRERO', 'school_name' => 'UNIVERSITY OF SOUTHEASTERN PHILIPPINES - OBRERO'],
            ['code' => 'UIC', 'school_name' => 'UNIVERSITY OF THE IMMACULATE CONCEPTION'],
            ['code' => 'ADDU', 'school_name' => 'ATENEO DE DAVAO UNIVERSITY'],
            ['code' => 'Brokenshire', 'school_name' => 'BROKENSHIRE COLLEGE'],
            ['code' => 'CVSC', 'school_name' => 'COMPOSTELA VALLEY STATE COLLEGE'],
            ['code' => 'DDNSC', 'school_name' => 'DAVAO DEL NORTE STATE COLLEGE'],
            ['code' => 'DDSSC', 'school_name' => 'DAVAO DEL SUR STATE COLLEGE'],
            ['code' => 'DOrSU', 'school_name' => 'DAVAO ORIENTAL STATE UNIVERSITY'],
            ['code' => 'CJC-Digos', 'school_name' => 'COR JESU COLLEGE - DIGOS'],
            ['code' => 'HCDC', 'school_name' => 'HOLY CROSS OF DAVAO COLLEGE'],
            ['code' => 'GGCAST', 'school_name' => 'GOVERNOR GENEROSO COLLEGE OF ARTS, SCIENCES AND TECHNOLOGY'],
            ['code' => 'KCAST', 'school_name' => 'KAPALONG COLLEGE OF AGRICULTURE, SCIENCES AND TECHNOLOGY'],
            ['code' => 'DDOSC ', 'school_name' => 'DAVAO DE ORO STATE COLLEGE'],
            ['code' => 'UP Mindanao', 'school_name' => 'UNIVERSITY OF THE PHILIPPINES MINDANAO'], */
            ['code' => 'SPC', 'school_name' => 'SAN PEDRO COLLEGE'],
        ]);
    }
}
