<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereNotIn('name' , ['admin' , 'super_admin' , 'user'])->get();
        return view('admin.admins.index' , compact('roles'));
    }


    public function data(){
        $query = User::whereRoleIs('admin')->whenHasRole(request()->role_id);

    return  DataTables::of($query)
        ->addColumn('record_select', 'admin.admins.data_table.record_select')
        ->editColumn('created_at', function (User $user) {
            return $user->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.admins.data_table.actions')
        ->addColumn('roles' , function(User $admin){
            return view('admin.admins.data_table.roles', compact('admin'));
        })
        ->rawColumns(['record_select', 'actions' , 'roles'])
        ->toJson();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name' , ['admin' , 'super_admin' , 'user'])->get();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
         $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);
        $admin = User::create($request->all());
        $admin->attachRoles(['admin', $request->role_id]);
        session()->flash('success', __('site.added_successfully'));
        return Redirect()->route('admin.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::whereNotIn('name' , ['admin' , 'super_admin' , 'user'])->get();
        $user = User::find($id);
        return view('admin.admins.edit' , compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        // return $request;
        $admin = User::find($id);
        $admin->update($request->validated());
        $admin->syncRoles(['admin', $request->role_id]);
        session()->flash('success', __('site.added_successfully'));
        return Redirect()->route('admin.admin.index');
    }

    public function destroy(User $admin)
    {
        $this->delete($admin);
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admin.admin.index');

    }// end of destroy



    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admin = User::FindOrFail($recordId);
            $this->delete($admin);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }// end of bulkDelete

    private function delete(User $admin)
    {
        $admin->delete();
    }// end of delete

}
