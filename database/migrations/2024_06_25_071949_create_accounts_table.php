<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('account_id', 50)->primary();
            $table->string('username', 50);
            $table->string('password_id', 50);
            $table->boolean('is_active')->default(true);
            
            // Add any additional columns if needed

            $table->timestamps(); // Optional, adds created_at and updated_at columns
        });
        // PostgreSQL-specific: Create triggers to enforce table inheritance
        DB::statement('CREATE OR REPLACE FUNCTION account_insert_trigger() RETURNS TRIGGER AS $$
            BEGIN
                IF NEW instanceof Employee THEN
                    INSERT INTO employees VALUES (NEW.*);
                ELSIF NEW instanceof Member THEN
                    INSERT INTO members VALUES (NEW.*);
                ELSE
                    RAISE EXCEPTION \'Unknown account type: %\', TG_TABLE_NAME;
                END IF;
                RETURN NULL;
            END;
        $$ LANGUAGE plpgsql;');

        DB::unprepared('CREATE TRIGGER account_insert BEFORE INSERT ON accounts FOR EACH ROW EXECUTE FUNCTION account_insert_trigger();');
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
