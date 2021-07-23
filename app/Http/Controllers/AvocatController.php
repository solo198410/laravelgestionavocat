<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AvocatRequest;
use Illuminate\Http\UploadedFile;

use App\Avocat, App\Skill, App\Detail, App\Typedetail, App\Wilaya;
use Auth;

class AvocatController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
	}

    public function index(){

        if(Auth::user()->is_admin){
            $listavocat = Avocat::all();
        }else{

    	$listavocat = Auth::user()->avocats;//Avocat::all();
    }
    return view('AVOCAT.index', ['listavocat' => $listavocat]);
    }

    public function create(){
		
    	return view('AVOCAT.create');
    }

    public function store(AvocatRequest $request){
		
    	$avocat = new Avocat();

        $avocat->user_id = Auth::id();
        $avocat->title = $request->input('title');
        $avocat->presentation = $request->input('presentation');
        //$avocat->phone = $request->input('phone');
        $avocat->adress = $request->input('adress');
        $avocat->wilaya_id = $request->input('wilaya_id');
        /*if($request->hasFile('picture')){
            $avocat->picture = $request->picture->store('images');
        }*/
        if($request->hasFile('picture')){
            $file_extension = $request->picture->getClientOriginalExtension();
            $file_name = Auth::id().'_'.time().'.'.$file_extension;
            $avocat->picture = $request->picture->move('images/profils/images', $file_name);
        }

        $avocat->save();

        session()->flash('success', 'l\'enregitrement est réussi');

        return redirect('avocats');
    }

    public function edit($id){

        $avocat = Avocat::find($id);
        
        $this->authorize('update',$avocat);
		
        return view('AVOCAT.edit', ['avocat'=> $avocat]);
    }

    public function update(AvocatRequest $request, $id){
		
    	$avocat = Avocat::find($id);
        $this->authorize('update', $avocat);

        $avocat->title = $request->input('title');
        $avocat->presentation = $request->input('presentation');
        $avocat->adress = $request->input('adress');
        $avocat->wilaya_id = $request->input('wilaya_id');
        /*if($request->hasFile('picture')){
            $avocat->picture = $request->picture->store('images');
        }*/

        if($request->hasFile('picture')){
            $file_extension = $request->picture->getClientOriginalExtension();
            $file_name = Auth::id().'_'.time().'.'.$file_extension;
            $avocat->picture = $request->picture->move('images/profils/images', $file_name);
        }

        $avocat->save();

        session()->flash('success', 'la modification a été effectuée avec succés');

        return redirect('avocats');
    }

    public function show($id){
        $avocat = Avocat::find($id);
        $avocatTitle = $avocat->title;
        return view('AVOCAT.show', ['id' => $id, 'avocatTitle' => $avocatTitle]);
    }
    
    public function destroy(Request $request, $id){
		
    	//return $request->all();
        $avocat = Avocat::find($id);
        $this->authorize('delete', $avocat);

        $avocat->delete();
        
        return redirect('avocats');
    }

    public function getData($id){
        $avocat = Avocat::find($id);
		$skills = $avocat->skills;
		$details = $avocat->details;
		return Response()->json([
			'skills' => $skills,
			'details' => $details
		]);
	}

    public function addSkill(Request $request){
        $skill = new Skill;
        $skill->avocat_id = $request->avocat_id;
        $skill->description = $request->description;
    
        $skill->save();
        return Response()->json(['etat' => true, 'id'=>$skill->id]);
    }

    public function updateSkill(Request $request){
        $skill = Skill::find($request->id);
        $skill->avocat_id = $request->avocat_id;
        $skill->description = $request->description;
    
        $skill->save();
        return Response()->json(['etat' => true]);
    }
    
    public function deleteSkill($id){
        $skill = Skill::find($id);
        $skill->delete();
        return Response()->json(['etat' => true]);
    }

    public function addDetail(Request $request){
        $detail = new Detail;
        $detail->avocat_id = $request->avocat_id;
        $detail->typedetail_id = $request->typedetail_id;
        $detail->value = $request->value;
    
        $detail->save();
        return Response()->json(['etat' => true, 'id'=>$detail->id]);
    }

    public function updateDetail(Request $request){
        $detail = Detail::find($request->id);
        $detail->avocat_id = $request->avocat_id;
        $detail->typedetail_id = $request->typedetail_id;
        $detail->value = $request->value;
    
        $detail->save();
        return Response()->json(['etat' => true]);
    }
    
    public function deleteDetail($id){
        $detail = Detail::find($id);
        $detail->delete();
        return Response()->json(['etat' => true]);
    }

}
