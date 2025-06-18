<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixUserNamaToString extends Command
{
    protected $signature = 'fix:nama-array';

    protected $description = 'Mengubah field nama yang berupa array menjadi string';

    public function handle()
    {
        $users = User::all();
        $count = 0;

        foreach ($users as $user) {
            if (is_array($user->nama)) {
                $user->nama = implode(', ', $user->nama); // gabungkan jadi string
                $user->save();
                $count++;
                $this->info("✔ Nama user ID {$user->id} diperbaiki.");
            }
        }

        if ($count > 0) {
            $this->info("✅ Selesai. {$count} user diperbaiki.");
        } else {
            $this->info("👌 Tidak ada data nama berupa array.");
        }

        return 0;
    }
}
