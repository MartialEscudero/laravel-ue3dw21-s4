<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Membre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Description;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControleurMembres extends Controller
{

  public function identite() {
    if (Auth::check())
    {
      $utilisateur = Auth::user();
      $id = Auth::id();
      return view('pages_site/identite',compact('utilisateur','id'));
    }
    else
      echo "<h1>Accès non autorisé</h1>";
    }
    public function acces_protege() {
      $infos_utilisateur = Auth::user();
      $utilisateur = $infos_utilisateur->name;
      echo "<h1>Utilisateur authentifié : ".$utilisateur."</h1>";
  }

  // des variables
  protected $les_membres;
  protected $soumissions;

  public function __construct(Membre $membres,User $users,Description $description,Request $requetes) {
    $this->les_membres = $membres;
    $this->soumissions = $requetes;
    $this->les_description = $description;
    $this->users = $users;
  }

  public function index() {
    $les_membres = $this->les_membres->all();
    return view('pages_site/consultation_edition', compact('les_membres'));
  }

  public function afficher($numero) {
    try {
      $un_membre = membre::findOrFail($numero);
      $membre_description = description::findOrFail($numero);
      return view('pages_site/membre', compact('un_membre', 'membre_description'));
    } catch(ModelNotFoundException $e) {
      return view('pages_site/erreur');
    }
  }

  public function creer() {
    return view('pages_site/creation');
  }

  public function enregistrer(Request $request) {
    $membre = new membre();
    $membre->nom = $request->nom;
    $membre->adresse = $request->adresse;
    $membre->prenom = $request->prenom;
    $membre->save();
    return view('pages_site/retour_creation');
  }

  public function editer($numero) {
    $un_membre = $this->les_membres->find($numero);
    $membre_description = $this->les_description->find($numero);
    if (isset($un_membre)) {
      return view('pages_site/edition', compact('un_membre'));
    } else {
      return view('pages_site/erreur');
    }
  }

  public function miseAJour($numero) {
    $un_membre = $this->les_membres->find($numero);
    $la_soumission = $this->soumissions;
    $un_membre->nom =$la_soumission->nom;
    $un_membre->prenom =$la_soumission->prenom;
    $un_membre->adresse =$la_soumission->adresse;
    $un_membre->save();
    return view('pages_site/retour_edition');
  }

  public function admin() {
    $users = $this->users->all();
    return view('pages_site/admin', compact('users'));
  }
  
}