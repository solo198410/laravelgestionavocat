<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
//use Illuminate\Support\Carbon;

use App\Affaire, App\User, App\Client, App\Seance, App\Decision, App\Frai, App\Autoritesjudiciaire, App\Type;
use App\Http\Requests\affaireRequest;

class SgcaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	//affichage par numéro d'affaire et par user

	public function index_(Request $request){
		if ($request->input('numero_affaire') != ''){
		$listaffaire = Auth::user()->affaires()->where('numero_affaire', 'like', '%'.$request->input("numero_affaire").'%')->get();
		$numero_affaire = array();
		foreach ($listaffaire as $affaire) {
			$numero_affaire[] = $affaire->id ;
		}
	return view('AFFAIRE.index_', ['affaires'=>$listaffaire]);
}
else {
	return view('AFFAIRE.index_');
}
	//session()->flash('rendez_vous', 'affaire 15/2020 délai de recours dépassé');

	}


	// lister les affaires
	// affichage par date début date fin
	//affichage de tout les champs pour admin account
	
    public function index(Request $request){
		if ($request->input('date_debut') != '' && $request->input('date_fin') != ''){
		if(Auth::user()->is_admin){
			$listaffaire = Affaire::whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])
			->get();
		} else{
		$listaffaire = Auth::user()
		->affaires()
		->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])
		->get();
		// Affaire::all();//Affaire::where('user_id', Auth::id())->get();//Affaire::all();
	}
	//session()->flash('rendez_vous', 'affaire 15/2020 délai de recours dépassé');
	return view('AFFAIRE.index', ['affaires'=>$listaffaire]);
	}
	else {
		return view('AFFAIRE.index');
	}
}
    public function create(){
		$autoritesjudiciaires = DB::table('autoritesjudiciaires')
		->get();

    	return view('AFFAIRE.create', ['autoritesjudiciaires'=>$autoritesjudiciaires]);
    }
    public function store(affaireRequest $request){
    	$affaire = new Affaire();
    	$affaire->user_id = Auth::id();// Auth::user()->id;
		$affaire->numero_affaire = $request->input('numero_affaire');
		$affaire->presentation = $request->input('presentation');
    	$affaire->frais_affaire = $request->input('frais_affaire');
		$affaire->autoritesjudiciaire_id = $request->input('autoritesjudiciaire_id');
    	//$affaire->autorite_jud_comp = $request->input('autorite_jud_comp');

		$affaire->save();
		session()->flash('success', 'l\'Affaire a été bien enregistrée!');
		return redirect('affaires');
    }

    public function edit($id){
		$autoritesjudiciaires = DB::table('autoritesjudiciaires')
		->get();
		
		$affaire = Affaire::find($id);
		$this->authorize('update', $affaire);
		return view('AFFAIRE.edit', ['affaire'=>$affaire, 'autoritesjudiciaires'=>$autoritesjudiciaires]);
	}
	public function show($id){
		return view('AFFAIRE.show', ['id'=>$id]);
    }
    public function update(affaireRequest $request, $id){

		$affaire = Affaire::find($id);
		$this->authorize('update', $affaire);
		$affaire->numero_affaire = $request->input('numero_affaire');
		$affaire->presentation = $request->input('presentation');
    	//$affaire->type = $request->input('type');
    	$affaire->frais_affaire = $request->input('frais_affaire');
		//$affaire->resultat = $request->input('resultat');
		$affaire->autoritesjudiciaire_id = $request->input('autoritesjudiciaire_id');
		$affaire->save();
		session()->flash('success', 'l\'Affaire a été bien modifiée!');

		return redirect('affaires');

    }
    public function destroy(Request $request, $id){
			$affaire = Affaire::find($id);
		$this->authorize('delete', $affaire);
		$affaire->delete();
		
		return redirect('affaires');
	}
	
	public function getClients($id){
		$affaire = Affaire::find($id);
		return $affaire->clients;
	}

	public function getData($id){
		$affaire = Affaire::find($id);
		//Affaire::where('user_id', Auth::id())->get()
		$clients = $affaire->clients()->where('is_adversaire', 0)->get();
		$adversaires = $affaire->clients()->where('is_adversaire', 1)->get();
		$seances = $affaire->seances;
		$decisions = $affaire->decisions;
		$frais = $affaire->frais;
		//$adversaires = $affaire->clients;
		return Response()->json([
			'clients' => $clients,
			'adversaires' => $adversaires,
			'seances' => $seances,
			'decisions' => $decisions,
			'frais' => $frais,
			'frais_affaire' =>$affaire->frais_affaire
		]);
	}

	public function addClient(Request $request){
		$client = new Client;
		$client->affaire_id = $request->affaire_id;
		$client->is_adversaire = 0;
		$client->is_moral = $request->is_moral;
		$client->first_name = $request->first_name;
		$client->last_name = $request->last_name;
		$client->birthday = $request->birthday;
		$client->type_id = $request->type_id;
		$client->domicile = $request->domicile;
		$client->father_name = $request->father_name;
		$client->mother_first_name = $request->mother_first_name;
		$client->mother_last_name = $request->mother_last_name;
		$client->moral_person_name = $request->moral_person_name;
		$client->moral_person_description = $request->moral_person_description;

		$client->save();
		return Response()->json(['etat' => true, 'id'=>$client->id]);
	}
	public function updateClient(Request $request){
		$client = Client::find($request->id);
		$client->affaire_id = $request->affaire_id;
		$client->is_adversaire = 0;
		$client->is_moral = $request->is_moral;
		$client->first_name = $request->first_name;
		$client->last_name = $request->last_name;
		$client->birthday = $request->birthday;
		$client->type_id = $request->type_id;
		$client->domicile = $request->domicile;
		$client->father_name = $request->father_name;
		$client->mother_first_name = $request->mother_first_name;
		$client->mother_last_name = $request->mother_last_name;
		$client->moral_person_name = $request->moral_person_name;
		$client->moral_person_description = $request->moral_person_description;

		$client->save();
		return Response()->json(['etat' => true]);
	}
	public function deleteClient($id){
		$client = Client::find($id);
		$client->delete();
		return Response()->json(['etat' => true]);
	}

// adversaires

public function addAdversaire(Request $request){
	$adversaire = new Client;
	$adversaire->affaire_id = $request->affaire_id;
	$adversaire->is_adversaire = 1;
	$adversaire->is_moral = $request->is_moral;
	$adversaire->first_name = $request->first_name;
	$adversaire->last_name = $request->last_name;
	$adversaire->birthday = $request->birthday;
	$adversaire->type_id = $request->type_id;
	$adversaire->domicile = $request->domicile;
	$adversaire->father_name = $request->father_name;
	$adversaire->mother_first_name = $request->mother_first_name;
	$adversaire->mother_last_name = $request->mother_last_name;
	$adversaire->moral_person_name = $request->moral_person_name;
	$adversaire->moral_person_description = $request->moral_person_description;

	$adversaire->save();
	return Response()->json(['etat' => true, 'id'=>$adversaire->id]);
}
public function updateAdversaire(Request $request){
	$adversaire = Client::find($request->id);
	$adversaire->affaire_id = $request->affaire_id;
	$adversaire->is_adversaire = 1;
	$adversaire->is_moral = $request->is_moral;
	$adversaire->first_name = $request->first_name;
	$adversaire->last_name = $request->last_name;
	$adversaire->birthday = $request->birthday;
	$adversaire->type_id = $request->type_id;
	$adversaire->domicile = $request->domicile;
	$adversaire->father_name = $request->father_name;
	$adversaire->mother_first_name = $request->mother_first_name;
	$adversaire->mother_last_name = $request->mother_last_name;
	$adversaire->moral_person_name = $request->moral_person_name;
	$adversaire->moral_person_description = $request->moral_person_description;

	$adversaire->save();
	return Response()->json(['etat' => true]);
}
public function deleteAdversaire($id){
	$adversaire = Client::find($id);
	$adversaire->delete();
	return Response()->json(['etat' => true]);
}

public function addSeance(Request $request){
	$seance = new Seance;
	$seance->affaire_id = $request->affaire_id;
	$seance->subject = $request->subject;
	$seance->content = $request->content;
	$seance->date_seance = $request->date_seance;
	//$seance->lieu = $request->lieu;

	$seance->save();
	return Response()->json(['etat' => true, 'id'=>$seance->id]);
}
public function updateSeance(Request $request){
	$seance = Seance::find($request->id);
	$seance->affaire_id = $request->affaire_id;
	$seance->subject = $request->subject;
	$seance->content = $request->content;
	$seance->date_seance = $request->date_seance;
	//$seance->lieu = $request->lieu;

	$seance->save();
	return Response()->json(['etat' => true]);
}
public function deleteSeance($id){
	$seance = Seance::find($id);
	$seance->delete();
	return Response()->json(['etat' => true]);
}

public function addDecision(Request $request){
	$decision = new Decision;
	$decision->affaire_id = $request->affaire_id;
	$decision->date_decision = $request->date_decision;
	//$decision->decision = $request->decision;
	$decision->summary = $request->summary;
	//$decision->authority = $request->authority;
	//$decision->location1 = $request->location1;
	//$decision->location2 = $request->location2;
	//$decision->type = $request->type;
	//$decision->date_recours = date("Y-m-d", strtotime($request->date_decision. " + 15 day"));
	$decision->save();
	return Response()->json(['etat' => true, 'id'=>$decision->id]);
}
public function updateDecision(Request $request){
	$decision = Decision::find($request->id);

	$decision->affaire_id = $request->affaire_id;
	$decision->date_decision = $request->date_decision;
	$decision->decision = $request->decision;
	$decision->summary = $request->summary;
	$decision->authority = $request->authority;
	//$decision->location1 = $request->location1;
	//$decision->location2 = $request->location2;
	$decision->type = $request->type;

	$decision->save();
	return Response()->json(['etat' => true]);
}
public function deleteDecision($id){
	$decision = Decision::find($id);
	$decision->delete();
	return Response()->json(['etat' => true]);
}

public function addFrai(Request $request){
	$frai = new Frai;
	$frai->affaire_id = $request->affaire_id;
	$frai->montant_total = $request->montant_total;
	$frai->versement = $request->versement;
	$frai->date_versement = date("Y-m-d");
	//$frai->reste = $request->reste_a_payer - $request->versement;

	$frai->save();
	return Response()->json(['etat' => true, 'id'=>$frai->id, 'date_versement'=>$frai->date_versement]);
}
public function updateFrai(Request $request){
	$frai = Frai::find($request->id);

	$frai->affaire_id = $request->affaire_id;
	$frai->montant_total = $request->montant_total;
	$frai->versement = $request->versement;
	$frai->date_versement = $request->date_versement;
	//$frai->reste = $request->reste;

	$frai->save();
	return Response()->json(['etat' => true]);
}
public function deleteFrai($id){
	$frai = Frai::find($id);
	$frai->delete();
	return Response()->json(['etat' => true]);
}

/*public function rendez_vous(){
	$listaffaire = DB::table('affaires')
			->join('decisions', 'affaires.id', '=', 'decisions.affaire_id')
			->select('affaires.*', 'decisions.date_decision', 'decisions.type', 'decisions.decision', 'decisions.summary', 'decisions.authority', 'decisions.date_recours')
			->get();
			//$listdecision = Decision::where('date_recours', '>', date("Y-m-d"))->get();
	//dd($listdecision);
	//foreach ($listaffaire as $affaire){
	//session()->flash('rendez_vous', $affaire->numero_affaire. ' dernier délai de recours le '. $affaire->date_recours);
//}
	return view('AFFAIRE.rendez_vous', ['affaires'=>$listaffaire]);
}
*/
/*public function rendez_vous(){
	$listaffaire = DB::table('affaires')
			->join('seances', 'affaires.id', '=', 'seances.affaire_id')
			->select('affaires.*', 'seances.date_seance', 'seances.subject', 'seances.content')
			->where('seances.date_seance', '>', date("Y-m-d"))
			->get();
	return view('AFFAIRE.rendez_vous', ['affaires'=>$listaffaire]);
}*/

public function rendez_vous(){
	$seances = Seance::where('date_seance', '>', date("Y-m-d"))
			->get();
			/*$listaffaire = Affaire::whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])
			->get();*/
	return view('AFFAIRE.rendez_vous', ['seances'=>$seances]);
}

public function rendez_vouss(){

	$seances = Auth::user()->affaires()
	->leftJoin('seances', 'affaires.id', '=', 'seances.affaire_id')
			->select('affaires.numero_affaire', 'seances.date_seance', 'seances.subject', 'seances.affaire_id', 'seances.calendar')
			->where('date_seance', '>', date("Y-m-d"))
			->get();
	/*if ($seances->count()){
	foreach ($seances as $seance) {
		if($seance->calendar != '1'){
				$startDate = Carbon::parse($seance->date_seance);
				$endDate = (clone $startDate)->addDay();

				Event::create([
					'name' => $seance->subject,
					'startDate' => $startDate,
					'endDate' => $endDate
					]);
			}}
//composer require nesbot/carbon
//composer dump-autoload
/*$event = new Event;
$event->name = 'conciliation';
$event->description = 'Event description';
$event->startDateTime = Carbon::now();
$event->endDateTime = Carbon::now()->addHour();

$event->save();

$e = Event::get();
	dd($e);*/
	//return view('AFFAIRE.rendez_vous', ['seances'=>$seances]);
//}*/
	return view('AFFAIRE.rendez_vous', ['seances'=>$seances]);
}


public function creances(Request $request){
	if ($request->input('date_debut') != '' && $request->input('date_fin') != ''){
	$creances = DB::table('affaires')
	->leftJoin('frais', 'affaires.id', '=', 'frais.affaire_id')
			->leftJoin('decisions', 'affaires.id', '=', 'decisions.affaire_id')
			->select('affaires.numero_affaire', 'affaires.frais_affaire', 'decisions.date_decision', DB::raw('SUM(frais.versement) as total_versement'))
			->whereBetween('decisions.date_decision', [$request->input('date_debut'), $request->input('date_fin')])
			->groupBy('affaires.id', 'decisions.id')
			->get();
	return view('AFFAIRE.creances', ['creances'=>$creances]);
	}
	else{
		return view('AFFAIRE.creances');
	}
}

}
