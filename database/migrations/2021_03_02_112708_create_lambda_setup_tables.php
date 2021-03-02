<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLambdaSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing Password resets
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->integer('wrong');
            $table->timestamp('created_at')->nullable();
        });

        // Create table for storing Roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100)->unique();
            $table->string('display_name', 100);
            $table->string('description', 255)->nullable($value = true);
            $table->text('permissions')->nullable($value = true);
            $table->text('extra')->nullable($value = true);
            $table->string('menu')->nullable($value = true);
            $table->timestamp('created_at')->useCurrent()->nullable($value = true);
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable($value = true);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });

        // Create table for storing Users
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id', 1);
            $table->string('login', 255)->unique();
            $table->string('password', 255);
            $table->bigInteger('role');
            $table->string('first_name', 80)->nullable($value = true);
            $table->string('last_name', 80)->nullable($value = true);
            $table->string('email', 255)->unique();
            $table->string('register_number', 80)->unique();
            $table->text('avatar')->nullable($value = true);
            $table->text('bio')->nullable($value = true);
            $table->date('birthday')->nullable($value = true);
            $table->string('phone', 80)->nullable($value = true);
            $table->string('gender', 255)->nullable($value = true);
            $table->string('fcm_token', 255)->nullable($value = true);
            $table->string('status', 255);
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });

        // Create table for storing Krud
        Schema::create('krud', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable($value = true);
            $table->integer('form')->nullable($value = true);
            $table->integer('grid')->nullable($value = true);
            $table->string('template')->nullable($value = true);
            $table->string('actions')->nullable($value = true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });

        // Create table for storing Krud Templates
        Schema::create('krud_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_name')->nullable($value = true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });

        // Create table for storing vb_schemas
        Schema::create('vb_schemas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable($value = true);
            $table->text('schema')->nullable($value = true);
            $table->string('type')->nullable($value = true);
            $table->timestamps();
        });

        // Create table for storing vb_schemas_admin
        Schema::create('vb_schemas_admin', function (Blueprint $table) {
            $table->unsignedInteger('vb_id', 1);
            $table->string('name')->nullable($value = true);
            $table->longText('schema')->nullable($value = true);
            $table->string('type')->nullable($value = true);
            $table->string('id')->nullable($value = true);
            $table->dateTime('created_at', $precision = 0)->nullable($value = true);
            $table->dateTime('updated_at', $precision = 0)->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('krud');
        Schema::dropIfExists('krud_templates');
        Schema::dropIfExists('vb_schemas');
        Schema::dropIfExists('vb_schemas_admin');
    }
}
