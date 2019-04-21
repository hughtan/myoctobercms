<?php namespace Hughtan\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Hughtan\Blog\Models\Category as CategoryModel;

class PostsAddMetadata extends Migration
{

    public function up()
    {
        if (Schema::hasColumn('hughtan_blog_posts', 'metadata')) {
            return;
        }

        Schema::table('hughtan_blog_posts', function($table)
        {
            $table->mediumText('metadata')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('hughtan_blog_posts', 'metadata')) {
            Schema::table('hughtan_blog_posts', function ($table) {
                $table->dropColumn('metadata');
            });
        }
    }

}
