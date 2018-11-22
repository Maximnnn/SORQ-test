<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'assignee_id'];

    /**
     * @param $filter array
     * @param $search array
     * @return Collection
     */
    public function getTasksWithAllData(array $filter = [], array $search = []) {
        return
            self::query()
                ->with(['comments' => function($query) {
                    $query->with('user');
                }])
                ->with('assignee')
                ->where(function($query) use ($search) {
                    foreach ($search as $key => $value) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                })
                ->where($filter)
                ->get();
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


    public function store($task) {
        return self::create($task);
    }



}
