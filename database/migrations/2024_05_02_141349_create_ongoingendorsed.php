<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::dropIfExists('ongoing_endorsed');

        DB::statement("
        CREATE VIEW ongoing_endorsed AS
        SELECT on1.NUMBER, on1.name, co1.semester , on1.startyear
        FROM cogs co1
        RIGHT JOIN ongoing on1
        ON on1.NUMBER = co1.scholar_id AND on1.startyear = co1.startyear AND on1.semester = co1.startyear
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ongoing_endorsed');
    }
};
