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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();

            $table->enum('auditType', ['created','updated']);

            $table->morphs('auditable');

            $table->longText('before');
            $table->longText('after');

            $table->timestamps();

            $table->index('auditType');
            $table->index('auditable_id');
            $table->index('auditable_type');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_audits');
    }
};
