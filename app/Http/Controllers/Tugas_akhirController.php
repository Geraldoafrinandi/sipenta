<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Tugas_akhirController extends Controller
{
    public function downloadDokumenPKL($id_ta)
    {
        $tugasAkhir = DB::table('tugas_akhirs')->where('id_ta', $id_ta)->first();
        if (!$tugasAkhir) {
            abort(404, 'File not found in database.');
        }
        $filePath = storage_path("app/public/dokumen_pkl/{$tugasAkhir->dokumen_pkl}");
        if (!Storage::disk('public')->exists("dokumen_pkl/{$tugasAkhir->dokumen_pkl}")) {
            abort(404, 'File not found on disk.');
        }
        return response()->download($filePath);
    }
    public function downloadLembarBimbingan($id_ta)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id_ta);
        $filePath = storage_path("app/public/lembar_bimbingan/{$tugasAkhir->lembar_bimbingan}");
        if (!Storage::disk('public')->exists("lembar_bimbingan/{$tugasAkhir->lembar_bimbingan}")) {
            abort(404, 'File not found on disk.');
        }
        return response()->download($filePath);
    }

    public function downloadProposal($id_ta)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id_ta);
        $filePath = storage_path("app/public/proposal/{$tugasAkhir->proposal}");
        if (!Storage::disk('public')->exists("proposal/{$tugasAkhir->proposal}")) {
            abort(404, 'File not found on disk.');
        }
        return response()->download($filePath);
    }

    public function downloadLaporanTA($id_ta)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id_ta);
        $filePath = storage_path("app/public/laporan_ta/{$tugasAkhir->laporan_ta}");
        if (!Storage::disk('public')->exists("laporan_ta/{$tugasAkhir->laporan_ta}")) {
            abort(404, 'File not found on disk.');
        }
        return response()->download($filePath);
    }


    public function create()
    {
        $dosens = Dosen::all();
        return view('admin.tugas_akhir.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:50',
            'pembimbing1_id' => 'required|exists:dosens,id_dosen',
            'pembimbing2_id' => 'nullable|exists:dosens,id_dosen',
            'judul' => 'required|string',
            'dokumen_pkl' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'proposal' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'lembar_bimbingan' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'laporan_ta' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'tgl_pengajuan' => 'required|date',
        ]);

        try {
            $fileFields = ['dokumen_pkl', 'proposal', 'lembar_bimbingan', 'laporan_ta'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = $file->getClientOriginalName();
                    $folder = ''; // Nama folder untuk setiap jenis file

                    // Tentukan folder berdasarkan nama field
                    switch ($field) {
                        case 'dokumen_pkl':
                            $folder = 'dokumen_pkl';
                            break;
                        case 'proposal':
                            $folder = 'proposal';
                            break;
                        case 'lembar_bimbingan':
                            $folder = 'lembar_bimbingan';
                            break;
                        case 'laporan_ta':
                            $folder = 'laporan_ta';
                            break;
                        default:
                            $folder = 'other'; // Folder default jika tidak cocok
                            break;
                    }

                    // Simpan file ke dalam folder yang ditentukan
                    $path = $file->storeAs("public/{$folder}", $filename);

                    // Simpan nama file ke dalam array $validatedData
                    $validatedData[$field] = $filename;
                }
            }

            Tugas_akhir::create([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'pembimbing1_id' => $request->pembimbing1_id,
                'pembimbing2_id' => $request->pembimbing2_id,
                'judul' => $request->judul,
                'dokumen_pkl' => $validatedData['dokumen_pkl'], // Simpan nama file
                'proposal' => $validatedData['proposal'], // Simpan nama file
                'lembar_bimbingan' => $validatedData['lembar_bimbingan'], // Simpan nama file
                'laporan_ta' => $validatedData['laporan_ta'], // Simpan nama file
                'tgl_pengajuan' => $request->tgl_pengajuan,
            ]);


            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan data. Pesan error: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        // Get the logged-in user
        $user = Auth::user();

        // Inisialisasi variabel $tugasAkhir untuk digunakan nanti
        // $tugasAkhir = null;

        // Filter data based on the user's role
        if ($user->role == 'dosen') {
            // Jika user adalah dosen, ambil hanya data mahasiswa yang dibimbingnya
            $tugasAkhir = Tugas_akhir::where('pembimbing1_id', $user->id)
                                    ->orWhere('pembimbing2_id', $user->id)
                                    ->with(['pembimbing1', 'pembimbing2', 'mahasiswa'])
                                    ->get();
        } elseif ($user->role == 'mahasiswa') {
            // Jika user adalah mahasiswa, tampilkan hanya data milik mereka
            $tugasAkhir = Tugas_akhir::where('nim', $user->nim)
                                    ->with(['pembimbing1', 'pembimbing2', 'mahasiswa'])
                                    ->get();
        } elseif ($user->role == 'kaprodi') {
            // Jika user adalah kaprodi, ambil semua data tugas akhir
            $tugasAkhir = Tugas_akhir::with(['pembimbing1', 'pembimbing2', 'mahasiswa'])
                                    ->get();
        } else {
            // Handle other roles or scenarios if necessary
        }

        // Kirim data ke view
        return view('admin.tugas_akhir.index', compact('tugasAkhir', 'user'));
    }



    public function edit($id)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id);
        $dosens = Dosen::all(); // Fetch all dosen records
        return view('admin.tugas_akhir.edit', compact('tugasAkhir', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:50',
            'pembimbing1_id' => 'required|exists:dosens,id_dosen',
            'pembimbing2_id' => 'nullable|exists:dosens,id_dosen',
            'judul' => 'required|string',
            'dokumen_pkl' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lembar_bimbingan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'laporan_pkl' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'laporan_ta' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tgl_pengajuan' => 'required|date',
        ]);

        $tugasAkhir = Tugas_akhir::findOrFail($id);

        try {
            $fileFields = ['dokumen_pkl', 'proposal', 'lembar_bimbingan', 'laporan_pkl', 'laporan_ta'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    if ($tugasAkhir->{$field}) {
                        Storage::delete('public/' . $tugasAkhir->{$field});
                    }
                    $file = $request->file($field);
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public', $filename);
                    $validatedData[$field] = $filename;
                }
            }

            Tugas_akhir::where('id_ta', $id)->update($validatedData);

            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil diupdate.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate data. Pesan error: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            // Temukan entri Tugas_akhir berdasarkan ID
            $tugasAkhir = Tugas_akhir::findOrFail($id);

            // Hapus validasi proposal terkait jika ada
            if ($tugasAkhir->validasiProposal) {
                $tugasAkhir->validasiProposal->delete();
            }

            // Hapus validasi TA terkait jika ada
            if ($tugasAkhir->validasiTa) {
                $tugasAkhir->validasiTa->delete();
            }

            // Array yang berisi nama folder dan nama field yang menyimpan nama file
            $folderFields = [
                'dokumen_pkl' => 'dokumen_pkl',
                'proposal' => 'proposal',
                'lembar_bimbingan' => 'lembar_bimbingan',
                'laporan_ta' => 'laporan_ta',
            ];

            // Loop melalui setiap folder dan field untuk menghapus file-file terkait
            foreach ($folderFields as $folder => $field) {
                // Periksa apakah field tersebut memiliki nilai file yang tersimpan
                if ($tugasAkhir->{$field}) {
                    // Dapatkan path lengkap dari file yang akan dihapus
                    $filePath = storage_path("app/public/{$folder}/{$tugasAkhir->{$field}}");

                    // Hapus file menggunakan Storage facade
                    Storage::disk('public')->delete("{$folder}/{$tugasAkhir->{$field}}");
                }
            }

            // Hapus entri Tugas_akhir dari database setelah menghapus file-file terkait dan validasi
            $tugasAkhir->delete();

            // Redirect ke halaman indeks Tugas_akhir dengan pesan sukses
            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil dihapus beserta data validasinya.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan ke halaman sebelumnya dengan pesan error
            return back()->withErrors(['error' => 'Gagal menghapus data. Pesan error: ' . $e->getMessage()]);
        }
    }

}
