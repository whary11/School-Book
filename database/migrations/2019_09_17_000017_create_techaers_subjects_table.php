<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTechaersSubjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'techaers_subjects';
    /**
     * Run the migrations.
     * @table techaers_subjects
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('techaers_subject_teacher_id')->nullable();
            $table->unsignedInteger('subject_id');

            $table->index(["techaers_subject_teacher_id"], 'techaers_subject_teacher_id_idx');

            $table->index(["subject_id"], 'subject_id_idx');
            $table->timestamps();


            $table->foreign('techaers_subject_teacher_id', 'techaers_subject_teacher_id_idx')
                ->references('id')->on('teachers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('subject_id', 'subject_id_idx')
                ->references('id')->on('subjects')
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
