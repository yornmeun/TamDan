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
       Schema::table('clients', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('timeline_activities', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('timeline_activities', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
