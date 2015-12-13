<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hike extends Model
{
    public function peaks()
    {
    	# With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    	return $this->belongsToMany('\App\Peak')->withTimestamps();
    }

    public function user() {
        # Hike belongs to User
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\User');
    }
}
