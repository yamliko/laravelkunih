<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar; // Pastikan model berada di namespace App\Models
use Illuminate\Support\Facades\File;


class UploadController extends Controller
{
    public function upload()
    {
        $gambar = Gambar::all();
        return view('upload', ['gambar' => $gambar]);
    }

    public function proses_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'keterangan' => 'required',
        ]);

        // Menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // Isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload, $nama_file);

        Gambar::create([
            'file' => $nama_file,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back();
    }

    public function hapus($id)
    {
        // Mendapatkan data gambar berdasarkan id
        $gambar = Gambar::findOrFail($id);

        // Menghapus file dari folder data_file
        if (File::exists(public_path('data_file/' . $gambar->file))) {
            File::delete(public_path('data_file/' . $gambar->file));
        }

        // Menghapus data dari database
        $gambar->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'File dan data berhasil dihapus.');
    }
}
