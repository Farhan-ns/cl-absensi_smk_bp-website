<?php

use App\Constants\ApprovalStatus;
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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('absence_document');
            $table->string('absence_note')->nullable();
            $table->string('absence_reason')->nullable();
            $table->integer('approval_status')->default(ApprovalStatus::$PENDING);
            $table->integer('leave_type');
            $table->date('from_date');
            $table->date('to_date');
            $table->foreignId('teacher_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
