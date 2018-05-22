<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\newspage;

class NewspageController extends Controller
{
    public $value_frm = array(
    	'id'=>null,
    	'name'=>null,
    	'type_news' =>null,
    	'content' =>null,
    );
    public function index()
    {
    	$data = array(
    		'title' => 'Quản lý bài viết',
    		'arItems' =>newspage::get(),
    	);
    	return view('admin.newspage.index',$data);
    }
    public function getadd($type_news)
    {
    	$data = array(
    		'value_frm' => $this->value_frm,
    		'title'		=> 'Thêm bài viết',
    		'action'	=> 'admin.newspage.add',
    		'type_news' => $type_news,
    	);
    	return view ('admin.newspage.add',$data);
    }
    public function postadd($type_news, Request $request)
    {
    	$data_frm = $request->all();
    	$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
			
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
			
		]);
		
		$newspage = new newspage;
		$newspage->name = $data_frm['name'];
		$newspage->type_news =$type_news;
		$newspage->content = $data_frm['content'];
		$newspage->save();
		$id = $newspage->id;

		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.newspage.edit',$id);
    }
    public function getedit($id)
    {
    	$this->value_frm = newspage::find($id);
    	$data = array(
    		'value_frm' => $this->value_frm,
    		'title'		=> 'Thêm bài viết',
    		'action'	=> 'admin.newspage.edit',
    	);
    	return view ('admin.newspage.edit',$data);
    }
    public function postedit($id, Request $request)
    {
    	$data_frm = $request;
    	$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
			
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
			
		]);

    	$newspage = newspage::find($id);
		$newspage->name = $data_frm['name'];
		$newspage->content = $data_frm['content'];
		$newspage->update();
		$request->session()->flash('msg','Sửa thành công');
		return redirect()->route('admin.newspage.edit',$id);
    }
    public function del($id, Request $request){
    	$arItems = newspage::find($id);
    	$arItems->delete();
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.newspage.edit',$id);

    }
    public function getaddtype($type_news)
    {
    	$Arnewspage = newspage::where('type_news',$type_news)->get();
    	if (count($Arnewspage)>0) {
    		return redirect()->route('admin.newspage.edit',$Arnewspage[0]['id']);
    	}
    	else
    	{
    		return redirect()->route('admin.newspage.add',$type_news);
    	}
    }
    
}
