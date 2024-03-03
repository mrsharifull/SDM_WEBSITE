<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Traits\CommonColumnsTrait;

return new class extends Migration
{
    use CommonColumnsTrait;
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $this->dropCommonColumns($table);
        });
    }
};
