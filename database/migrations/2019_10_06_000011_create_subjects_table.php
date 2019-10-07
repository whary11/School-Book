<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSubjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'subjects';
    /**
     * Run the migrations.
     * @table subjects
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('Asignaturas.');
            $table->string('name', 45);
            $table->string('description', 45)->nullable();

            $table->unique(["id"], 'id_UNIQUE');
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
       Schema::dropIfExists($this->tableName);
     }
}
