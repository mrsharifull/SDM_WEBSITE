<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\CommonColumnsTrait;

return new class extends Migration
{
    use SoftDeletes, CommonColumnsTrait;
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_number')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $this->addCommonColumns($table);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
