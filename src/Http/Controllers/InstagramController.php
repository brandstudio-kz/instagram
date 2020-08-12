<?php

namespace BrandStudio\Instagram\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BrandStudio\Instagram\Facades\Instagram;

class InstagramController extends Controller
{

    public function account(Request $request)
    {
        return \Cache::get('instagram_account');
    }

    public function followers(Request $request)
    {
        return \Cache::get('instagram_followers');
    }

    public function posts(Request $request)
    {
        return \Cache::get('instagram_posts');
    }

}
