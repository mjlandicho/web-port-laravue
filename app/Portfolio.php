<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'f_image',
        'description',
        'project_info',
        'client',
        'website',
        'completed',
      ];
}
