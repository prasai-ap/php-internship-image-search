<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('prod_name');
            $table->string('prod_image');
            $table->string('parent_category_name');
            $table->string('sub_category_name');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
