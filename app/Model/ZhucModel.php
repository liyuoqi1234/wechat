<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZhucModel extends Model
{
    protected $table = 'zhuc';
	protected $primaryKey = 'z_id';
	public $timestamps = false;
	protected $guarded = [];
}
