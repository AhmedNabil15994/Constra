<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentPageRepository;
use App\Repositories\PageCrudRepository;
use App\Transformers\PageResource;

class PageController extends Controller {

    protected $pageRepo;
    protected $pageCrud;
    protected $errors;

    public function __construct(EloquentPageRepository $pageRepo ,PageCrudRepository  $pageCrud) {
        $this->pageRepo = $pageRepo;
        $this->pageCrud = $pageCrud;
    }

    public function index(Request $request) {
        $designElems = $this->pageCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Pages = $this->pageRepo->dataList($request);
            return Datatables::of(PageResource::collection($Pages))->make(true);
        }
        $Pages = $this->pageRepo->getAll($request);
        return view('Page::index', compact('Pages','designElems'));
    }

    public function create() {
        $designElems = $this->pageCrud->getSpecificData(['main','add']);
        return view('Page::create' , compact('designElems'));
    }

    public function store(Request $request) {
        $page = $this->pageRepo->create($request);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $page = $this->pageRepo->getById($id);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->pageCrud->getSpecificData(['main','edit']);
        return view('Page::edit', compact('page','designElems'));
    }

    public function update(Request $request, $id) {
        $page = $this->pageRepo->update($request,$id);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $page = $this->pageRepo->delete($id);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $page = $this->pageRepo->restoreSoftDelte($id);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $page = $this->pageRepo->quickEdit($request);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $page = $this->pageRepo->deleteManyById($request);
        if(!$page){
            \Session::flash('error',$this->pageRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
