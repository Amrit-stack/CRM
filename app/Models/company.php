<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $table='companies';
    protected $primaryKey='company_id';
    protected $fillable=['name','email','logo','website'];
    
    public function getLogoAttribute($value)
    {
       return $value;
    }
    public function employees()
    {
        return $this->hasMany(employee::class,'company_id','company_id');
    }
    public function getEmployeesAttribute()
    {
        return $this->employees();
    }
    
    
}
