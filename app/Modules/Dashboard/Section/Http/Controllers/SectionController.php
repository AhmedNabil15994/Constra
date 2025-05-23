<?php

namespace App\Modules\Dashboard\Section\Http\Controllers;

use App\Entities\Page;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Section\Repositories\EloquentSectionRepository;
use App\Modules\Dashboard\Section\Repositories\SectionCrudRepository;
use App\Modules\Dashboard\Section\Transformers\SectionResource;
use DataTables;
use Illuminate\Http\Request;

class SectionController extends Controller {

    protected $sectionRepo;
    protected $sectionCrud;
    protected $errors;

    public function __construct(EloquentSectionRepository $sectionRepo ,SectionCrudRepository  $sectionCrud) {
        $this->sectionRepo = $sectionRepo;
        $this->sectionCrud = $sectionCrud;
    }

    public function index(Request $request) {
        $designElems = $this->sectionCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Sections = $this->sectionRepo->dataList($request);
            return Datatables::of(SectionResource::collection($Sections))->make(true);
        }
        $Sections = $this->sectionRepo->getAll($request);
        return view('Section::index', compact('Sections','designElems'));
    }

    public function create() {
        $designElems = $this->sectionCrud->getSpecificData(['main','add']);
        $pages = Page::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Section::create' , compact('designElems','pages'));
    }

    public function store(Request $request) {
        $section = $this->sectionRepo->create($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $section = $this->sectionRepo->getById($id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->sectionCrud->getSpecificData(['main','edit']);
        $pages = Page::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Section::edit', compact('section','designElems','pages'));
    }

    public function update(Request $request, $id) {
        $section = $this->sectionRepo->update($request,$id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $section = $this->sectionRepo->delete($id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $section = $this->sectionRepo->restoreSoftDelte($id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $section = $this->sectionRepo->quickEdit($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $section = $this->sectionRepo->deleteManyById($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
