<?php namespace Hughtan\Blog\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('hughtan_blog_posts');
        DbDongle::convertTimestamps('hughtan_blog_categories');
    }

    public function down()
    {
        // ...
    }
}
