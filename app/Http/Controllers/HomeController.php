<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Snippet;

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

    public function index()
    {
        $snp =   Snippet::where('user_id','=',Auth::user()->id)->get();

        return view('home',compact('snp'));
    }

    public function sair(){
      Auth::logout();
      return view('welcome');
    }

    public function content(Request $request, $id){
        $data = ['id' => $request['id']];
        $snip =  Snippet::where('id','=',$data['id'])->first();
        return view('contentgeral',compact('snip'));
    }

    public function update(Request $request, $id){
        $content = $request->all('value');
        $data = [
            'snip' => $content['value'],
        ];
         Snippet::where('id','=',$id )->update($data);
        $snip = array ('status' => 'success',
            'msg' => 'Atualizado com sucesso',);
        return response ()->json ($snip);
    }

    public function newSnip(Request $request){
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request['snip_title'],
            'snip' => $request['snip_text']
        ];
        return Snippet::create($data);
    }

    public function delete($id){
        Snippet::where('id','=',$id)->delete();
    }

}
