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

    public function getPeakList() {

    $peaks = $this->orderby('elevation','DESC')->get();

    $peak_list = [];
    foreach($peaks as $peak) {
        $peak_list[$peak->id] = $peak->name;
    }

    return $peak_list;

}
}
