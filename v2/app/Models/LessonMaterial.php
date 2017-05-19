<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;
use Illuminate\Support\Str;

class LessonMaterial extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'lesson_materials';
    public $timestamps = false;
    protected $fillable = [
        
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'delete_status'
    ];

    public function __construct() {           
        return $this;
    }
}