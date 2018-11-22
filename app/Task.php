<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'assignee_id'];

    /**
     * @return Builder
     */
    public static function withAll() {
        return self::query()->with(['comments' => function($query) {
            $query->with('user');
        }])->with('assignee');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assignee() {
        return $this->belongsTo(User::class);
    }




}
