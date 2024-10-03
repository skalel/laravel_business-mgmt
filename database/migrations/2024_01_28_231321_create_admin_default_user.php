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
      // admin@123
      DB::insert('insert into users (id, name, email, email_verified_at, approved_at, password, role) values (?, ?, ?, ?, ?, ?, ?)', ['f3a81304-dcc7-42c4-81ac-0b6429d82108', 'admin', 'admin@admin.com', now(), now(), '$2y$12$XmnLPim/qPBn8Uwctzcx.eIQYS3Yymvji/e3OhBD0ChlWknN2TX2K', 'ADMIN']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      DB::delete('delete users where id = ?', [1]);
    }
};
