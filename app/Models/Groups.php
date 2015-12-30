<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model {

    use SoftDeletes;

    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    protected $guarded = ['group_id'];
    protected $dates = ['deleted_at'];
        
    public function users() {
        return $this->hasMany('App\Models\Users', 'group_id', 'group_id');
    }

}
?>

