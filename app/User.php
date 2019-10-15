<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $guard_name = 'api';
    protected $fillable = [
        'document_type_user_id',
        'document',
        'names',
        'surnames',
        'email',
        'phone1',
        'phone2',
        'neighborhood_user_id',
        'eps_user_id',
        'sexe_user_id',
        'arl_user_id',
        'compensation_box_id',
        'blood_group_id',
        'birth_date',
        'name_ref',
        'phone_ref',
        'relationship_ref',
        'responable_user_id',
        'remember_token',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function arl()
    {
        return $this->belongsTo(Arl::class, 'arl_user_id');
    }

    public function blood_group()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }

    public function compensation()
    {
        return $this->belongsTo(Compensation::class, 'compensation_box_id');
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class, 'eps_user_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_user_id');
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class, 'sexe_user_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responable_user_id');
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_user_id');
    }

    public function degree() //Grado
    {
        return $this->belongsToMany(Degrees::class, "student_degree", 'user_id', 'degree_id')->withTimestamps();
    }
}
