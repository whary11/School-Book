<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateHomeworksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'homeworks';
    /**
     * Run the migrations.
     * @table homeworks
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('Tareas.');
            $table->string('name', 45)->nullable()->comment('Tareas');
            $table->unsignedInteger('degrees_subject_teacher_id');

            $table->index(["degrees_subject_teacher_id"], 'degrees_subject_teacher_id_idx');

            $table->unique(["id"], 'id_UNIQUE');
            $table->timestamps();


            $table->foreign('degrees_subject_teacher_id', 'degrees_subject_teacher_id_idx')
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
