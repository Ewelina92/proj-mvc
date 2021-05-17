<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Task
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    /**
     * Task constructor
     * @param $title
     * @param $date
     * @param $body
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return collect(File::files(resource_path("tasks/")))
        ->map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function ($document) {
            //$document = YamlFrontMatter::parseFile($file);

            return new Task(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        })
        ->sortByDesc('date');
        // $files = File::files(resource_path("tasks/"));

        // return array_map(function ($file) {
        //     return $file->getContents();
        // }, $files);
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
        // base_path();
        // $path = resource_path("tasks/{$slug}.html");

        // if (!file_exists($path)) {
        //     throw new ModelNotFoundException();
        //     // return redirect('/tasks');
        // }

        // return cache()->remember("task.{$slug}" , 1200, function () use ($path) {
        //     return file_get_contents($path);
        // });

        // $task = file_get_contents($path);
    }


}