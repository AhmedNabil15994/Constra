<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCompanyCategoryRepository;
use App\Repositories\CompanyCategoryCrudRepository;
use App\Transformers\CompanyCategoryResource;
use App\Entities\CompanyCategory;

class CompanyCategoryController extends Controller {

    protected $categoryRepo;
    protected $categoryCrud;
    protected $errors;

    public function __construct(EloquentCompanyCategoryRepository $categoryRepo ,CompanyCategoryCrudRepository  $categoryCrud) {
        $this->categoryRepo = $categoryRepo;
        $this->categoryCrud = $categoryCrud;
    }

    public function index(Request $request) {
        $designElems = $this->categoryCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Categories = $this->categoryRepo->dataList($request);
            return Datatables::of(CompanyCategoryResource::collection($Categories))->make(true);
        }
        $Categories = $this->categoryRepo->getAll($request);
        return view('CompanyCategory::index', compact('Categories','designElems'));
    }

    public function create() {
        $designElems = $this->categoryCrud->getSpecificData(['main','add']);
        $parents = CompanyCategory::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('CompanyCategory::create' , compact('designElems','parents'));
    }

    public function store(Request $request) {
        $category = $this->categoryRepo->create($request);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $category = $this->categoryRepo->getById($id);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->categoryCrud->getSpecificData(['main','edit']);
        $parents = CompanyCategory::where([
            ['status',1],
            ['id','!=',$id]
        ])->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('CompanyCategory::edit', compact('category','designElems','parents'));
    }

    public function update(Request $request, $id) {
        $category = $this->categoryRepo->update($request,$id);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $category = $this->categoryRepo->delete($id);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $category = $this->categoryRepo->restoreSoftDelte($id);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $category = $this->categoryRepo->quickEdit($request);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $category = $this->categoryRepo->deleteManyById($request);
        if(!$category){
            \Session::flash('error',$this->categoryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
}
