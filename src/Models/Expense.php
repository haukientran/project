<?php
namespace Project\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\BaseModel;

class Expense extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'amount', 'field_id', 'project_id', 'member_id', 'note', 'date', 'creator_id', 'updater_id', 'status'];

    // Định nghĩa các loại thu/chi
    public function getTypes()
    {
        return [
            1 => 'Thu nhập',
            2 => 'Chi phí',
        ];
    }

    // Quan hệ với dự án
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getTypeLabelAttribute()
    {
        return isset($this->getTypes()[$this->type ]) ? $this->getTypes()[$this->type ] : 'Không xác định';
    }

    public function getFieldLabelAttribute()
    {
        return isset(config('app.fields')[$this->field_id ]) ? config('app.fields')[$this->field_id ] : 'Không xác định';
    }
}