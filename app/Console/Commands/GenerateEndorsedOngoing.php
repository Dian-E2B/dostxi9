<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GenerateEndorsedOngoing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-endorsed-ongoing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RANDOM VALUES TO ENDORSE ONGOIN';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $faker = Faker::create();

        $numberOfRecords = 1000;

        $this->info("Generating and inserting $numberOfRecords fake records...");
        $batchSize = 32; // Adjust the batch size based on your needs
        $this->output->progressStart(ceil($numberOfRecords / $batchSize));
        $semester = [1, 2, 3];
        $year = 2024;
        $School = [
            'ADDU', 'Brokenshire', 'DDC', 'SPC', 'UIC', 'UM-Matina', 'UP Mindanao', 'USEP-Mintal', 'USEP-Obrero', 'CJC-Digos', 'DSSC', 'UM-Digos', 'DNSC', 'KCAST', 'UM-Tagum', 'USEP-Tagum', 'DDOSC', 'CVSC MARAGUSAN', 'MonCAST', 'DORSU', 'GGCAST', 'SPAMAST-Malita'
        ];
        $Courses = ['BAT', 'BS ABE', 'BS AgEc', 'BS AGRI', 'BS Agriculture', 'BS AM', 'BS AMATH', 'BS Applied Math', 'BS ARCHITECTURE', 'BS Biology', 'BS CE', 'BS ChE', 'BS Chem', 'BS Chemistry', 'BS CoE', 'BS CS', 'BS EcE', 'BS EE', 'BS EM', 'BS Envi Sci', 'BS FT', 'BS GE', 'BS Geology', 'BS IS'];


        $startId = 260; //change when needed
        for ($i = 0; $i < ceil($numberOfRecords / $batchSize); $i++) {
            for ($j = 0; $j < $batchSize; $j++) {
                $school1 = $faker->randomElement($School);
                $course1 = $faker->randomElement($Courses);
                $semester1 = $faker->randomElement($semester);
                $fname = $faker->name;
                $lname = $faker->lastName;
                $mname = $faker->firstNameFemale;
                $FULLNAME = $lname . ', ' .  $fname . ' ' . $mname;
                $SCHOOL2 = $school1;
                $COURSE2 = $course1;
                $YEAR1 = $year;
                $data[] = [
                    'id' => $startId,
                    'scholar_id' => $startId,
                    'name' => $FULLNAME,
                    'school' => $SCHOOL2,
                    'course' => $COURSE2,
                    'semester' => $semester1,
                    'year' => $YEAR1,
                ];

                $startId++;
            }
            DB::table('ongoinglist_endorseds')->insert($data);
            $this->output->progressFinish();
            $this->info('Fake data generated and inserted successfully. ends at ' . $startId);
            $data = [];
        }
    }
}
