<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\EloquentUserRepository;
use App\Repositories\UserCrudRepository;
use Illuminate\Http\Request;
use URL;

class SettingController extends Controller{
    protected $mainData;

    public function __construct() {
        $this->site_settings = [
            'title' => trans('Dashboard::dashboard.site_settings'),
            'url' => 'dashboard/'.'settings',
            'name' => 'settings',
            'nameOne' => '',
            'modelName' => '',
            'icon' => ' fas fa-cogs',
            'sortName' => '',
            'addOne' => '',
        ];
    }

	public function index()
	{
        $designElems['mainData'] = $this->site_settings;
        $data = config('modules.site_configs');

		return view('Dashboard::site_settings',compact('designElems','data'));
	}

	public function updateSiteSettings(Request $request) {
		$input = $request->all();
        $newData = config('modules.site_configs');
        if($request->hasFile('app_logo')){
            $app_logo = \FilesHelper::uploadFile('settings',$request->file('app_logo'),1);
            $newData['app_logo'] = '/uploads/settings/1/'. $app_logo;
        }
        if($request->hasFile('app_favicon')){
            $app_favicon = \FilesHelper::uploadFile('settings',$request->file('app_favicon'),2);
            $newData['app_favicon'] = '/uploads/settings/2/'. $app_favicon;
        }
        if($request->hasFile('default_upload_img')){
            $default_upload_img = \FilesHelper::uploadFile('settings',$request->file('default_upload_img'),3);
            $newData['default_upload_img'] = '/uploads/settings/3/'. $default_upload_img;
        }
        if(isset($input['app_name_ar']) && !empty($input['app_name_ar'])){
            $newData['app_name_ar'] = (string)$input['app_name_ar'];
        }
        if(isset($input['app_name_en']) && !empty($input['app_name_en'])){
            $newData['app_name_en'] = (string)$input['app_name_en'];
        }
        if(isset($input['app_desc_ar']) && !empty($input['app_desc_ar'])){
            $newData['app_desc_ar'] = $input['app_desc_ar'];
        }
        if(isset($input['app_desc_en']) && !empty($input['app_desc_en'])){
            $newData['app_desc_en'] = $input['app_desc_en'];
        }
        if(isset($input['limitted_size']) && !empty($input['limitted_size'])){
            $newData['limitted_size'] = (int)$input['limitted_size'];
        }
        if(isset($input['pagination']) && !empty($input['pagination'])){
            $newData['pagination'] = (int)$input['pagination'];
        }

        \Helper::updateConfigFile('modules','site_configs',$newData);

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back()->withInput();
    }

    public function general(){
        $data = config('modules.general_configs');
        $designElems['mainData'] = $this->site_settings;
        $designElems['mainData']['title'] = trans('Dashboard::dashboard.general_settings');
        $designElems['mainData']['url'] = 'dashboard/'.'settings/general';
        return view('Dashboard::general_settings',compact('designElems','data'));
    }

    public function updateGeneralSettings(Request $request){
        $input = $request->all();
        $newData = config('modules.general_configs');
        if(isset($input['phone']) && !empty($input['phone'])){
            $newData['phone'] = (string)$input['phone'];
        }
        if(isset($input['email']) && !empty($input['email'])){
            $newData['email'] = (string)$input['email'];
        }
        if(isset($input['location']) && !empty($input['location'])){
            $newData['location'] = $input['location'];
        }
        if(isset($input['sender_email']) && !empty($input['sender_email'])){
            $newData['sender_email'] = $input['sender_email'];
        }
        if(isset($input['sender_name']) && !empty($input['sender_name'])){
            $newData['sender_name'] = $input['sender_name'];
        }
        $newData['enable_emails'] = isset($input['enable_emails']) ? $input['enable_emails'] : 0;
        
        \Helper::updateConfigFile('modules','general_configs',$newData);

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back()->withInput();
    }
}