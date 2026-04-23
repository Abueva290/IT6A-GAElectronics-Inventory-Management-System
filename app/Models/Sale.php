<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model {
    use HasFactory;
    protected $fillable = [
        'customer_id', 'total_amount', 'status',
        'payment_method', 'payment_status', 'sale_date'
    ];
    protected $casts = ['sale_date' => 'date'];
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
}