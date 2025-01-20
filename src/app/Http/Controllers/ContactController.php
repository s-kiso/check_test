<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $request->flash();
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'content', 'detail']);
        return view('confirm', ['contact' => $contact]);
    }



    public function store(Request $request){

        // oldを使う際に困るためvalue=1,2,...とせずに言葉で取得し、ここでif文を用いて処理したがこれでよいか
        $category = old('content');
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

        $gender = old('gender');
        if ($gender == '男性') {
            $gender=1;
        }else if($gender == '女性'){
            $gender=2;
        }else {
            $gender=3;
        }

        $tel = old('tel1').old('tel2').old('tel3');

        // buildingが値なしだとエラーが出るため"null"にする処置を施したがほかに対処法はあるか
        $building = old('building');
        if ($building == '') {
            $building='null';
        }

        $contact = ['last_name'=>old('last_name')]+['first_name'=>old('first_name')] +['category_id'=>$category]+ ["gender"=> $gender] + ['email'=>old('email')] + ['tel' => $tel] + ['address' => old('address')] + ["building"=>$building]+ ['detail' => old('detail')];
        Contact::create($contact);
        return view('thanks');
    }

    public function display()
    {
        $items = Contact::Paginate(7);
        foreach ($items as $item){
            if ($item['gender'] == 1) {
                $item['gender'] = '男性';
            } else if ($item['gender'] == 2) {
                $item['gender'] = "女性";
            } else {
                $item['gender'] = "その他";
            }
        }

        $categories_list = Category::all();
        return view('admin', ['items' => $items, $categories_list]);
    }


    public function search(Request $request)
    {
        $request->flash();
        $name_email = $request->input('name_email');
        $gender = $request->input('gender');
        $content = $request->input('content');
        $date = $request->input('date');

        $query = Contact::query();

        // 始めこちらで書いていたが、名前で検索した際にgenderの条件が反映されないのはなぜか
        // if (!empty($name_email)) {
        //     $query->where(DB::raw('CONCAT(last_name, first_name)'), 'like', "%$name_email%")->orWhere('email', 'LIKE', "%$name_email%");
        // }

        if (!empty($name_email)) {
            $query->where(function($q) use($name_email){
                $q->where(DB::raw('CONCAT(last_name, first_name)'), 'like', "%$name_email%")->orWhere('email', 'LIKE', "%$name_email%");
            });
        }

        if (!empty($gender)) {
            $query->where('gender',$gender);
        }

        if (!empty($content)) {
            $query->where('category_id', $content);
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }

        // 2ページ目以降を開いていて検索をかけた際、1ページ目に飛ばすことができずそのページが表示される（1ページ分しかデータがないのに2ページ目以降が表示されるため、何も現れない）現象が起きるがどうすればよいか
        $items = $query->paginate(7);

        foreach ($items as $item) {
            if ($item['gender'] == 1) {
                $item['gender'] = '男性';
            } else if ($item['gender'] == 2) {
                $item['gender'] = "女性";
            } else {
                $item['gender'] = "その他";
            }
        }

        // モーダルウインドウのやり方が全体的によくわからないです

        $categories_list = Category::all();
        return view('admin', ['items' => $items, $categories_list]);
    }
}

