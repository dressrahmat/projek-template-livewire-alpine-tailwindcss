<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'id_user', 'id_murobbi', 'bio', 'photo_profile', 'nama_depan', 'nama_belakang', 'jenis_kelamin', 'tanggal_lahir', 'nomor_telepon', 'amanah', 'agama', 'status_pernikahan', 'pendidikan_terakhir',
    ];

    /**
     * Get the user that owns the Profile
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
