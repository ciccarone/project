<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ensure all existing rows have a valid business_id
        Schema::table('referrals', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable()->after('ref');
        });

        // Update existing rows to have a valid business_id (set to 1 as an example)
        DB::table('referrals')->update(['business_id' => 1]);

        // Make the business_id column non-nullable and add the foreign key constraint
        Schema::table('referrals', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable(false)->change();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropColumn('business_id');
        });
    }
};
