<?php

namespace App\Http\Controllers;

use App\Models\People;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::all();
        return view('pages.people', ['peoples' => $peoples]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'nim' => 'required|size:10|unique:people,nim',
                'address' => 'required'
            ],
            [
                'name.required' => 'Nama Tidak Boleh Kosong.',
            ]
        );

        // People::create($request->all());

        // return redirect('people')->with('status', 'Add ' . $request->name . ' Successfully');

        DB::beginTransaction();
        try {
            People::create($request->all());
            DB::commit();
            return redirect('people')->with('status', 'Add ' . $request->name . ' Successfully');
        } catch (Error $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        // Jika ingin menampilkan detail basic(pindah halaman)
        return view('pages.show', compact('people'));

        // Jika ingin menampilkan Detail menggunakan Modal
        // dd($people);
        // return view('pages.people', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        return view('pages.update', compact('people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|size:10',
            'address' => 'required'
        ]);

        // People::where('id', $people->id)->update([
        //     'name' => $request->name,
        //     'nim' => $request->nim,
        //     'address' => $request->address
        // ]);

        // return redirect('/people')->with('status', 'Edit ' . $people->name . ' Succesfully');
        DB::beginTransaction();
        try {
            People::where('id', $people->id)->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'address' => $request->address
            ]);
            DB::commit();
            return redirect('/people')->with('status', 'Edit ' . $people->name . ' Succesfully');
        } catch (Error $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        // People::destroy($people->id);

        // return redirect('/people')->with('status', 'Delete People Succesfully');

        $mhs = People::find($people->id);
        // dd($mhs->name);
        DB::beginTransaction();
        try {
            $mhs->delete();
            DB::commit();
            return redirect('/people')->with('status', 'Delete ' . $mhs->name . ' Succesfully');
        } catch (Error $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
