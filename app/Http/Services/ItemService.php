<?php
declare(strict_types=1);

namespace App\Http\Services;

use App\Item;
use App\Tag;

/**
 * Class ItemService
 * @package App\Http\Services
 */
class ItemService
{
    /**
     * Handles the Tags String and saves them in the given Item.
     * @param Item $item
     * @param string $tags
     */
    public function addTagsToItemFromString(Item $item, string $tags = null)
    {
        if ($tags == null) return;
        $tags = explode(',', $tags);

        foreach($tags as $tagString)
        {
            $tagString = trim($tagString);
            if ($tagString === null || empty($tagString)) continue;
            if (Tag::where('name', $tagString)->first() !== null) continue;


            $tag = Tag::firstOrNew(['name' => $tagString]);
            $item->tags()->save($tag);
        }
    }
}
