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
        SELECT sa.scholar_id,
        sa.scholarshipagreement_name,
        sa.status as sa_status,
        sa.remarks as sa_remarks,
        p.prospectus_name,
        p.status as p_status,
        p.remarks as p_remarks,
        so.scholaroath_name ,
        so.status as so_status,
        so.remarks as so_remarks,
        inf.infosheet_name,
        inf.status as inf_status,
        inf.remarks as inf_remarks,
        cor1.cor_name,
        cor1.status as cor_status,
        cor1.remarks as cor1_remarks,
        ac.accnumber_name,
        ac.status as ac_status,
        ac.remarks as ac_remarks
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
