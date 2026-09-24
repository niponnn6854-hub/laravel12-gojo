<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->decimal('weight', 5, 2);      // น้ำหนัก เช่น 65.50 กก.
            $table->date('recorded_at');          // วันที่ชั่งน้ำหนัก
            $table->text('note')->nullable();     // บันทึกเพิ่มเติม (ไม่บังคับ)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weights');
    }
};