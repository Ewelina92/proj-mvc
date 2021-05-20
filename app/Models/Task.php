<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property string $title
 * @property string $body
 * @property string $finished_at
 * @property integer $user_id
 */
class Task extends Model
{
    use HasFactory; // Task::factory()

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public function done()
    {
        $this->finished_at = now();
        $this->save();
    }

    public function updateTask($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
        $this->save();
    }
}
