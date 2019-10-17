<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_users = User::all();
         return view('home', compact('all_users'));
    }
    function contactmessageview(){
      $contactmessages = Contact::all();
      return view('contact/messageview', compact('contactmessages'));
    }
    function changecategoryview($category_id){
      if(Category::find($category_id)->menu_status == 0){
        Category::find($category_id)->update([
          'menu_status' => true
        ]);
        }
        else{
          Category::find($category_id)->update([
            'menu_status' => false
          ]);
        }
        return back();

    }
    function messageview($message_id){
      if(Contact::find($message_id)->read_status == 1){
        Contact::find($message_id)->update([
          'read_status' => 2
        ]);
      }else {
        Contact::find($message_id)->update([
          'read_status' => 1
        ]);
      }
      return back();
    }


}
