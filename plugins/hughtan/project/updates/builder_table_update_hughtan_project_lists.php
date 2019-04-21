<?php namespace Hughtan\project\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateHughtanProjectLists extends Migration
{
    public function up()
    {
        Schema::rename('hughtan_project_list', 'hughtan_project_lists');
        Schema::table('hughtan_project_lists', function($table)
        {
            $table->increments('id')->nullable(false)->unsigned(false)->default(null)->change();
            $table->string('title')->change();
            $table->string('icon')->change();
            $table->string('file')->change();
            $table->string('summy')->change();
            $table->string('content')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('hughtan_project_lists', 'hughtan_project_list');
        Schema::table('hughtan_project_list', function($table)
        {
            $table->increments('id')->nullable(false)->unsigned()->default(null)->change();
            $table->string('file', 191)->change();
            $table->string('title', 191)->change();
            $table->string('summy', 191)->change();
            $table->string('content', 191)->change();
            $table->string('icon', 191)->change();
        });
    }
}
