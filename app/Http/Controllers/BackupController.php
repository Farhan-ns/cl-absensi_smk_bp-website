<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function backupDB()
    {
        $exitCode = Artisan::call('backup:run --only-db');

        if ($exitCode == 0) {
            return redirect()->route('dashboard')->with('swal-success', 'Berhasil backup data.');
        }
        return redirect()->route('dashboard')->with('swal-failed', 'Terjadi kegagalan saat mem-backup data.');
    }

    public function restoreDB()
    {
        $exitCode = Artisan::call('backup:restore --backup=latest --password= --connection=mysql --no-interaction');

        if ($exitCode == 0) {
            return redirect()->route('dashboard')->with('swal-success', 'Restore backup berhasil.');
        }

        return redirect()->route('dashboard')->with('swal-failed', 'Terjadi kegagalan saat mem-restore backup.');
    }
}
