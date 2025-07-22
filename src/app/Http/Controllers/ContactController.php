<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $form = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'first_tel',
            'middle_tel',
            'last_tel',
            'address',
            'building',
            'content',
            'detail',
        ]);

        $form['tel'] = $request->first_tel . $request->middle_tel . $request->last_tel;

        switch ((int) $form['gender']) {
            case 1:
                $form['gender_label'] = '男性';
                break;
            case 2:
                $form['gender_label'] = '女性';
                break;
            case 3:
                $form['gender_label'] = 'その他';
                break;
        }

        $category = Category::find($form['content']);
        $form['content_label'] = optional($category)->content;
        $form['category_id'] = $category->id;

        return view('confirm', compact('form'));
    }

    public function store(Request $request)
    {
        $form = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        Contact::create($form);

        return redirect()->route('thanks');
    }
}
