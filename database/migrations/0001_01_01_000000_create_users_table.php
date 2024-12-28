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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên khách hàng');
            $table->string('avatar')->comment('Ảnh đại diện')->nullable();
            $table->string('email')->comment('Địa chỉ email');

            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->string('slug')->unique()->comment('Slug');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('Mật khẩu');
            $table->enum('code_language', ['vi', 'en'])->default('vi')->comment("Ngôn ngữ sử dụng (vi hoặc en)");
            $table->string('phone_number')->nullable()->comment('Số điện thoại');
            $table->enum('status', ['active', 'inactive', 'lock'])->default('active')->comment('Trạng thái tài khoản');
            $table->rememberToken();
            $table->timestamps();


            $table->string('social_id')->unique()->nullable();
            $table->string('social_module')->nullable();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
