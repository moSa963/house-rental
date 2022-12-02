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
        Schema::create('houses', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("user_id");
            $table->foreign("user_id")->on("users")->references("id");

            $table->string("name");
            $table->string("about");

            $table->string("country");
            $table->string("city");
            $table->string("address");
            $table->integer("lat");
            $table->integer("lng");
            $table->string("zip", 5)->min(5);

            $table->decimal("night_cost");

            $table->boolean("active");
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
        Schema::dropIfExists('houses');
    }
};
