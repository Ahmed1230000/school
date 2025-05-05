<?php

use App\Enum\UserType;
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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', array_column(UserType::cases(), 'value'))->default(UserType::STUDENT->value)->after('password');
            $table->string('phone')->nullable()->after('user_type');
            $table->string('address')->nullable()->after('phone');
            $table->string('title')->nullable()->after('address');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('user_type');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('title');
        });
    }
};
