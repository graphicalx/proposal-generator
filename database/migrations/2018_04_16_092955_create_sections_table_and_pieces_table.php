<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTableAndPiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique();
            $table->smallInteger('order');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        Schema::create('pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned()->index();
            $table->text('text');
            $table->smallInteger('priority');
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections');
        });

        $now = \Carbon\Carbon::now();
        \App\Section::insert([
            ['name' => 'Greeting', 'order' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Introduction', 'order' => 200, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Specifics', 'order' => 300, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'My experience', 'order' => 400, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Top Rated', 'order' => 500, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Contact/Closing', 'order' => 600, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ending', 'order' => 700, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pieces');
        Schema::dropIfExists('sections');
    }
}