<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentOrderRepository;
use App\Repositories\OrderCrudRepository;
use App\Transformers\OrderResource;
use App\Entities\Service;

class OrderController extends Controller {

    protected $orderRepo;
    protected $orderCrud;
    protected $errors;

    public function __construct(EloquentOrderRepository $orderRepo ,OrderCrudRepository  $orderCrud) {
        $this->orderRepo = $orderRepo;
        $this->orderCrud = $orderCrud;
    }

    public function index(Request $request) {
        $designElems = $this->orderCrud->getSpecificData(['all']);
        if($request->ajax()){
            $Orders = $this->orderRepo->dataList($request);
            return Datatables::of(OrderResource::collection($Orders))->make(true);
        }
        $Orders = $this->orderRepo->getAll($request);
        return view('Order::index', compact('Orders','designElems'));
    }

    public function create() {
        $designElems = $this->orderCrud->getSpecificData(['main','add']);
        $services = Service::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Order::create' , compact('designElems','services'));
    }

    public function store(Request $request) {
        $order = $this->orderRepo->create($request);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $order = $this->orderRepo->getById($id);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors);
            return redirect()->back()->withInput();
        }
        $designElems = $this->orderCrud->getSpecificData(['main','edit']);
        $services = Service::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as name"]);
        return view('Order::edit', compact('order','designElems','services'));
    }

    public function update(Request $request, $id) {
        $order = $this->orderRepo->update($request,$id);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $order = $this->orderRepo->delete($id);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $order = $this->orderRepo->restoreSoftDelte($id);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $order = $this->orderRepo->quickEdit($request);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $order = $this->orderRepo->deleteManyById($request);
        if(!$order){
            \Session::flash('error',$this->orderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
