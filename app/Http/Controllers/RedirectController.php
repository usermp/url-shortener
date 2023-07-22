<?php

namespace App\Http\Controllers;

use App\Models\Link;

class RedirectController extends Controller
{
    public function index()
    {
        $url = request()->url;
        $links = Link::where("short_link", $url)->first();
        $links->total_click++;
        $links->save();
        if ($links)
            return redirect($links->link, 301);

        abort(404, 'Short link not found.');
    }
}
