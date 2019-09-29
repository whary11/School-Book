<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateIntitutionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'intitutions';
    /**
     * Run the migrations.
     * @table intitutions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {           
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->string('email', 45);
            $table->string('description')->nullable();
            $table->string('address', 45)->nullable();
            $table->unsignedInteger('customization_id')->nullable();

            $table->index(["customization_id"], 'customization_id_idx');
            $table->timestamps();


            $table->foreign('customization_id', 'customization_id_idx')
                ->references('id')->on('customizations')
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
