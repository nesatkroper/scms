<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'description',
  ];
  public function users()
  {
    return $this->hasMany(User::class);
  }
  public function teachers(): HasMany
  {
    return $this->hasMany(User::class)->where('role', 'teacher'); // Adjust based on your role system
  }
  public function subjects(): HasMany
  {
    return $this->hasMany(Subject::class);
  }
  public function head()
  {
    return $this->belongsTo(User::class, 'head_id'); // Assuming 'head_id' is the foreign key
  }
<<<<<<< HEAD
=======

>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
}
