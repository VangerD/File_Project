<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function scopeSearch($query, array $search){
        if(isset($search['search']) ? $search['search'] : false){
            return $query->where('tanggal_perjalanan', 'like', '%'. $search['search'] . '%')
            ->orWhere('jam_perjalanan', 'like', '%' . $search['search'] . '%')
            ->orWhere('nama_tempat', 'like', '%' . $search['search'] . '%')
            ->orWhere('alamat', 'like', '%' . $search['search'] . '%')
            ->orWhere('suhu_tubuh', 'like', '%' . $search['search'] . '%');
        }
    }

    public function scopeOrder($query, array $order){
        if(isset($order['filter']) && isset($order['order']) ? $order['filter'] && $order['order'] : false){
            return $query->orderBy($order['filter'], $order['order']);
        }
    }

    protected $table ='catatan';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
