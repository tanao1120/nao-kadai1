<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // PG01: 入力ページ GET /
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // PG02: 確認ページ POST /confirm
    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();

        $tel = $validated['tel1'] . $validated['tel2'] . $validated['tel3'];

        $contact = $validated;
        $contact['tel'] = $tel;

        return view('confirm', compact('contact'));
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
            'categry_id' => ['required'],
            'detail' => ['required', 'max:120'],
        ]);

        Contact::create($data);

        return view('thanks');
    }

    // PG03: サンクス GET /thanks
    public function thanks()
    {
        return view('thanks');
    }
}
