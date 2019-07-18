<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRejectToSuggestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('suggestions', function (Blueprint $table) {
           $table->tinyInteger('reject');
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('suggestions', function (Blueprint $table) {
           $table->dropColumn('reject');
       });
     }
}
