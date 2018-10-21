<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;
use App\notification;
use App\notification_users;

class Notificationcontroller extends Controller
{

    public $dataForm = [
        'id' => 0,
        'name' => '',
        'highlight' => 0,
        'general' => 1,
        'description' => '',
        'content' => '',
        'users' =>null,
    ];

    public function index()
    {
        $notification = notification::get();
        $data = [
          'arItems' => $notification,
        ];
        return view('admin.notification.index', $data);
    }

    public function create()
    {
        $users = user::where('id_phanquyen', '<>', 1)->select('username')->get();
        $usersList = [];
        if($users !== null){
            foreach($users as $user)
            {
                $usersList[] = $user->username;
            }
        }
        $data = [
            'notification' => $this->dataForm,
            'title' => 'Thêm thông báo',
            'action' => route('admin.notification.docreate'),
            'users' => $usersList,
        ];
        return view('admin.notification.form', $data);
    }

    public function doCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'content' => 'required',

        ], [
                'name.required' => 'Không được để trống',
                'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
                'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
                'content.required' => 'Không được để trống',

        ]);

        $notification = new notification;
        $notification->name = $request->name == '' ? 'Thông báo '.date('d/m/Y') : $request->name;
        $notification->description = $request->description;
        $notification->content = $request->content;
        $notification->highlight = empty($request->highlight) ? 0 : 1;
        $notification->general = empty($request->general) ? 0 : 1;
        $notification->save();
        $id = $notification->id;
        if(empty($request->general) && $request->to !== null){
            $users = $request->to;
            foreach($users as $user)
            {
                $notificationUsers = new notification_users;
                $notificationUsers->notification_id = $id;
                $notificationUsers->username = $user;
                $notificationUsers->readed = 0;
                $notificationUsers->save();
            }
        }

        return redirect()->route('admin.notification.index')->with('msg', 'Thêm thành công');
    }

    public function edit($id)
    {
        $users = user::where('id_phanquyen', '<>', 1)->select('username')->get();
        $usersList = [];
        if($users !== null){
            foreach($users as $user)
            {
                $usersList[] = $user->username;
            }
        }

        $notificationUsers = notification_users::where('notification_id', '=', $id)->select('username')->get();
        $this->dataForm = notification::find($id);
        $this->dataForm['users'] = $notificationUsers;
        $data = [
            'notification' => $this->dataForm,
            'title' => 'Thêm thông báo',
            'action' => route('admin.notification.doedit', $id),
            'users' => $usersList,
        ];
        return view('admin.notification.form', $data);
    }

    public function doEdit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'content' => 'required',

        ], [
            'name.required' => 'Không được để trống',
            'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
            'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
            'content.required' => 'Không được để trống',

        ]);

        $notification = notification::find($id);
        $notification->name = $request->name == '' ? 'Thông báo '.date('d/m/Y') : $request->name;
        $notification->description = $request->description;
        $notification->content = $request->content;
        $notification->highlight = empty($request->highlight) ? 0 : 1;
        $notification->general = empty($request->general) ? 0 : 1;
        $notification->save();
        if(empty($request->general) && $request->to !== null){
            $users = $request->to;
            $notificationUsers = notification_users::where('notification_id', $id)->delete();
            foreach($users as $user)
            {

                $notificationUsers = new notification_users;
                $notificationUsers->notification_id = $id;
                $notificationUsers->username = $user;
                $notificationUsers->readed = 0;
                $notificationUsers->save();
            }
        }

        return redirect()->route('admin.notification.index')->with('msg', 'Thêm thành công');
    }

    public function show($id)
    {
        $this->dataForm = notification::find($id);
        $data = [
            'notification' => $this->dataForm,
        ];
        return view('admin.notification.show', $data);
    }

    public function del($id)
    {
        $notification = notification::find($id);

        if($notification->general != 1){
            $notificationUsers = notification_users::where('notification_id', $id)->delete();
        }

        $notification->delete();
        return redirect()->route('admin.notification.index')->with('msg', 'Xoá thành công');
    }
}
