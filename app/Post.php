<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'status', 'body', 'published_at',
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];

    const DRAFT = 0;
    const PUBLISHED = 1;

    public static $statusLabels = [
        self::DRAFT => '下書き',
        self::PUBLISHED => '公開',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute()
    {
        if (is_null($this->status)) {
            return '指定してください。';
        }
        return self::$statusLabels[$this->status];
    }

    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $column => $text) {
            if ($column !== 'page' && $request->filled($column)) {
                $query->where($column, 'like', '%'.$text.'%');
            }
        }
        return $query;
    }
}
