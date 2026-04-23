<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model {
    use HasFactory;
    protected $fillable = ['product_id', 'current_stock', 'minimum_stock'];
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function getStockStatusAttribute(): string {
        if ($this->current_stock === 0) return 'OUT OF STOCK';
        if ($this->current_stock <= $this->minimum_stock) return 'LOW STOCK';
        return 'IN STOCK';
    }
}