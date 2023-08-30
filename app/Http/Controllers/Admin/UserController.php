<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcountAdmin\UpdateAcountAdminRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GrahamCampbell\ResultType\Result;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
session_start();

class UserController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect()->back();
        }

        return view('admin_login',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function postLogin(UserLoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->input('admin_email'),
            'password' => $request->input('admin_password')
            ],$request->input('remember'))) {
            return redirect()->route('dashboard'); //truyền về theo định danh của route
        }

        $request->session()->flash('thongbao', 'Email hoặc Password sai!');
        return redirect()->back();
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function acountAdmin($user_id)
    {
        $user = User::find($user_id);
        return view(
            'Admin.AcountAdmin.details-acount-admin',
            [
                'title1' => 'Chi tiết tài khoản admin | Limupa'
            ],
            compact('user')
        );
    }

    public function editAcountAdmin($user_id)
    {
        $user = User::find($user_id);
        return view(
            'Admin.AcountAdmin.edit-acount-admin',
            [
                'title1' => 'Chi tiết tài khoản admin | Limupa'
            ],
            compact('user')
        );
    }

    public function updateAcountAdmin(UpdateAcountAdminRequest $request, $user_id)
    {
        $user = User::find($user_id);
        $user->name = $request['name'];
        if (isset($request['password'])) {
            $user->password = bcrypt($request['password']);
        }
        $user->save();
        if ($user) {
            return redirect()->route("admin.acount_admin", $user_id)->with('massage', 'Cập nhật tài khoản thành công!');
        } else {
            return redirect()->route("admin.acount_admin", $user_id)->with('error', 'Cập nhật tài khoản thât bại!');
        }
    }


    /**
     *  Nên dùng auth như ở trên
     *  do bài này làm theo video nên làm theo version cũ như ở dưới
     */

    /*
    public function postLogin(Request $request) {
        $this->validate($request,
        [
            'admin_email' => 'required',
            'admin_password' => 'required|min:4|max:20'
        ],
        [
            'admin_email.required' => 'Bạn chưa nhập Email',
            'admin_password.required' => 'Bạn chưa nhập Password',
            'admin_password.min' => 'Lỗi! Password ngắn hơn 4 ký tự',
            'admin_password.max' => 'Lỗi! Password dài hơn 20 ký tự',
        ]);
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        // get() : lấy toàn bộ các bản ghi từ một bảng
        // first() : Lấy một bản ghi hoặc một cột trong bảng
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if ($result == true) {
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id', $result->admin_id);
            // Session::put('admin_name', $request->admin_name);
            // Session::put('admin_id', $request->admin_id);
            return redirect()->route('DashBoard');
        } else {
                // Nên dùng session()->flash thay vì session()->put
                // flash(): Dữ liệu sẽ được lưu lại và chỉ suất hiện một lần duy nhất trong lần phản hồi yêu cần tiếp theo,
                // sau đó nó sẽ tự động xóa đi.
                // put():Lưu giá trị và Session, xuất hiện mãi chỉ khi mình cho thông báo về null
            $request->session()->flash('message', "Email hoặc Password sai!");
            return redirect()->back();
            // return redirect('admin')->with('thongbao', 'Đăng nhập không thành công');
        }
    }
    */

    /*
    public function getLogout(Request $request) {
        $request->session()->put('admin_name', null);
        $request->session()->put('admin_id', null);
        return redirect()->route('login');
    }
    */
}
