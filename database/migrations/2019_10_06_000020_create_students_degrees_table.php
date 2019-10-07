<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateStudentsDegreesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'students_degrees';
    /**
     * Run the migrations.
     * @table students_degrees
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('degree_id');
            $table->date('school_year');

            $table->index(["student_id"], 'student_id_idx');

            $table->index(["degree_id"], 'degree_id_idx');

            $table->unique(["id"], 'id_UNIQUE');
            $table->timestamps();


            $table->foreign('student_id', 'student_id_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('degree_id', 'degree_id_idx')
                ->references('id')->on('degrees')
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
