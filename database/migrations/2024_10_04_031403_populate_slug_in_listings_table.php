<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            // Update the slug column based on the title column
            DB::table('listings')->get()->each(function ($listing) {
                DB::table('listings')
                    ->where('id', $listing->id)
                    ->update(['slug' => Str::slug($listing->title)]);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            DB::table('listings')->update(['slug' => null]);

        });
    }
};
