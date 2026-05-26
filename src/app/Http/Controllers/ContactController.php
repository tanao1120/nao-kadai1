<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

        // 画像があれば tmp に保存（public disk）
        if ($request->hasFile('image')) {
            $tmpPath = $request->file('image')->store('tmp', 'public'); 
            $contact['tmp_image_path'] = $tmpPath;
        }

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
            'tmp_image_path' => ['nullable', 'string'],
        ]);

        $channels = $data['channels'];
        unset($data['channels']);

        if (!empty($data['tmp_image_path']) && Storage::disk('public')->exists($data['tmp_image_path'])) {
            $filename = basename($data['tmp_image_path']);
            $finalPath = 'contacts/' . $filename;
            Storage::disk('public')->move($data['tmp_image_path'], $finalPath);
            $data['img_path'] = $finalPath;
        }
        unset($data['tmp_image_path']);

        $contact = Contact::create($data);
        $contact->channels()->attach($channels);

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
