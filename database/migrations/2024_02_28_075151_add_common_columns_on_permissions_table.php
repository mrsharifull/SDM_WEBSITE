<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Traits\CommonColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use SoftDeletes, CommonColumnsTrait;
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
            $this->addCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
            $this->dropCommonColumns($table);
        });
    }
};
