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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('registration_type')->default('trial')->after('id'); // 'trial' or 'player'
            
            // Player Information
            $table->string('first_name')->nullable()->after('name');
            $table->string('surname')->nullable()->after('first_name');
            $table->string('middle_name')->nullable()->after('surname');
            $table->date('date_of_birth')->nullable()->after('age');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('gender');
            $table->string('lga')->nullable()->after('address');
            $table->string('state_of_origin')->nullable()->after('lga');
            $table->string('passport_number')->nullable()->after('email');
            $table->date('passport_issuing_date')->nullable()->after('passport_number');
            $table->date('passport_expiry_date')->nullable()->after('passport_issuing_date');
            $table->string('passport_photo')->nullable()->after('passport_expiry_date');
            $table->text('player_signature')->nullable()->after('passport_photo'); // Base64 or path

            // Parent/Guardian Information
            $table->string('guardian_name')->nullable()->after('player_signature');
            $table->string('guardian_contact')->nullable()->after('guardian_name');
            $table->text('guardian_address')->nullable()->after('guardian_contact');
            $table->text('guardian_signature')->nullable()->after('guardian_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'registration_type',
                'first_name',
                'surname',
                'middle_name',
                'date_of_birth',
                'gender',
                'address',
                'lga',
                'state_of_origin',
                'passport_number',
                'passport_issuing_date',
                'passport_expiry_date',
                'passport_photo',
                'player_signature',
                'guardian_name',
                'guardian_contact',
                'guardian_address',
                'guardian_signature'
            ]);
        });
    }
};
