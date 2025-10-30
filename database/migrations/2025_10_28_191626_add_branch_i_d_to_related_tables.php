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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
        });
         Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
        });
          Schema::table('users', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
        });
          Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
        });
          Schema::table('stock_transactions', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
         Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
          Schema::table('users', function (Blueprint $table) {
           $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
          Schema::table('sales', function (Blueprint $table) {
           $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
          Schema::table('stock_transactions', function (Blueprint $table) {
           $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
    }
};
