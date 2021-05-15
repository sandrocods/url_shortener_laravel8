<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShortUrl_model extends Model
{
    use HasFactory;
    protected $table = 'tbl_short';

    // Get Last Shorten Url
    public function GetLastShorten()
    {
        return DB::table('tbl_short')->select('created_at')->orderByDesc('created_at')->limit(1)->pluck('created_at');
    }

    public function CountShorten()
    {
        return DB::table('tbl_short')->count();
    }

    public function GetLastShortenUrl()
    {
        return DB::table('tbl_short')->select('original_link', 'short_link')->orderByDesc('created_at')->limit(1)->first();
    }

    public function GetSameUrl($link)
    {
        if (DB::table('tbl_short')->where('short_link', 'LIKE', '%' . $link . '%')->first()) {
            return true;
        } else {
            return false;
        }
    }
}
