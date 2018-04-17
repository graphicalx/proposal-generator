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

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned()->index();
            $table->text('text');
            $table->smallInteger('priority')->default(100);
            $table->boolean('is_active')->default(true);

            $table->softDeletes();
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

        \App\Section::where('name', 'Greeting')->first()->pieces()->createMany([
            ['text' => 'Hi,', 'priority' => '300'],
            ['text' => 'Hello,', 'priority' => '200'],
        ]);

        \App\Section::where('name', 'Contact/Closing')->first()->pieces()->createMany([
            ['text' => 'Let\'s discuss this over a call', 'priority' => '100'],
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
