<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentSliderRepository;
use App\Repositories\SliderCrudRepository;
use App\Transformers\SliderResource;
use App\Entities\Page;

class SliderController extends Controller {

    protected $sliderRepo;
    protected $sliderCrud;
    protected $errors;

    public function __construct(EloquentSliderRepository $sliderRepo ,SliderCrudRepository  $sliderCrud) {
        $this->sliderRepo = $sliderRepo;
        $this->sliderCrud = $sliderCrud;
    }

    public function index(Request $request) {
        $designElems = $this->sliderCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Sliders = $this->sliderRepo->dataList($request);
            return Datatables::of(SliderResource::collection($Sliders))->make(true);
        }
        $Sliders = $this->sliderRepo->getAll($request);
        return view('Slider::index', compact('Sliders','designElems'));
    }

    public function create() {
        $designElems = $this->sliderCrud->getSpecificData(['main','add']);
        $pages = Page::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Slider::create' , compact('designElems','pages'));
    }

    public function store(Request $request) {
        $slider = $this->sliderRepo->create($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $slider = $this->sliderRepo->getById($id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->sliderCrud->getSpecificData(['main','edit']);
        $pages = Page::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Slider::edit', compact('slider','designElems','pages'));
    }

    public function update(Request $request, $id) {
        $slider = $this->sliderRepo->update($request,$id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $slider = $this->sliderRepo->delete($id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $slider = $this->sliderRepo->restoreSoftDelte($id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $slider = $this->sliderRepo->quickEdit($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $slider = $this->sliderRepo->deleteManyById($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
