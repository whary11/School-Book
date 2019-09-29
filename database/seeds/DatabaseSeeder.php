<?php

use App\Arl;
use App\Neighborhood;
use App\Compensation;
use App\BloodGroup;
use App\DocumentType;
use App\Eps;
use App\Sex;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
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
        // $this->call(UsersTableSeeder::class);

        factory(DocumentType::class, 30)->create();
        factory(Arl::class, 30)->create();
        factory(BloodGroup::class, 30)->create();
        factory(Compensation::class, 30)->create();
        factory(Eps::class, 30)->create();
        factory(Neighborhood::class, 30)->create();
        factory(Sex::class, 30)->create();
        factory(Sex::class, 30)->create();

        $luis = User::create([
            'names' => 'Luis Fernando',
            'surnames' => 'Raga',
            'email' => 'whary11@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);



        $david = User::create([
            'names' => 'David',
            'surnames' => 'Raga Renteria',
            'email' => 'dragarenteria@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);

        Role::create([
            'name' => 'SUPERADMIN',
            'display_name' => 'Super admin',
            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);

        Role::create([
            'name' => 'STUDENT',
            'display_name' => 'Estudiante',
            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);

        Role::create([
            'name' => 'TEACHER',
            'display_name' => 'Docente',

            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);
        Role::create([
            'name' => 'RECTOR',
            'display_name' => 'Rector',
            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);

        Role::create([
            'name' => 'RESPONSABLE',
            'display_name' => 'Acudiente',
            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);


        Role::create([
            'name' => 'COORDINATOR',
            'display_name' => 'Coordinador',
            'description' => 'Administrador de toda la aplicación, tiene todoslos permisos.'
        ]);

        $david->assignRole('SUPERADMIN');
        $luis->assignRole('SUPERADMIN');
    }
}
