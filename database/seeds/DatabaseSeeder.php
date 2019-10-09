<?php

use App\Arl;
use Illuminate\Support\Facades\Artisan;
use App\SchoolHeadquarterUser;
use App\SchoolHeadquarter;
use App\Institution;
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

        factory(Institution::class, 2)->create();
        factory(SchoolHeadquarter::class, 10)->create();

        $documentsType = ['TARJETA DE IDENTIDAD', 'CÉDULA DE CIUDADANÍA', 'REGISTRO CIVIL', 'NACIDO VIVO', 'PASAPORTE', 'CÉDULA DE EXTRANJERÍA'];
        foreach ($documentsType as $key => $value) {
            DocumentType::create([
                'name' => $value,
            ]);
        }
        $arls = [
            'AXA COLPATRIA S.A.',
            'COLMENA SEGUROS',
            'COMPAÑÍA DE SEGUROS DE VIDA AURORA S.A.',
            'LA EQUIDAD SEGUROS DE VIDA', 'LIBERTY SEGUROS DE VIDA S.A.',
            'MAPFRE SEGUROS',
            'POSITIVA',
            'SEGUROS BOLÍVAR S.A.',
            'SEGUROS DE VIDA ALFA S.A.',
            'SURATEP SA',
        ];
        foreach ($arls as $key => $value) {
            Arl::create([
                'name' => $value,
            ]);
        }

        $bloodGroups = [
            '0-',
            '0+',
            'A−',
            'A+',
            'B−',
            'B+',
            'AB−',
            'AB+',
        ];

        foreach ($bloodGroups as $key => $value) {
            BloodGroup::create([
                'name' => $value,
            ]);
        }
        factory(Compensation::class, 30)->create();
        $eps = [
            'AMBUQ',
            'CAJACOPI',
            'COMFACOR',
            'COMFASUCRE',
            'COMPARTA',
            'COOSALUD',
            'EMDISALUD',
            'MUTUAL SER',
            'NUEVA EPS SUBSIDIADA',
            'SALUDVIDA',
            'CAFESALUD',
            'COOMEVA',
            'NUEVA EPS CONTRIBUTIVO',
            'SALUD TOTAL',
            'EPS SANITAS',
        ];
        foreach ($eps as $key => $value) {
            Eps::create([
                'name' => $value,
            ]);
        }
        factory(Neighborhood::class, 30)->create();

        $sexes = ['Masculino', 'Femenino'];

        foreach ($sexes as $key => $value) {
            Sex::create([
                'name' => $value,
            ]);
        }

        $luis = User::create([
            'document' => 1077444356,
            'names' => 'Luis Fernando',
            'surnames' => 'Raga',
            'email' => 'whary11@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);

        SchoolHeadquarterUser::create([
            'school_headquarter_user_id' => $luis->id,
            'school_headquarter_id' => \App\SchoolHeadquarter::all()->random()->id,
        ]);



        $david = User::create([
            'document' => 2738456,
            'names' => 'David',
            'surnames' => 'Raga Renteria',
            'email' => 'dragarenteria@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);

        SchoolHeadquarterUser::create([
            'school_headquarter_user_id' => $david->id,
            'school_headquarter_id' => \App\SchoolHeadquarter::all()->random()->id,
        ]);

        Role::create([
            'name' => 'SUPERADMIN',
            'display_name' => 'Super admin',
            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);

        Role::create([
            'name' => 'STUDENT',
            'display_name' => 'Estudiante',
            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);

        Role::create([
            'name' => 'TEACHER',
            'display_name' => 'Docente',

            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);
        Role::create([
            'name' => 'RECTOR',
            'display_name' => 'Rector',
            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);

        Role::create([
            'name' => 'RESPONSABLE',
            'display_name' => 'Acudiente',
            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);


        Role::create([
            'name' => 'COORDINATOR',
            'display_name' => 'Coordinador',
            'description' => 'Administrador de toda la aplicación, tiene todos los permisos.'
        ]);

        $david->assignRole('SUPERADMIN');
        $luis->assignRole('SUPERADMIN');

        Artisan::call('passport:install');
    }
}
