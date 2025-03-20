<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_create_categories_table.php
  public function up()
  {
      Schema::table('subcategories', function (Blueprint $table) {
          $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Add category_id column
          $table->string('name'); // Add name column
      });
  }
  
  public function down()
  {
      Schema::table('subcategories', function (Blueprint $table) {
          $table->dropColumn('category_id'); // Drop category_id column
          $table->dropColumn('name'); // Drop name column
      });
  }
  
};
