<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }


    public function data(){
        $query = User::where('type' , 'admin');

    return  DataTables::of($query)
        ->addColumn('record_select', 'admin.users.data_table.record_select')
        ->editColumn('created_at', function (User $user) {
            return $user->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.users.data_table.actions')
        ->rawColumns(['record_select', 'actions'])
        ->toJson();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // return $request;
         $requestData = $request->validated();
        //  return $requestData;
        $requestData['password'] = bcrypt($request->password);
        $admin = User::create($requestData);
        $admin->attachRoles(['user']);
        session()->flash('success', __('site.added_successfully'));
        return Redirect()->route('admin.user.index');
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
        $user = User::find($id);
        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // return $request;
        $admin = User::find($id);
        $admin->update($request->validated());
        // $admin->syncRoles(['ad']);
        session()->flash('success', __('site.added_successfully'));
        return Redirect()->route('admin.user.index');
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
