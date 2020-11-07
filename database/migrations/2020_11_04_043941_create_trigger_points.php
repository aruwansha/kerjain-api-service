<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER tr_user_id AFTER INSERT ON users FOR EACH ROW
            BEGIN
                IF(NEW.user_level = 'seller') THEN INSERT INTO sellers (user_id, name, email) VALUES (NEW.id, NEW.name, NEW.email);
                ELSEIF (NEW.user_level = 'buyer') THEN INSERT INTO buyers (user_id, name, email) VALUES (NEW.id, NEW.name, NEW.email);
                ELSEIF (NEW.user_level = 'admin') THEN INSERT INTO admins (user_id, name, email) VALUES (NEW.id, NEW.name, NEW.email);
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger_points');
    }
}
