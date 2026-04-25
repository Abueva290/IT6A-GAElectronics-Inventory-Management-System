<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model {
    use HasFactory;
    protected $table = 'sales_details';
    protected $fillable = ['sales_id', 'product_id', 'quantity', 'unit_price', 'subtotal'];

    public function sale() {
        return $this->belongsTo(Sale::class, 'sales_id');
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}