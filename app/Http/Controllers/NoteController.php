<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkroles:COORDINATOR');
    }

    public function list()
    {
        $coordinator = Auth::user()->coordinator;

        $notes = $coordinator->notes;

        return view('notes.list', [
            'instance' => \Instantiation::instance(),
            'notes' => $notes
            ]);
    }

    public function view($instance,$id)
    {
        $note = Note::findOrFail($id);

        return view('notes.view', [
            'instance' => \Instantiation::instance(),
            'note' => $note
        ]);
    }

    public function create()
    {
        return view('notes.createandedit', [
            'instance' => \Instantiation::instance(),
        ]);
    }

    public function create_p(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:255'
        ]);

        $coordinator = Auth::user()->coordinator;

        Note::create(
            [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'coordinator_id' => $coordinator->id
            ]
        );

        return redirect()->route('note.list',\Instantiation::instance())->with('success', 'Nota creada con éxito');
    }

    public function edit($instance, $id)
    {
        $note = Note::findOrFail($id);

        return view('notes.createandedit', [
            'instance' => \Instantiation::instance(),
            'note' => $note,
            'edit' => true
        ]);
    }

    public function edit_p(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:255'
        ]);

        $note = Note::findOrFail($request->input('note_id'));

        $note->title = $request->input('title');
        $note->body = $request->input('body');

        $note->save();

        return redirect()->route('note.list',\Instantiation::instance())->with('success', 'Nota editada con éxito');
    }

    public function remove(Request $request)
    {
        $note = Note::findOrFail($request->input('note_id'));

        $note->delete();

        return redirect()->route('note.list',\Instantiation::instance())->with('success', 'Nota eliminada con éxito');
    }
}
