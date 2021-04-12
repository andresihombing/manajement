<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Saya';
        $user = User::all();
        return view('user.index',compact('user','title'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $gambar = $request->file('gambar');
        if($gambar != '')
        {
            $request->validate([
                'name'      =>  'required',
                'email'     =>  'required',
                'gambar'    =>  'image|max:2048',
                'alamat'    =>  'required',
                'no_telp'   => 'required'
            ]);
            $image_name = rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $image_name);
        }
        else
        {
            $request->validate([
                'name'      =>  'required',
                'email'     =>  'required',
                'alamat'    =>  'required',
                'no_telp'   => 'required'
            ]);
        }

        $form_data = array(
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'gambar'    =>  $image_name,
            'alamat'    =>  $request->alamat,
            'no_telp'   =>  $request->no_telp
        );


        User::whereId($id)->update($form_data);
        return redirect('/user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
