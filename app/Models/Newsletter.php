<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    
    protected $fillable = ['email'];
    
    // Add validation rule for email
    public static function rules()
    {
        return [
            'email' => 'required|email|unique:newsletters,email',
        ];
    }
}
