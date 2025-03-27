<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe to the newsletter
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate(Newsletter::rules());
        
        try {
            Newsletter::create($validated);
            return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }
}
