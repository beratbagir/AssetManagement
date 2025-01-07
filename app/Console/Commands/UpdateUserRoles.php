<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserRoles extends Command
{
    protected $signature = 'users:update-roles';
    protected $description = 'Update user roles based on creation order';

    public function handle()
    {
        $users = User::orderBy('created_at')->get();

        foreach ($users as $index => $user) {
            // İlk kullanıcıya super-admin rolü ver
            if ($index === 0) {
                $user->syncRoles(['super-admin']);
                $this->info("Assigned super-admin role to user: {$user->name}");
            } else {
                // Diğer kullanıcılara user rolü ver
                $user->syncRoles(['user']);
                $this->info("Assigned user role to user: {$user->name}");
            }
        }

        $this->info('User roles have been updated successfully.');
    }
} 