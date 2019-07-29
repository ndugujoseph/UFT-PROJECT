<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$H28wnwUg3jJlkpFceMAmtuSFoNyj3Tk5Z3DguwJ81kcTVuvJWSMUm', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'Ndugu Joseph', 'email' => 'ndugujoseph98@gmail.com', 'password' => '$2y$10$Tc8JJfEy8ixLhBV.95fx/.Ayy4iShjyJT6VvT0usPWNQRFWem3OzS', 'role_id' => 2, 'remember_token' => null,],
            ['id' => 3, 'name' => 'kiyiga', 'email' => 'kiyiga@gmail.com', 'password' => '$2y$10$Zq4Swvubfqt33YIgpb1LAe8ELQNlHYk1Q175uBke24G.oEmArc13a', 'role_id' => 3, 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
