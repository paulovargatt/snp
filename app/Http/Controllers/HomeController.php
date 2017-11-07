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
        $snpMenu =   Snippet::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        $snipet = Snippet::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->first();
        return view('home',compact('snpMenu','snipet'));
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

    public function GetLastSnip(){
        $snip = Snippet::where('user_id','=',Auth::user()->id)->orderBy('created_at','DESC')->first();
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

    public function editTitle(Request $request, $id){
        $title = $request->all('value');
        $data = [
            'title' => $title['value']
        ];
        Snippet::where('id','=',$id )->update($data);
        $snip = array ('status' => 'success',
            'msg' => 'Atualizado com sucesso',);
        return response ()->json ($snip);

    }

    public function delete($id){
        Snippet::where('id','=',$id)->delete();
    }

    public function snipFind(Request $request){

            $term = trim($request->q);
            if (empty($term)) {
                return \Response::json([]);
            }
            $snip = Snippet::where('user_id','=',Auth::user()->id)->search($term)->limit(5)->get();

            $formatted_tags = [];

            foreach ($snip as $snipet) {
                $formatted_tags[] = ['id' => $snipet->id, 'text' => $snipet->title];
            }

            return \Response::json($formatted_tags);
    }


}
