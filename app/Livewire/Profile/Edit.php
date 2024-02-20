<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $user;

    public $nama_depan;

    public $nama_belakang;

    public $tanggal_lahir;

    public $nomor_telepon;

    public $status_pernikahan;

    public $pendidikan_terakhir;

    public $jenis_kelamin;

    public $agama;

    public $provinsi;

    public $kota;

    public $alamat;

    public $photo_profile;

    public $bio;

    public $amanah;

    protected $rules = [
        'nama_depan' => 'required|string|max:255',
        'nama_belakang' => 'nullable|string|max:255',
        'tanggal_lahir' => 'required|date',
        'nomor_telepon' => 'nullable',
        'status_pernikahan' => 'required|string',
        'pendidikan_terakhir' => 'nullable|string|max:255',
        'jenis_kelamin' => 'required|string',
        'agama' => 'required|string',
        'provinsi' => 'nullable|string|max:255',
        'kota' => 'nullable|string|max:255',
        'alamat' => 'nullable|string',
        'photo_profile' => 'nullable|image',
        'bio' => 'nullable|string',
        'amanah' => 'nullable|string|max:255',
    ];

    public function mount($user)
    {
        // Cari profil pengguna yang terkait
        $this->user = $user;
        $profile = Profile::where('id_user', $this->user->id)->first();

        // Jika profil ditemukan, isi properti dengan data profil
        if ($profile) {
            $this->nama_depan = $profile->nama_depan;
            $this->nama_belakang = $profile->nama_belakang;
            $this->tanggal_lahir = $profile->tanggal_lahir;
            $this->nomor_telepon = $profile->nomor_telepon;
            $this->status_pernikahan = $profile->status_pernikahan;
            $this->pendidikan_terakhir = $profile->pendidikan_terakhir;
            $this->jenis_kelamin = $profile->jenis_kelamin;
            $this->agama = $profile->agama;
            $this->provinsi = $profile->provinsi;
            $this->kota = $profile->kota;
            $this->alamat = $profile->alamat;
            $this->bio = $profile->bio;
            $this->amanah = $profile->amanah;
        }
    }

    public function render()
    {
        $profile = Profile::where('id_user', $this->user->id)->first();
        return view('livewire.profile.edit')->with('profile', $profile);
    }

    public function update()
{
    $this->validate();
    try {
        // Periksa apakah profil pengguna sudah ada atau belum
        $profile = Profile::where('id_user', $this->user->id)->first();

        // Periksa apakah ada file foto yang diunggah
        if ($this->photo_profile !== null && $this->photo_profile instanceof \Illuminate\Http\UploadedFile) { // Periksa jika gambar diunggah dan merupakan instance dari UploadedFile
            $folderPath = 'uploads/profile/';
            $fileName = time().'.'.$this->photo_profile->getClientOriginalExtension();
            $this->photo_profile->storeAs('public/'.$folderPath, $fileName);
            $this->photo_profile = 'storage/'.$folderPath.$fileName;
        }

        // Jika profil sudah ada, lakukan pembaruan data
        if ($profile) {
            // Dapatkan path foto profil lama
            $oldPhotoPath = $profile->photo_profile;
            // Lakukan pembaruan data profil
            $profile->update([
                'nama_depan' => $this->nama_depan,
                'nama_belakang' => $this->nama_belakang,
                'tanggal_lahir' => $this->tanggal_lahir,
                'nomor_telepon' => $this->nomor_telepon,
                'status_pernikahan' => $this->status_pernikahan,
                'pendidikan_terakhir' => $this->pendidikan_terakhir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'agama' => $this->agama,
                'provinsi' => $this->provinsi,
                'kota' => $this->kota,
                'alamat' => $this->alamat,
                'bio' => $this->bio,
                'amanah' => $this->amanah,
            ]);

            // Periksa apakah ada file foto baru yang diunggah
            if ($this->photo_profile) {
                // Hapus foto profil lama dari storage
                if ($oldPhotoPath && Storage::exists($oldPhotoPath)) {
                    Storage::delete($oldPhotoPath);
                }

                // Simpan foto profil baru
                $profile->update(['photo_profile' => $this->photo_profile]);
            }
        } else {
            // Jika profil belum ada, lakukan pembuatan profil baru
            Profile::create([
                'id_user' => $this->user->id,
                'nama_depan' => $this->nama_depan,
                'nama_belakang' => $this->nama_belakang,
                'tanggal_lahir' => $this->tanggal_lahir,
                'nomor_telepon' => $this->nomor_telepon,
                'status_pernikahan' => $this->status_pernikahan,
                'pendidikan_terakhir' => $this->pendidikan_terakhir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'agama' => $this->agama,
                'provinsi' => $this->provinsi,
                'kota' => $this->kota,
                'alamat' => $this->alamat,
                'bio' => $this->bio,
                'amanah' => $this->amanah,
                'photo_profile' => $this->photo_profile,
            ]);
        }

        // Tampilkan pesan sukses kepada pengguna
        session()->flash('success', 'Profil berhasil diperbarui.');

        // Reset semua input setelah pembaruan berhasil
        // $this->reset();
        $this->dispatch('refresh');
    } catch (\Exception $e) {
        // Tangani pengecualian di sini
        session()->flash('error', 'Terjadi kesalahan saat memperbarui profil: ');
    }
}

}
