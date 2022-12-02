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
        Schema::create('house_reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid("user_id");
            $table->foreign("user_id")->on("users")->references("id");

            $table->uuid("house_id");
            $table->foreign("house_id")->references("id")->on("houses")->cascadeOnDelete();

            
            $table->string("comment")->default("");
            $table->integer("rating");

            $table->unique(["user_id", "house_id"]);
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
        Schema::dropIfExists('house_reviews');
    }
};
