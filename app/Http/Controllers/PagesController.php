<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\User;
use App\TinTuc;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    function __construct() {
        $theloai = TheLoai::all();
        $slide   = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);

        if (Auth::check()) {
            view()->share('nguoidung', Auth::user());
        }
    }

    function trangchu() {
        return view('pages.trangchu');
    }

    function lienhe() {
        return view('pages.lienhe');
    }

    function loaitin($id) {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    function tintuc($id) {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();

        return view('pages.tintuc', ['tintuc' => $tintuc, 'tinnoibat' => $tinnoibat, 'tinlienquan' => $tinlienquan]);
    }

    function getDangnhap() {
        return view('pages.dangnhap');
    }

    function postDangnhap(Request $request) {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required|min:3|max:32'
        ], [
            'email.required'    => 'Bạn chưa nhập tên',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min'      => 'Mật khẩu không được nhỏ hơn 3 ký tự và lớn hơn 32 ký tự',
            'password.min'      => 'Mật khẩu không được nhỏ hơn 3 ký tự và lớn hơn 32 ký tự'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('trangchu');
        } else {
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập thất bại');
        }
    }

    function getDangxuat() {
        Auth::logout();

        return redirect('trangchu');
    }

    function getNguoidung() {
        $user = Auth::user();
        return view('pages.nguoidung', ['nguoidung' => $user]);
    }

    function postNguoidung(Request $request) {
         $this->validate($request, [
            'name'          => 'required|min:3|',
        ], [
            'name.required'          => 'Bạn chưa nhập tên người dùng',
            'name.min'               => 'Tên người dùng phải có ít nhất 3 ký tự'
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if (isset($request->changePassword)) {
            $this->validate($request, [
                'password'      => 'required|min:6|max:32',
                'passwordAgain' => 'required|same:password'
            ], [
                'password.required'      => 'Bạn chưa nhập mật khẩu',
                'password.min'           => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max'           => 'Mật khẩu phải có tối đa nhất 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'     => 'Mật khẩu nhập lại chưa khớp'
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('nguoidung')->with('thongbao', 'Bạn đã sửa thành công');
    }

    function getDangky() {
        return view('pages.dangky');
    }

    function postDangky(Request $request) {
         $this->validate($request, [
            'name'          => 'required|min:3|',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6|max:32',
            'passwordAgain' => 'required|same:password'
        ], [
            'name.required'          => 'Bạn chưa nhập tên người dùng',
            'name.min'               => 'Tên người dùng phải có ít nhất 3 ký tự',
            'email.required'         => 'Bạn chưa nhập email',
            'email.email'            => 'Bạn chưa nhập đúng định dạng email',
            'email.unique'           => 'Email đã tồn tại',
            'password.required'      => 'Bạn chưa nhập mật khẩu',
            'password.min'           => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max'           => 'Mật khẩu phải có tối đa nhất 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'     => 'Mật khẩu nhập lại chưa khớp'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();

        return redirect('dangky')->with('thongbao', 'Đăng ký thành công');
    }

    function timkiem(Request $request) {
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe', 'like', "%$tukhoa%")->orWhere('TomTat', 'like', "%$tukhoa%")->orWhere('NoiDung', 'like', "%$tukhoa%")->take(30)->paginate(5);

        return view('pages.timkiem', ['tintuc' => $tintuc, 'tukhoa' => $tukhoa]);
    }
}
