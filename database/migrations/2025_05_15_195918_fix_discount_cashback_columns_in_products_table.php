<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the wrongly named column if it exists
            if (Schema::hasColumn('products', 'dicount')) {
                $table->dropColumn('dicount');
            }

            // Add correct 'discount' and make both nullable
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('cashback', 10, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->decimal('cashback', 10, 2)->nullable(false)->change();
            $table->decimal('dicount', 10, 2); // restore original column if needed
        });
    }
};
