<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\RoleCrudRepository;
use App\Transformers\RoleResource;

class RoleController extends Controller {

    protected $roleRepo;
    protected $roleCrud;
    protected $errors;

    public function __construct(EloquentRoleRepository $roleRepo ,RoleCrudRepository  $roleCrud) {
        $this->roleRepo = $roleRepo;
        $this->roleCrud = $roleCrud;
    }

    public function index(Request $request) {
        $designElems = $this->roleCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Roles = $this->roleRepo->dataList($request);
            return Datatables::of(RoleResource::collection($Roles))->make(true);
        }
        $Roles = $this->roleRepo->getAll($request);
        return view('Role::index', compact('Roles','designElems'));
    }

    public function create() {
        $designElems = $this->roleCrud->getSpecificData(['main','add']);
        $permissions = \Helper::getPermissions();
        return view('Role::create' , compact('designElems','permissions'));
    }

    public function store(Request $request) {
        $role = $this->roleRepo->create($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $role = $this->roleRepo->getById($id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->roleCrud->getSpecificData(['main','edit']);
        $permissions = \Helper::getPermissions();
        return view('Role::edit', compact('role','designElems','permissions'));
    }

    public function update(Request $request, $id) {
        $role = $this->roleRepo->update($request,$id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $role = $this->roleRepo->delete($id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $role = $this->roleRepo->restoreSoftDelte($id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $role = $this->roleRepo->quickEdit($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $role = $this->roleRepo->deleteManyById($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
