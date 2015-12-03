<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peak extends Model
{
    public function hikes()
    {
    	# With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    	return $this->belongsToMany('\App\Hike')->withTimestamps();
    }
}
