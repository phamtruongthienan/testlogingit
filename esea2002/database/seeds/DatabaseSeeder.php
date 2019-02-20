<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ConfigLanguageTableSeeder::class);
        $this->call(ConfigMainTableSeeder::class);
        $this->call(ConfigCityTableSeeder::class);
        $this->call(LayoutTableSeeder::class);
        $this->call(SchoolLevelTableSeeder::class);
        $this->call(SchoolTypeTableSeeder::class);
        $this->call(SchoolLanguageTableSeeder::class);
        $this->call(SchoolClassTableSeeder::class);
        $this->call(SchoolAttributeTableSeeder::class);
        $this->call(SchoolTableSeeder::class);
        $this->call(OptionSchoolTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(SlugTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
