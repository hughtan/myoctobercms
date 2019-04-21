<?php namespace Hughtan\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Hughtan\Blog\Models\Category as CategoryModel;

class CategoriesAddNestedFields extends Migration
{

    public function up()
    {
        if (Schema::hasColumn('hughtan_blog_categories', 'parent_id')) {
            return;
        }

        Schema::table('hughtan_blog_categories', function($table)
        {
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
        });

        foreach (CategoryModel::all() as $category) {
            $category->setDefaultLeftAndRight();
            $category->save();
        }
    }

    public function down()
    {
    }

}