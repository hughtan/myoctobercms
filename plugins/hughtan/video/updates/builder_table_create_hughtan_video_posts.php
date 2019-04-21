<?php namespace Hughtan\Video\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateHughtanVideoPosts extends Migration
{
    public function up()
    {
        Schema::create('hughtan_video_posts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->text('summy');
            $table->text('content');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('hughtan_video_posts');
    }
}
