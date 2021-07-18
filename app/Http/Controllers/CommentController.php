<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin; 
use App\TinTuc;
use App\Comment;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    
    public function getXoa($id, $idTinTuc) {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/' . $idTinTuc)->with('thongbao', 'Đã xóa bình luận thành công');
    }

    public function postComment($id, Request $request) {
        $idTinTuc = $id;

        $tintuc = TinTuc::find($id);

        $comment = new Comment;
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();

        return redirect("tintuc/$id/" . $tintuc->TieuDeKhongDau . ".html")->with('thongbao', 'Bình luận thành công');
    }
}
