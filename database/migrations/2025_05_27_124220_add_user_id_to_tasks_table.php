<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the column without the foreign key constraint
        // Adding user_id to the tasks table
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->nullable();
        });
        

        // Get the first user or create one if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Default User',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Update existing tasks to use the default user
        DB::table('tasks')->update(['user_id' => $user->id]);

        // Now add the foreign key constraint and make the column required
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
