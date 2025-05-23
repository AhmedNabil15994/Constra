<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentServiceRepository;
use App\Repositories\ServiceCrudRepository;
use App\Transformers\ServiceResource;

class ServiceController extends Controller {

    protected $serviceRepo;
    protected $serviceCrud;
    protected $errors;

    public function __construct(EloquentServiceRepository $serviceRepo ,ServiceCrudRepository  $serviceCrud) {
        $this->serviceRepo = $serviceRepo;
        $this->serviceCrud = $serviceCrud;
    }

    public function index(Request $request) {
        $designElems = $this->serviceCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Services = $this->serviceRepo->dataList($request);
            return Datatables::of(ServiceResource::collection($Services))->make(true);
        }
        $Services = $this->serviceRepo->getAll($request);
        return view('Service::index', compact('Services','designElems'));
    }

    public function create() {
        $designElems = $this->serviceCrud->getSpecificData(['main','add']);
        return view('Service::create' , compact('designElems'));
    }

    public function store(Request $request) {
        $service = $this->serviceRepo->create($request);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $service = $this->serviceRepo->getById($id);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->serviceCrud->getSpecificData(['main','edit']);
        return view('Service::edit', compact('service','designElems'));
    }

    public function update(Request $request, $id) {
        $service = $this->serviceRepo->update($request,$id);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $service = $this->serviceRepo->delete($id);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $service = $this->serviceRepo->restoreSoftDelte($id);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $service = $this->serviceRepo->quickEdit($request);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $service = $this->serviceRepo->deleteManyById($request);
        if(!$service){
            \Session::flash('error',$this->serviceRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
