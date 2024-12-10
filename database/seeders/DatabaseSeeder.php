<?php

namespace Database\Seeders;

use App\Models\Curso;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(PeriodosTableSeeder::class);
        
        $this->call(AlumnosTableSeeder::class);
        
        $this->call(NivelsTableSeeder::class);
        $this->call(GradosTableSeeder::class);
        $this->call(SeccionsTableSeeder::class);
        
        $this->call(MigrationsTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);

        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(SessionsTableSeeder::class);

        $this->call(PadresTableSeeder::class);
        $this->call(CacheTableSeeder::class);
        $this->call(CacheLocksTableSeeder::class);

        $this->call(CursosTableSeeder::class);
        $this->call(CompetenciasTableSeeder::class);

        $this->call(TipoPersonalsTableSeeder::class);
        $this->call(PersonalsTableSeeder::class);
    }
}
