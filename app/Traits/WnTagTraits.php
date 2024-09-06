<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait WnTagTraits
{
    public function syncTagsFromTagify(string|null $tagifyString = null, $type = null): static
    {
        if(!empty($tagifyString)){
            $className = static::getTagClassName();
            $tagNames = collect(json_decode($tagifyString, true))->pluck('value')->toArray();
            $tags = collect($className::findOrCreate($tagNames, $type));
            $this->syncTagIds($tags->pluck('id')->toArray(), $type);
        }else{
            $this->syncTagIds([], $type);
        }
        return $this;
    }

    public  function getFirstTag($tagType)
    {   
        return $this->tags?->where('type', $tagType)->first();
    }
}
