<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Lumen\Auth\Authorizable;

class Opportunity extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $incrementing = false;
    protected $table = 'opportunities';
    protected $fillable = [
        'title', 'description', 'status', 'address',
        'salary', 'company_id', 'recruiter_id', 'id'
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function recruiter(): HasOne
    {
        return $this->hasOne(Recruiter::class, 'id', 'recruiter_id');
    }
}
