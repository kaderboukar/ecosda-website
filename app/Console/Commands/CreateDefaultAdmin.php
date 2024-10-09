<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateDefaultAdmin extends Command
{
    /**
     * Le nom et la signature de la commande console.
     *
     * @var string
     */
    protected $signature = 'make:default-admin';

    /**
     * La description de la commande console.
     *
     * @var string
     */
    protected $description = 'Crée un administrateur par défaut avec les informations de base';

    /**
     * Exécute la commande console.
     *
     * @return int
     */
    public function handle()
    {
        // Vérifie si le rôle admin existe, sinon le crée
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Crée l'utilisateur administrateur par défaut
        $admin = User::firstOrCreate(
            ['email' => 'adminBK7@example.com'], // Change l'email par celui que tu souhaites
            [
                'name' => 'AdminBK7',
                'password' => bcrypt('password@BK7'), // Change le mot de passe par celui que tu souhaites
            ]
        );

        // Assigne le rôle admin à l'utilisateur
        $admin->assignRole($adminRole);

        $this->info('Administrateur par défaut créé avec succès.');
        $this->info('Email : adminBK7@example.com');
        $this->info('Mot de passe : password@BK7'); // Change cette ligne si tu as changé le mot de passe

        return Command::SUCCESS;
    }
}
