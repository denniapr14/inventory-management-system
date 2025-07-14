<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable'); // Creates tokenable_id (bigint) and tokenable_type (varchar)
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps(); // Creates created_at and updated_at columns

            $table->index(['tokenable_id', 'tokenable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
