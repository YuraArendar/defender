<?php

namespace App\Console\Commands;

use App\Models\AdminUser;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        if (!$name || !$email || !$password) {
            $this->error('Required all parameters');
        }

        $user = new AdminUser();
        $user->name = $name;
        $user->email = $email;
        $user->password = \Hash::make($password);

        $user->save();

        $this->info('User created!');
    }
}
