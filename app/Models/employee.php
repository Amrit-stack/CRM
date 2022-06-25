<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $appends=['company_name'];
    protected $table='employees';
    protected $primaryKey='employee_id';
    protected $fillable=['first_name','last_name','company_id','email','phone'];

    public function companyname()
    {
        return $this->belongsTo(company::class,'company_id','company_id')->first()->name;
    }
    public function getCompanyNameAttribute()
    {
        return $this->companyname();
    }
   
}
