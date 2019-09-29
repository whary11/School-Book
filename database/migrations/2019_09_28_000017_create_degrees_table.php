<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDegreesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'degrees';
    /**
     * Run the migrations.
     * @table degrees
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->comment('Grado: SEXTO, SEPTIMO, OCTAVO');
            $table->unsignedInteger('level_id');
            $table->date('school_year');

            $table->index(["level_id"], 'level_id_idx');

            $table->unique(["id"], 'id_UNIQUE');
            $table->timestamps();


            $table->foreign('level_id', 'level_id_idx')
                ->references('id')->on('levels')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
