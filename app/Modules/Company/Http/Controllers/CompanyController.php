<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCompanyRepository;
use App\Repositories\CompanyCrudRepository;
use App\Transformers\CompanyResource;
use App\Entities\CompanyCategory;

class CompanyController extends Controller {

    protected $companyRepo;
    protected $companyCrud;
    protected $errors;

    public function __construct(EloquentCompanyRepository $companyRepo ,CompanyCrudRepository  $companyCrud) {
        $this->companyRepo = $companyRepo;
        $this->companyCrud = $companyCrud;
    }

    public function index(Request $request) {
        $designElems = $this->companyCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Companies = $this->companyRepo->dataList($request);
            return Datatables::of(CompanyResource::collection($Companies))->make(true);
        }
        $Companies = $this->companyRepo->getAll($request);
        return view('Company::index', compact('Companies','designElems'));
    }

    public function create() {
        $designElems = $this->companyCrud->getSpecificData(['main','add']);
        $categories = CompanyCategory::where([
            ['status',1],
        ])->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Company::create' , compact('designElems','categories'));
    }

    public function store(Request $request) {
        $company = $this->companyRepo->create($request);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $company = $this->companyRepo->getById($id);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->companyCrud->getSpecificData(['main','edit']);
        $categories = CompanyCategory::where([
            ['status',1],
        ])->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Company::edit', compact('company','designElems','categories'));
    }

    public function update(Request $request, $id) {
        $company = $this->companyRepo->update($request,$id);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $company = $this->companyRepo->delete($id);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $company = $this->companyRepo->restoreSoftDelte($id);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $company = $this->companyRepo->quickEdit($request);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $company = $this->companyRepo->deleteManyById($request);
        if(!$company){
            \Session::flash('error',$this->companyRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
