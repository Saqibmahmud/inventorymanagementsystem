<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchases',function(Blueprint $table){
$table->foreignId('updated_by')->after('created_by');
$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade') ;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases',function(Blueprint $table){
$table->dropForeign(['updated_by']);
$table->dropColumn('updated_by');


        });
    }
};
