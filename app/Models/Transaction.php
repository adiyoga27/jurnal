<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function Illuminate\Events\queueable;
class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions';
    protected $fillable = [
        'noinvoice',
        'customer_name',
        'customer_phone',
        'keterangan',
        'paid_at',
        'total',
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            $date = Carbon::now();
            $trx = Transaction::whereBetween('created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()])->withTrashed()->get();
            $uniqueID = 10000+$trx->count()+1;
            $noinvoice = "INV".Carbon::now()->format('Ymd').sprintf('%04d', $uniqueID);
            $model->update([
                'noinvoice' => $noinvoice,
                'username' => auth()->user()->username,
                'user_id' => auth()->user()->id,
            ]);
          


        });
    }

    public function details() {
        return $this->hasMany(DetailTransaction::class, 'transaction_id', 'id');
    }
}
