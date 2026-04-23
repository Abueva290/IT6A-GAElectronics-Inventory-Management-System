<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['category_id','product_name','model_number','description','unit_price','stock'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function inventory() {
        return $this->hasOne(Inventory::class);
    }
    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
}