<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageVisibilityToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->tinyInteger('is_messenger')->default(1);

            $table->tinyInteger('is_disqus')->default(1);

            $table->tinyInteger('is_google_analytics')->default(1);

            $table->tinyInteger('is_add_this_status')->default(1);

            $table->tinyInteger('is_facebook_pexel')->default(1);

            $table->tinyInteger('is_tawk_to')->default(1);

            $table->string('is_recaptcha')->nullable();

            $table->tinyInteger('is_cooki_alert')->default(1);

            $table->tinyInteger('is_hero_section')->default(1);
            $table->tinyInteger('is_trending_section')->default(1);
            $table->tinyInteger('is_product_section')->default(1);
            $table->tinyInteger('is_client_section')->default(1);
            $table->tinyInteger('is_blog_section')->default(1);
            $table->tinyInteger('is_newsletter_section')->default(1);

            $table->tinyInteger('is_shop_page')->default(1);
            $table->tinyInteger('is_blog_page')->default(1);
            $table->tinyInteger('is_contact_page')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(
                'is_messenger',
                'is_disqus',
                'is_google_analytics',
                'is_add_this_status',
                'is_facebook_pexel',
                'is_tawk_to',
                'is_recaptcha',
                'is_cooki_alert',

                'is_hero_section',
                'is_trending_section',
                'is_product_section',
                'is_client_section',
                'is_blog_section',
                'is_newsletter_section',

                'is_shop_page',
                'is_blog_page',
                'is_contact_page',

            );
        });
    }
}
