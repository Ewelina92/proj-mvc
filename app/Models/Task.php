<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Task
{
    public static function all()
    {
        $files = File::files(resource_path("tasks/"));

        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }

    public static function find($slug)
    {
        base_path();
        $path = resource_path("tasks/{$slug}.html");

        if (!file_exists($path)) {
            throw new ModelNotFoundException();
            // return redirect('/tasks');
        }

        return cache()->remember("task.{$slug}" , 1200, function () use ($path) {
            return file_get_contents($path);
        });

        // $task = file_get_contents($path);
    }


}