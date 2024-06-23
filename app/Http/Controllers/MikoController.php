<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class MikoController extends Controller
{
    public function enkripsi()
    {
        $encrypted = Crypt::encryptString('Belajar Laravel Di malasngoding.com');
        $decrypted = Crypt::decryptString($encrypted);

        echo "Hasil Enkripsi : " . $encrypted;
        echo "<br/>";
        echo "<br/>";
        echo "Hasil Dekripsi : " . $decrypted;
    }

    public function data()
    {
        $parameter = [
            'nama' => 'Diki Alfarabi Hadi',
            'pekerjaan' => 'Programmer',
        ];
        $enkripsi = Crypt::encrypt($parameter);
        echo "<a href='/data/" . urlencode($enkripsi) . "'>Klik</a>";
    }

    public function data_proses($data)
    {
        $data = Crypt::decrypt(urldecode($data));

        echo "Nama : " . $data['nama'];
        echo "<br/>";
        echo "Pekerjaan : " . $data['pekerjaan'];
    }

    public function hash()
    {
        $hash_password_saya = Hash::make('halo123');
        echo $hash_password_saya;
    }
    
}
