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
        Schema::create('house_rules', function (Blueprint $table) {
            $table->id();
            $table->uuid("house_id");
            $table->foreign("house_id")->references("id")->on("houses")->cascadeOnDelete();
            $table->string("rule");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_rules');
    }
};
