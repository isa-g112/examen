<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar que existan usuarios
        if (User::count() < 7) {
            $this->command->warn('⚠️  No hay suficientes usuarios. Creando usuarios primero...');
            User::factory()->count(7)->create();
        }

        // Obtener los primeros 7 usuarios
        $users = User::take(7)->get();

        // Crear una compañía para cada usuario
        foreach ($users as $user) {
            Company::factory()->create([
                'users_iduser' => $user->iduser
            ]);
        }

        $this->command->info('✅ 7 compañías creadas exitosamente');
    }
}
