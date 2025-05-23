<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentContactUsRepository;
use App\Repositories\ContactUsCrudRepository;
use App\Transformers\ContactUsResource;

class ContactUsController extends Controller {

    protected $contactUsRepo;
    protected $contactUsCrud;
    protected $errors;

    public function __construct(EloquentContactUsRepository $contactUsRepo ,ContactUsCrudRepository  $contactUsCrud) {
        $this->contactUsRepo = $contactUsRepo;
        $this->contactUsCrud = $contactUsCrud;
    }

    public function index(Request $request) {
        $designElems = $this->contactUsCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Contactuses = $this->contactUsRepo->dataList($request);
            return Datatables::of(ContactUsResource::collection($Contactuses))->make(true);
        }
        $Contactuses = $this->contactUsRepo->getAll($request);
        return view('ContactUs::index', compact('Contactuses','designElems'));
    }

    public function create() {
        $designElems = $this->contactUsCrud->getSpecificData(['main','add']);
        return view('ContactUs::create' , compact('designElems'));
    }

    public function store(Request $request) {
        $contactUs = $this->contactUsRepo->create($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $contactUs = $this->contactUsRepo->getById($id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->contactUsCrud->getSpecificData(['main','edit']);
        return view('ContactUs::edit', compact('contactUs','designElems'));
    }

    public function update(Request $request, $id) {
        $contactUs = $this->contactUsRepo->update($request,$id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $contactUs = $this->contactUsRepo->delete($id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $contactUs = $this->contactUsRepo->restoreSoftDelte($id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $contactUs = $this->contactUsRepo->quickEdit($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $contactUs = $this->contactUsRepo->deleteManyById($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
