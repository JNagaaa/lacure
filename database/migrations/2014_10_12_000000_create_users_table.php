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
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->boolean('newsletter');
            $table->integer('hrsremaining');
            $table->boolean('admin');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        
        $data = [
            ['name'=>'Super',
            'lastname' =>'Admin',
            'email'=>'j.naga@outlook.com',
            'newsletter'=>'0',
            'hrsremaining'=>'0',
            'admin'=>'1',
            'password'=>'$2y$10$10PDL3GfyiLTGxKqr0x.P.yb.NR0STEt9QVbfyfh4cluIiBjhrV8i',
            'email_verified_at'=>'2023-09-02 00:04:41'],
        ];
        DB::table('users')->insert($data);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
