<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'content', 'detail']);
        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request){

        if($request->input('back') == ('back')){
            return redirect('/')->withInput();
        } else{

        $category = $request->input('content');
        if ($category == '商品のお届けについて') {
            $category = 1;
        } else if ($category == '商品の交換について') {
            $category = 2;
        } else if ($category == '商品トラブル') {
            $category = 3;
        } else if ($category == 'ショップへのお問い合わせ') {
            $category = 4;
        } else {
            $category = 5;
        }

        $gender = $request->input('gender');
        if ($gender == '男性') {
            $gender=1;
        }else if($gender == '女性'){
            $gender=2;
        }else {
            $gender=3;
        }

        $building = $request->input('building');
        if ($building == '') {
            $building='null';
        }

        $contact = ($request->only(['last_name','first_name']) +['category_id'=>$category]+ ["gender"=> $gender] + $request->only(['email', 'tel', 'address']) + ["building"=>$building]+ $request->only(['detail']));
        Contact::create($contact);
        return view('thanks');
    }
    }

    public function display(Request $request)
    {
        $keyword = $request->input('keyword');
        $items = Contact::Paginate(7);
        foreach ($items as &$item){
            if ($item['gender'] == 1) {
                $item['gender'] = '男性';
            } else if ($item['gender'] == 2) {
                $item['gender'] = "女性";
            } else {
                $item['gender'] = "その他";
            }
        }

        if(!empty($keyword))
        {
            $items->where('email', 'like', '%'.$keyword.'%');
            return view('admin', ['items' => $items]);
        } else
        {
        return view('admin', ['items' => $items]);
        }
    }

    // public function display()
    // {
    //     // $items = Contact::get();
    //     $items = Contact::Paginate(7);
    //     foreach ($items as &$item) {
    //         if ($item['gender'] == 1) {
    //             $item['gender'] = '男性';
    //         } else if ($item['gender'] == 2) {
    //             $item['gender'] = "女性";
    //         } else {
    //             $item['gender'] = "その他";
    //         }
    //     }
    //     return view('admin', ['items' => $items]);
    // }

    // public function find()
    // {
    //     return view('admin', ['input' => '']);
    // }
    // public function search(Request $request)
    // {
    //     $item = Contact::where('email', 'LIKE', "%{$request->input}%")->all();
    //     $param = [
    //         'input' => $request->input,
    //         'items' => $item
    //     ];
    //     return view('admin', $param);
    // }

}
