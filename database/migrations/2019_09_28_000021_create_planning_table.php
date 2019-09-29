<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePlanningTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'planning';
    /**
     * Run the migrations.
     * @table planning
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('topic', 45);
            $table->unsignedInteger('planning_teacher_id');
            $table->unsignedInteger('degree_planning_id');
            $table->unsignedInteger('planning_statu_id');

            $table->index(["degree_planning_id"], 'degree_planning_id_idx');

            $table->index(["planning_teacher_id"], 'planning_teacher_id_idx');

            $table->index(["planning_statu_id"], 'planning_statu_id_idx');

            $table->unique(["id"], 'id_UNIQUE');
            $table->timestamps();


            $table->foreign('planning_teacher_id', 'planning_teacher_id_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('degree_planning_id', 'degree_planning_id_idx')
                ->references('id')->on('degrees')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('planning_statu_id', 'planning_statu_id_idx')
                ->references('id')->on('status')
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
