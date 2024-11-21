<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role1 = Role::create(['name' => 'Admin']);
        // $role2 = Role::create(['name' => 'Docente']);
        //$role3 = Role::create(['name' => 'Padre']);
        $role4 = Role::create(['name' => 'Secretario(a)']);
        $role5 = Role::create(['name' => 'Director(a)']);

        // Permission::create(['name' => 'Home.index'])->syncRoles([$role1]);

        // Permission::create(['name' => 'Admin.users.index'])->syncRoles($role1);
        // Permission::create(['name' => 'Admin.users.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Admin.users.edit'])->syncRoles($role1);
        // Permission::create(['name' => 'Admin.users.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'Alumno.index'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'Alumno.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Alumno.edit'])->syncRoles($role1);
        // Permission::create(['name' => 'Alumno.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'Seccion.index'])->syncRoles($role1);
        // Permission::create(['name' => 'Seccion.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Seccion.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'Curso.index'])->syncRoles($role1);
        // Permission::create(['name' => 'Curso.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Curso.edit'])->syncRoles($role1);
        // Permission::create(['name' => 'Curso.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'CursoPorGrado.index'])->syncRoles($role1);

        // Permission::create(['name' => 'Capacidad.index'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'Capacidad.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Capacidad.edit'])->syncRoles($role1);
        // Permission::create(['name' => 'Capacidad.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'Personal.index'])->syncRoles($role1);
        // Permission::create(['name' => 'Personal.create'])->syncRoles($role1);
        // Permission::create(['name' => 'Personal.edit'])->syncRoles($role1);
        // Permission::create(['name' => 'Personal.destroy'])->syncRoles($role1);

        // Permission::create(['name' => 'CursoHasAlumno.index'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'CursoHasAlumno.edit'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'CursoHasAlumno.pdf'])->syncRoles([$role1, $role2]);

        //Permission::create(['name' => 'CursoHasAlumno.index'])->syncRoles([$role3]);
        //Permission::create(['name' => 'CursoHasAlumno.pdf'])->syncRoles([$role3]);
    }
}
