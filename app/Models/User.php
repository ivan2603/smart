<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
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

	/**
	 * Relations with model Role
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_roles');
	}

	/**
	 * Check is user admin
	 * @return void
	 */
	public function isAdmin()
	{
		$admin = $this->roles()->where('name', 'admin')->exists();
		if ($admin) return $admin;
	}

	/**
	 * Check is user another user
	 *  @return string
	 */
	public function isUser()
	{
		$user = $this->roles()->where('name', 'user')->exists();
		if ($user) return $user;
	}

	/**
	 * Check is user disabled
	 * @return string
	 */
	public function isDisabled()
	{
		$disabled = $this->roles()->where('name', 'disabled')->exists();

		if ($disabled) return $disabled;
	}

	public function isGuest()
	{
		$guest = $this->roles()->where('name', 'guest')->exists();

		if ($guest) return $guest;
	}
}
