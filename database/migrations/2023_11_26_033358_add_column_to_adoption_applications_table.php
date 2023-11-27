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
        Schema::table('adoption_applications', function (Blueprint $table) {
            $table->string('front_side_ID_card');
            $table->string('back_side_ID_card');
            $table->string('link_social');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adoption_applications', function (Blueprint $table) {
            $table->dropColumn('front_side_ID_card');
            $table->dropColumn('back_side_ID_card');
            $table->dropColumn('link_social');
        });
    }
};
