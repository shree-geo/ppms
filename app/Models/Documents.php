<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = ['project_id', 'cat_id', 'doc_title', 'file', 'external_link', 'signed_date', 'approved_date', 'clearance_date', 'user_id'];
    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\DocumentCatgories', 'cat_id');
    }
}
