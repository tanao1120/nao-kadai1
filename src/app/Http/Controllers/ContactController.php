<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $channels = Channel::all();

        return view('index', compact('categories', 'channels'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();

        $tel = ($validated['tel1'] ?? '') . ($validated['tel2'] ?? '') . ($validated['tel3'] ?? '');

        $contact = $validated;
        $contact['tel'] = $tel;

        $categories = Category::all();
        $channels = Channel::all();

        return view('confirm', compact('contact', 'categories', 'channels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel' => ['required'],
            'address' => ['required'],
            'building' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'detail' => ['required', 'max:120'],

            'channels' => ['required', 'array', 'min:1'],
            'channels.*' => ['integer', 'exists:channels,id'],
        ]);

        $channels = $data['channels'];
        unset($data['channels']);

        $contact = Contact::create($data);

        $contact->channels()->attach($channels);

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
