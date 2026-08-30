<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Socle commun aux ressources du dashboard.
 *
 * Les trois ressources gérées — compétences, expériences, formations —
 * partagent le même cycle CRUD et ne different que par leur modèle, leurs
 * vues et leurs messages. Les classes filles se limitent donc à décrire ces
 * différences, et à exposer store() et update() avec leur FormRequest propre :
 * Laravel résout la validation d'après le type déclaré, qui ne peut donc pas
 * être factorisé ici.
 */
abstract class ResourceController extends Controller
{
    /**
     * Modèle Eloquent manipulé par la ressource.
     *
     * @return class-string<Model>
     */
    abstract protected function model(): string;

    /**
     * Préfixe commun aux vues et aux routes, par exemple "dashboard.skill".
     */
    abstract protected function prefix(): string;

    /**
     * Nom de la variable attendue par les vues, au singulier puis au pluriel.
     *
     * @return array{0: string, 1: string}
     */
    abstract protected function variables(): array;

    /**
     * Messages de confirmation, indexés par action.
     *
     * @return array{created: string, updated: string, deleted: string}
     */
    abstract protected function messages(): array;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        [, $pluriel] = $this->variables();

        return view($this->prefix().'.index', [
            $pluriel => $this->model()::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        [$singulier] = $this->variables();
        $modele = $this->model();

        return view($this->prefix().'.form', [
            $singulier => new $modele,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        [$singulier] = $this->variables();

        return view($this->prefix().'.form', [
            $singulier => $this->model()::findOrFail($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->model()::findOrFail($id)->delete();

        return $this->confirmer('deleted');
    }

    /**
     * Crée la ressource, ou met à jour celle désignée par $id.
     *
     * @param  array<string, mixed>  $donnees
     */
    protected function enregistrer(array $donnees, ?string $id = null): RedirectResponse
    {
        if ($id === null) {
            $this->model()::create($donnees);

            return $this->confirmer('created');
        }

        $this->model()::findOrFail($id)->update($donnees);

        return $this->confirmer('updated');
    }

    /**
     * Retourne à la liste en signalant l'action accomplie.
     */
    protected function confirmer(string $action): RedirectResponse
    {
        return redirect()
            ->route($this->prefix().'.index')
            ->with('success', $this->messages()[$action]);
    }
}
