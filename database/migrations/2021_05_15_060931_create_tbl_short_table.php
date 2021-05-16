<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblShortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        
        Schema::create('tbl_short', function (Blueprint $table) {
            $table->id();
            $table->string('original_link');
            $table->string('short_link');
            $table->timestamps();
        });
        
        //Set Auto Increment  
        //DB::statement("ALTER TABLE tbl_short AUTO_INCREMENT = 0;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_short');
    }
}
