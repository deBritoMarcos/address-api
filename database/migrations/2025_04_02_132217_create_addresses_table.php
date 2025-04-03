<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('zip_code');
            $table->string('address', length: 200);
            $table->string('complement', length: 200)->nullable();
            $table->string('district', length: 200)->nullable();
            $table->string('city', length: 100);
            $table->string('uf', length: 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
