<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model {

    use SoftDeletes;

    public $incrementing = false;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = array('id','username','email','password','name','active','group_id','photo');

    public function groups() {
        return $this->hasOne('App\Model\Groups', 'group_id', 'group_id');
    }

}
?>
