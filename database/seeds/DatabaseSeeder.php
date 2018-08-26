<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'users',
    ];
    protected $seeders = [
        'UsersTableSeeder'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        foreach ($this->seeders as $seedclass) {
            $this->call($seedclass);
        }
    }

    /**
     * Clean database for next seed generation.
     *
     * @return void
     */
    public function cleanDatabase()
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}
