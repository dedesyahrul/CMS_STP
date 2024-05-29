<?php

namespace App\Http\Controllers;

use App\Models\PendampinganHukum;
use App\Models\PendapatHukum;
use App\Models\AuditHukum;
use Illuminate\Http\Request;

class KelolaPertimbanganHukumController extends Controller
{
    public function index_phukum(Request $request)
    {
        $entries = $request->input('entries', 10);
        $pendampinganHukum = PendampinganHukum::paginate($entries);
        return view('kelola_pendampingan_hukum.index', compact('pendampinganHukum', 'entries'));
    }

    public function destroy_phukum(PendampinganHukum $pendampinganHukum)
    {
        if ($pendampinganHukum->unggah_file && file_exists(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file))) {
            unlink(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file));
        }

        $pendampinganHukum->delete();

        return redirect()->route('kelola_pendampingan_hukum.index')
            ->with('success', 'Pendampingan Hukum berhasil dihapus.');
    }

    public function index_pthukum()
    {
        $pendapatHukum = PendapatHukum::paginate(10);
        return view('kelola_pendapat_hukum.index', compact('pendapatHukum'));
    }

    public function destroy_pthukum(PendapatHukum $pendapatHukum)
    {
        if ($pendapatHukum->unggah_file && file_exists(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file))) {
            unlink(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file));
        }

        $pendapatHukum->delete();

        return redirect()->route('kelola_pendapat_hukum.index')
            ->with('success', 'Pendapat Hukum berhasil dihapus.');
    }

    public function index_ahukum()
    {
        $auditHukum = AuditHukum::paginate(10);
        return view('kelola_audit_hukum.index', compact('auditHukum'));
    }

    public function destroy_ahukum(AuditHukum $auditHukum)
    {
        if ($auditHukum->unggah_file && file_exists(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file))) {
            unlink(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file));
        }

        $auditHukum->delete();

        return redirect()->route('kelola_audit_hukum.index')
            ->with('success', 'Audit Hukum berhasil dihapus.');
    }

}
