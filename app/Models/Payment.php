<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model {
    use HasFactory;
    protected $fillable = ['sale_id', 'payment_date', 'amount_paid', 'payment_method', 'status'];
    protected $casts = ['payment_date' => 'date'];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
}