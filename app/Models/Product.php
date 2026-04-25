<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['supplier_id', 'category_id', 'model_number', 'product_name'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function inventory() {
        return $this->hasOne(Inventory::class);
    }
    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
}