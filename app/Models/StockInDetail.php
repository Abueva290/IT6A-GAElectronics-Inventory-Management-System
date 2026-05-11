<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockInDetail extends Model
{
    use HasFactory;

    protected $table = 'stock_in_details';
    protected $fillable = ['stock_in_id', 'product_id', 'quantity_received'];

    public function stockIn()
    {
        return $this->belongsTo(StockIn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}