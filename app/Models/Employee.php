<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model {
    use HasFactory;
    protected $fillable = ['first_name','last_name','role','contact_info'];
    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }
    public function sales() {
        return $this->hasMany(Sale::class);
    }
}