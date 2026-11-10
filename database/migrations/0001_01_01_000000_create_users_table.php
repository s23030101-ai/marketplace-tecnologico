<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            
        Schema::table('users', function (Blueprint $table) {
    $table->string('control_number')->unique()->after('email');
    $table->boolean('is_verified_student')->default(false)->after('control_number');
    $table->string('verification_qr_code')->nullable()->after('is_verified_student');
    $table->string('profile_photo')->nullable()->after('verification_qr_code');
});

            // Campos personalizados que estabas intentando añadir
            $table->string('control_number')->unique()->nullable();
            
            $table->string('password');

            $table->enum('role', ['admin','buyer','seller'])->default('buyer');

            // Datos de estudiante y verificación
            $table->string('student_credential_path')->nullable(); // Foto o PDF de la credencial
            $table->boolean('is_verified_student')->default(false);
            $table->string('verification_qr_code')->nullable();
            $table->string('profile_photo')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_active')->default(true); // Para dar de baja
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
