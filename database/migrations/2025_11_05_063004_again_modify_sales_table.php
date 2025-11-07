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
        Schema::table('sales', function (Blueprint $table) {
            $table->enum('paid_with',['cash','card','bkash','nagad','bank'])->default('cash')->after('status');
            $table->decimal('due_amount', 10, 2)->default(0)->after('total_amount');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade')->after('created_by');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade')->after('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
           $table->dropForeign(['branch_id']);
            $table->dropColumn(['paid_with', 'due_amount', 'updated_by', 'branch_id']);
        });
    }
};
