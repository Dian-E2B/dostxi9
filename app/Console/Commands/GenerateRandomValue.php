<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GenerateRandomValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-random-value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and insert a random value';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $faker = Faker::create();

        $numberOfRecords = 1000;

        $this->info("Generating and inserting $numberOfRecords fake records...");
        $batchSize = 32; // Adjust the batch size based on your needs
        $this->output->progressStart(ceil($numberOfRecords / $batchSize));

        $strand = ['STEM', 'NON-STEM'];
        $provinces = ['DAVAO CITY', 'DAVAO DEL SUR', 'DAVAO DEL NORTE', 'DAVAO DE ORO', 'DAVAO ORIENTAL', 'DAVAO OCCIDENTAL'];

        $year = [2020, 2021, 2022, 2023];
        $semester = [1, 2, 3];
        $scholar_status_id = [1, 2, 3, 4, 5, 6];
        $provinceSchoolMapping = [
            'DAVAO CITY' => ['ADDU', 'Brokenshire', 'DDC', 'SPC', 'UIC', 'UM-Matina', 'UP Mindanao', 'USEP-Mintal', 'USEP-Obrero'],
            'DAVAO DEL SUR' => ['CJC-Digos', 'DSSC', 'UM-Digos'],
            'DAVAO DEL NORTE' => ['DNSC', 'KCAST', 'UM-Tagum', 'USEP-Tagum'],
            'DAVAO DE ORO' => ['DDOSC', 'CVSC MARAGUSAN', 'MonCAST'],
            'DAVAO ORIENTAL' => ['DORSU', 'GGCAST'],
            'DAVAO OCCIDENTAL' => ['SPAMAST-Malita'],
        ];
        $genders = DB::table('genders')->pluck('gendername', 'id')->toArray();
        $programs = DB::table('programs')->pluck('progname', 'id')->toArray();
        $Courses = ['BAT', 'BS ABE', 'BS AgEc', 'BS AGRI', 'BS Agriculture', 'BS AM', 'BS AMATH', 'BS Applied Math', 'BS ARCHITECTURE', 'BS Biology', 'BS CE', 'BS ChE', 'BS Chem', 'BS Chemistry', 'BS CoE', 'BS CS', 'BS EcE', 'BS EE', 'BS EM', 'BS Envi Sci', 'BS FT', 'BS GE', 'BS Geology', 'BS IS'];


        $startId = 2360; //change when needed
        $spasno = 20360; //change when needed
        for ($i = 0; $i < ceil($numberOfRecords / $batchSize); $i++) {


            for ($j = 0; $j < $batchSize; $j++) {
                $selectedProvince = $faker->randomElement($provinces);
                $school1 = $faker->randomElement($provinceSchoolMapping[$selectedProvince]);
                $course1 = $faker->randomElement($Courses);
                $fname = $faker->name;
                $lname = $faker->lastName;
                $mname = $faker->firstNameFemale;
                $YEAR = $faker->randomElement($year);;
                $FULLNAME = $lname . ', ' .  $fname . ' ' . $mname;
                $SCHOOL2 = $school1;
                $COURSE2 = $course1;
                $selectedGender = $faker->randomElement(array_keys($genders));
                $selectedProgram = $faker->randomElement(array_keys($programs));
                /* echo "YEAR before: " . var_export($YEAR, true) . PHP_EOL; */
                $data[] = [
                    'id' => $startId,
                    'spasno' => 'U-2022-11-' . $spasno,
                    'app_id' => $faker->lexify('????????'),
                    'strand' => $faker->randomElement($strand),
                    'program_id' => $selectedProgram,
                    'lname' => $lname,
                    'fname' => $fname,
                    'mname' => $mname,
                    'gender_id' => $selectedGender,
                    'bday' => $faker->date('y-m-d'), // Random date in "yy-mm-dd" format
                    /* 'email' => $faker->email, */
                    'province' => $selectedProvince,
                    'region' => 11,
                    'year' => $YEAR,
                    'scholar_status_id' => 5, //status
                    'school' => $SCHOOL2,
                    'course' => $COURSE2,
                ];


                $dataOtherTable[] = [
                    'BATCH' => $YEAR,
                    'NUMBER' => $startId,
                    'NAME' => $FULLNAME,
                    'MF' => $genders[$selectedGender],
                    'SCHOLARSHIPPROGRAM' => $programs[$selectedProgram],
                    'SCHOOL' => $SCHOOL2,
                    'COURSE' => $COURSE2,
                    'startyear' => $YEAR,
                    'endyear' => $YEAR + 1,
                    'semester' => $faker->randomElement($semester),
                ];
                $startId++;
                $spasno++;
            }


            DB::table('seis')->insert($data);
            DB::table('ongoing')->insert($dataOtherTable);
            $this->output->progressFinish();
            $this->info('Fake data generated and inserted successfully.');

            $data = [];
            $dataOtherTable = [];
        }
    }
}
