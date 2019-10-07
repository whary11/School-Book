<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateInterdisciplinaryRolesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'interdisciplinary_roles';
    /**
     * Run the migrations.
     * @table interdisciplinary_roles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->comment('Nutricionista, Psicologa, Trabajador Social ');
            $table->string('description', 100)->nullable();

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
