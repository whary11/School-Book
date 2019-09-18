<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDegreesSubjectsTeachersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'degrees_subjects_teachers';
    /**
     * Run the migrations.
     * @table degrees_subjects_teachers
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('techaer_subject_id')->nullable();
            $table->unsignedInteger('student_degree_id');

            $table->index(["student_degree_id"], 'student_degree_id_idx');

            $table->index(["techaer_subject_id"], 'techaer_subject_id_idx');

            $table->unique(["id"], 'id_UNIQUE');
            $table->timestamps();


            $table->foreign('techaer_subject_id', 'techaer_subject_id_idx')
                ->references('techaers_subject_teacher_id')->on('techaers_subjects')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('student_degree_id', 'student_degree_id_idx')
                ->references('id')->on('students_degrees')
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
