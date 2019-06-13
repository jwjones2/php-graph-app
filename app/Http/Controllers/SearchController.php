<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searches = Search::all();
        return view('search.index')->with('searches', $searches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('search.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:searches|max:255',
            'description' => 'required'
        ]);

        $search = new Search();
        $search->name = request('name');
        $search->description = request('description');
        $search->query = request('query');
        $search->title = request('title');
        $search->params = '';
        $search->save();

        // redirect to groups page with success message
        return redirect('/searches')->with('success', 'The Query was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $search = Search::find($id);
        return view('search.show')->with('search', $search);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $search = Search::find($id);
        return view('search.edit')->with('search', $search);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required|unique:searches|max:255',
                Rule::unique('searches')->ignore($id),
            ],
            'description' => 'required',
            'query' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('searches/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $search = Search::find($id);
        $search->name = request('name');
        $search->description = request('description');
        $search->query = request('query');
        $search->title = request('title');
        $search->params = '';
        $search->save();

        // redirect to groups page with success message
        return redirect('/searches')->with('success', 'The Query was edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $search = Search::find($id);
        $search->delete();

        return redirect('/searches')->with('success', 'The Query was deleted.');
    }
}
