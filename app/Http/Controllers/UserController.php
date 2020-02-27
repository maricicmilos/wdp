<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return view('admin.users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.create', compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = request()->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|same:re_password',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required'
        ]);

        if(isset($request->avatar)){

            $image = $request->avatar;
            $image_name = Carbon::now()->timestamp . '_' . $image->getClientOriginalName();

            $inserted = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'avatar' => $image_name,
                'role_id' => $request->role_id
            ]);

            $image->move('images', $image_name);

        } else {

            $input['password'] = bcrypt($request->password);

            $inserted = User::create($input);
        }

        $inserted ? $msg = 'Record succesfully inserted into database' : $msg = 'Error occured';

        return redirect('admin/users')->with('msg', $msg);  

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.users.show', compact(['user'])); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.users.edit', compact(['user', 'roles']));
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
        $data = request()->validate([
            'username' => 'required',
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::findOrFail($request->id);

        if(isset($request->avatar)){

            if($user->avatar != null){
                unlink(public_path() . '\images\\' . $request->cur_avatar);
            }            

            $image = $request->avatar;

            $image_name = Carbon::now()->timestamp . '_' . $image->getClientOriginalName();

            $image->move('images', $image_name);

            $updated = $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'role_id' => $request->role_id,
                'avatar' => $image_name
            ]);
    
        } else {

            $updated = $user->update($data);

        } 

        $updated ? $msg = 'Record succesfully updated' : $msg = 'Error occured';

        return redirect('admin/users')->with('msg', $msg); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        unlink(public_path() . '\images\\' . $user->avatar);

        $deleted  = User::destroy($id);

        $deleted ? $msg = 'Record succesfully deleted' : $msg = 'Error occured';

        return redirect('admin/users')->with('msg', $msg); 
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        unlink(public_path() . '\images\\' . $user->avatar);

        $deleted  = User::destroy($id);

        $deleted ? $msg = 'Record succesfully deleted' : $msg = 'Error occured';

        return redirect('admin/users')->with('msg', $msg);
    }


    /* Show search users form @ /users/search page */

    public function search(){

        return view('admin.users.search');
        
    }

    public function show_search(Request $request){

        $action = $request['action'];

        $input = request()->validate([
            'search_term' => 'required'
        ]);

        $term = $input['search_term'];

        $users = User::where('username', 'like', '%' . $term . '%')
                ->orWhere(function($query) use ($term){
                    $query->orWhere('email', 'like', '%' . $term . '%');
                    $query->orWhere('fname', 'like', '%' . $term . '%');
                    $query->orWhere('lname', 'like', '%' . $term . '%');
                })
                ->get();

        return view('admin.users.search', compact(['users', 'action']));

    }
}
