<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public const GENDERS = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];

    public function getGenderLabelAttribute()
    {
        switch ($this->gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
        }
    }

    public function scopeKeywordSearch($query, $params)
    {
        if (!empty($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $keyword . '%'])
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($params['gender'])) {
            $query->where('gender', $params['gender']);
        }

        if (!empty($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }

        if (!empty($params['created_at'])) {
            $query->whereDate('created_at', $params['created_at']);
        }
    }
}
