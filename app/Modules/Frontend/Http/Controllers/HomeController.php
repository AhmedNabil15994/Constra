<?php namespace App\Http\Controllers;

use App\Entities\Blog;
use App\Entities\Category;
use App\Entities\Company;
use App\Entities\CompanyCategory;
use App\Entities\ContactUs;
use App\Entities\Order;
use App\Entities\Page;
use App\Entities\Service;
use App\Entities\Slider;
use App\Modules\Dashboard\Section\Entities\Section;
use Illuminate\Http\Request;

class HomeController extends Controller {

    use \TraitsFunc;

    public function index(){
        $homeSliders = Slider::where([['status',1],['page_id',1],])->get();
        $homeSections = Section::where([['status',1],['page_id',1],])->get();
        $homeBlogs = Blog::where([['status',1],['category_id',null]])->latest()->take(3)->get();
        return view('Frontend::home',compact('homeSliders','homeSections','homeBlogs'));
    }

    public function about(){
        $pages = Page::whereIn('id',[1,2])->where('status',1)->get();
        $sections = Section::where([['status',1],['page_id',2],])->get();
        return view('Frontend::about',compact('pages','sections'));
    }

    public function categories(){
        $pages = Page::whereIn('id',[1,4])->where('status',1)->get();
        $categories = CompanyCategory::where('status',1)->get();
        return view('Frontend::categories',compact('categories','pages'));
    }

    public function companies($id){
        $id = (int) $id;
        $category = Category::where('status',1)->findOrFail($id);
        if(!$category){
            return redirect(404);
        }

        $companies = Company::where([['status',1],['category_id',$id]])->paginate(config('modules.site_configs.pagination'));
        $pages = Page::whereIn('id',[1,4])->where('status',1)->get();
        $data['data'] = $companies;
        $data['pagination'] = \Helper::generatePagination($companies);
        $data = (object) $data;
        return view('Frontend::companies',compact('pages','category','data'));
    }

    public function company_details($id){
        $id = (int) $id;
        $company = Company::where('status',1)->findOrFail($id);
        if(!$company){
            return redirect(404);
        }
        $company->increaseViews();
        $pages = Page::whereIn('id',[1,4])->where('status',1)->get();
        return view('Frontend::company_details',compact('pages','company'));
    }

    public function blogs(){
        $pages = Page::whereIn('id',[1,7])->where('status',1)->get();
        $blogs = Blog::where([['status',1],['category_id',null]])->paginate(config('modules.site_configs.pagination'));

        $data['data'] = $blogs;
        $data['pagination'] = \Helper::generatePagination($blogs);
        $data = (object) $data;
        return view('Frontend::blogs',compact('pages','blogs','data'));
    }

    public function blog_details($id){
        $id = (int) $id;
        $blog = Blog::where('status',1)->findOrFail($id);
        if(!$blog){
            return redirect(404);
        }
        $blog->increaseViews();
        $pages = Page::whereIn('id',[1,7])->where('status',1)->get();
        return view('Frontend::blog_details',compact('blog','pages'));
    }

    public function ebook(){
        $data = Category::with('Blogs')->where([['status',1]])->has('Blogs')->orderBy('sort')->get();
        return view('Frontend::ebook',compact('data'));
    }

    public function contactUs(){
        $pages = Page::whereIn('id',[1,6])->where('status',1)->get();
        return view('Frontend::contactUs',compact('pages'));
    }

    public function postContactUs(Request $request){
        $input = $request->all();

        $checkObj = ContactUs::where([
            ['email',$input['email']],
            ['status' , 1]
        ])->orWhere([
            ['phone',$input['phone']],
            ['status' , 1]
        ])->first();

        if($checkObj){
            \Session::flash('error',trans('Frontend::home.sentBefore'));
            return redirect()->back()->withInput();
        }

        unset($input['_token']);
        $input['status'] = 1;

        ContactUs::create($input);

        $sendEmails = config('modules.general_configs.enable_emails');
        if($sendEmails){
            $emailData = [
                'name' => $input['name'],
                'subject' => 'New Message Form Contact Us Form',
                'template' => "frontend.emailUsers.emailReplied",
                'to'    => $input['email'],
                'content' => $input['message'],
            ];
            \MailHelper::sendMail($emailData);
        }
        
        \Session::flash('success',trans('Frontend::home.sentSuccess'));
        return redirect()->back();
    }

    public function order(){
        $pages = Page::whereIn('id',[1,5])->where('status',1)->get();
        $services = Service::where('status',1)->get();
        return view('Frontend::order',compact('pages','services'));
    }

    public function postOrder(Request $request){
        $input = $request->all();

        if(!isset($input['service_id']) || empty($input['service_id'])){
            \Session::flash('error',trans('Frontend::home.selectService'));
            return redirect()->back()->withInput();
        }

        $serviceObj = Service::where([
            ['status',1],
            ['id', (int) $input['service_id']]
        ])->first();

        if(!$serviceObj){
            \Session::flash('error',trans('Frontend::home.invalidService'));
            return redirect()->back()->withInput();
        }

        $checkObj = Order::where([
            ['email',$input['email']],
            ['status' , 1]
        ])->orWhere([
            ['phone',$input['phone']],
            ['status' , 1]
        ])->first();

        if($checkObj){
            \Session::flash('error',trans('Frontend::home.sentBefore'));
            return redirect()->back()->withInput();
        }

        unset($input['_token']);
        $input['status'] = 1;

        Order::create($input);

        $sendEmails = config('modules.general_configs.enable_emails');
        if($sendEmails){
            $emailData = [
                'name' => $input['name'],
                'subject' => 'New Message Form Consultation Request Form',
                'template' => "frontend.emailUsers.emailReplied",
                'to'    => $input['email'],
                'content' => $input['message'],
            ];
            \MailHelper::sendMail($emailData);
        }
        
        \Session::flash('success',trans('Frontend::home.sentSuccess'));
        return redirect()->back();
    }
}
