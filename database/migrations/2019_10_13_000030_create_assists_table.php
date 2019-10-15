<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAssistsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'assists';
    /**
     * Run the migrations.
     * @table assists
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('degrees_subjects_teacher_id')->comment('Asistencias diarias');

            $table->index(["degrees_subjects_teacher_id"], 'degrees_subjects_teacher_id_idx');
            $table->timestamps();


            $table->foreign('degrees_subjects_teacher_id', 'degrees_subjects_teacher_id_idx')
                ->references('id')->on('degrees_subjects_teachers')
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
