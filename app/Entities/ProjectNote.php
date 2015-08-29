<?php

namespace PS\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectNote extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'project_notes';
    
    protected $fillable = [
        'title',
        'note',
        'project_id'
    ];
    
    public function project() {
        return $this->belongsTo(Project::class);
    }
    
}
