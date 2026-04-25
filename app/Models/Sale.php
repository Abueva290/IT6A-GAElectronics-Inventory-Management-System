<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model {
    use HasFactory;
    protected $fillable = ['customer_id', 'employee_id', 'total_amount', 'status', 'sales_date'];
    protected $casts = ['sales_date' => 'datetime'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
    public function payments() {
        return $this->hasMany(Payment::class);
    }
}