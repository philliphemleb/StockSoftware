<?php
declare(strict_types=1);

namespace App\Http\Services;

use App\Category;
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
     * @param string|null $tags
     */
    public function addTagsToItemFromString(Item $item, string $tags = null)
    {
        if ($tags == null) return;
        $tags = explode(',', $tags);

        foreach($tags as $tagString)
        {
            $tagString = trim($tagString);
            if ($tagString === null || empty($tagString)) continue;
            if ($item->tags->where('name', $tagString)->count() > 0) continue;


            $tag = Tag::firstOrNew(['name' => $tagString]);
            $item->tags()->save($tag);
        }
    }

    /**
     * Handles the Tags String and deletes them in the given.
     *
     * @param Item $item
     * @param string|null $tags
     */
    public function deleteTagsFromItemWithString(Item $item, string $tags = null)
    {
        if ($tags  == null) return;
        $tags = explode(',', $tags);

        foreach($tags as $tagString)
        {
            $tagString = trim($tagString);
            if ($tagString === null || empty($tagString)) continue;
            if ($item->tags->where('name', $tagString)->count() <= 0) continue;

            $tag = $item->tags->where('name', $tagString)->first();
            $item->tags()->detach($tag);
        }
    }

    /**
     * Handles the Categories String and saves them in the given Item.
     * @param Item $item
     * @param string|null $categories
     */
    public function addCategoriesToItemFromString(Item $item, string $categories = null)
    {
        if ($categories == null) return;
        $categories = explode(',', $categories);

        foreach($categories as $categoryString)
        {
            $categoryString = trim($categoryString);
            if ($categoryString === null || empty($categoryString)) continue;
            if ($item->categories->where('name', $categoryString)->count() > 0) continue;


            $category = Category::firstOrNew(['name' => $categoryString]);
            $item->categories()->save($category);
        }
    }

    /**
     * Handles the Categories String and deletes them in the given.
     *
     * @param Item $item
     * @param string|null $categories
     */
    public function deleteCategoriesFromItemWithString(Item $item, string $categories = null)
    {
        if ($categories  == null) return;
        $categories = explode(',', $categories);

        foreach($categories as $categoryString)
        {
            $categoryString = trim($categoryString);
            if ($categoryString === null || empty($categoryString)) continue;
            if ($item->categories->where('name', $categoryString)->count() <= 0) continue;

            $category = $item->categories->where('name', $categoryString)->first();
            $item->categories()->detach($category);
        }
    }
}
