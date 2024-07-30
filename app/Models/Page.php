<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;

class Page extends Model
{
    use HasFactory;

    public function fields(): HasMany
    {
        return $this->hasMany(PageField::class);
    }

    public function pageField(): HasMany
    {
        return $this->hasMany(PageField::class);
    }

    public static function templates(): array
    {

        $templatesPath = resource_path('views/page/templates');
        $files = File::files($templatesPath);

        $templates = [];
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $name = $file->getFilenameWithoutExtension();
                // Remove .blade from the name if it exists
                $name = str_replace('.blade', '', $name);
                $templates[$name] = ucfirst($name);
            }
        }

        return $templates;
    }
}
