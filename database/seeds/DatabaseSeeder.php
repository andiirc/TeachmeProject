<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateTables(array(
            'users',
            'password_resets',
            'tickets',
            'ticket_categories',
            'ticket_votes',
            'ticket_comments',

        ));

        $this->call('UserTableSeeder');
        $this->call('TicketCategoryTableSeeder');
        $this->call('TicketTableSeeder');
        $this->call('TicketCommentTableSeeder');
        $this->call('TicketVoteTableSeeder');
    }

    public function truncateTables(array $tables)
    {
        $this->checkForeignKeys(false);

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->checkForeignKeys(true);
    }

    public function checkForeignKeys($boolean)
    {
        $check = $boolean ? '1' : '0';

        DB::statement("SET FOREIGN_KEY_CHECKS=$check;");
    }
}
