<?php

use App\Models\Audit;
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
        Schema::table('audits', function (Blueprint $table) {
            $table->enum('auditType', [
                Audit::AUDIT_TYPE_CREATE,
                Audit::AUDIT_TYPE_UPDATE,
                Audit::AUDIT_TYPE_DELETE,
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to do
    }
};
