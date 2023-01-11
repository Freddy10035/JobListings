<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    // public static function all() {
    // return     
    // }

    // public static function find($id) {
    //     $listings = self::all();

    //     foreach ($listings as $listing) {
    //         if ($listing[$id] == $id) {
    //             return $listing;
    //         }
    //     }
    // }


    //adds the tags filter
    public function scopeFilter($query, array $filters){
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like' ,'%' .request('tag') .'%');
        }

    //adds the search filter

        if ($filters['search'] ?? false) {
            $query->where('title', 'like' ,'%' .request('search') .'%')
            ->orWhere('description', 'like' ,'%' .request('search') .'%')
            ->orWhere('tags', 'like' ,'%' .request('search') .'%');
        }

    }
}

