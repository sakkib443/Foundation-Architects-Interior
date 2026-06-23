<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ContentSeeder::class,
            CoreSettingsSeeder::class,
            AdminUserSeeder::class,
        ]);

        // Area-specific settings seeders (created by the per-area build).
        // Guarded so the app seeds cleanly before they exist, and picks them
        // up automatically once they're added.
        foreach (['HomepageSeeder', 'SiteContentSeeder', 'TeamSeeder'] as $seeder) {
            $class = "Database\\Seeders\\{$seeder}";
            if (class_exists($class)) {
                $this->call($class);
            }
        }
    }
}
