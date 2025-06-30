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
        Schema::create('wedding_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo'); // path foto orang yang memberikan testimoni
            $table->string('occupation'); // pekerjaan pemberi testimoni
            $table->text('message'); // isi testimoni
            $table->foreignId('wedding_package_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_testimonials');
    }
};
