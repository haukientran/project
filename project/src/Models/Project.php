<?php

namespace Project\Models;

use App\Models\BaseModel;

class Project extends BaseModel
{
    protected $table = 'projects';
    protected $fillable = ['name', 'slug', 'image', 'description', 'manager_id', 'member_ids', 'field_id', 'total_revenue', 'total_expense', 'renewed_at', 'deadline', 'sort', 'creator_id', 'updater_id', 'status'];

    public function getFieldLabelAttribute()
    {
        return isset(config('app.fields')[$this->field_id ]) ? config('app.fields')[$this->field_id ] : 'Không xác định';
    }
}