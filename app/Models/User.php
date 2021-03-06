<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'sub_division_id',
        'alias',
        'email',
        'password',
    ];

    protected $with = ['subDivision.division'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function subDivision()
    {
        return $this->belongsTo( SubDivision::class);
    }

    public function posts()
    {
        return $this->hasMany( Post::class );
    }


    public function scopeActive()
    {
        return $this->where('active', true);
    }

    public function scopeActiveTeammates()
    {
        $subDivId = $this->subDivision()->first()->id;
        return $this->active()->where('sub_division_id', $subDivId);
    }

    public function scopeExceptKaunit()
    {
        $subDivId = $this->subDivision()->first()->id;
        $role = Role::whereNotIn('name', ['kaunit'])->pluck('name');
        return $this->where('sub_division_id', $subDivId)
                ->role( $role );
    }
}
