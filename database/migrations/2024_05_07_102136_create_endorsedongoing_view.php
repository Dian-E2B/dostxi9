<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW scholar_requirement_view AS
        SELECT sa.scholar_id, sa.scholarshipagreement_name, p.prospectus_name, so.scholaroath_name , inf.infosheet_name, cor1.cor_name, ac.accnumber_name
        FROM scholarshipagreement sa
        JOIN prospectus p ON sa.scholar_id = p.scholar_id
        JOIN scholaroath so ON sa.scholar_id = so.scholar_id
        JOIN informationsheet inf ON sa.scholar_id = inf.scholar_id
        JOIN accnumber ac ON sa.scholar_id = ac.scholar_id
        JOIN cor_firstreq cor1 ON sa.scholar_id = cor1.scholar_id;
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholar_requirement_view');
    }
};
