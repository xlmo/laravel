<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    private $viewdata = [];

    public function __construct(Request $request)
    {
        $name  = $request->session()->get('name');
        if (empty($name)) {
            return redirect('/user/login');
        }
        $this->viewdata['username'] = $name;
    }

    public function index(Request $request)
    {

        $limit = (int) $request->input('limit', 10);
        $data = DB::table('tasks')->paginate($limit);
        $this->viewdata['data'] = $data;
        return view('task.index', $this->viewdata);
    }


    public function create() {
        return view('task.create', $this->viewdata);
    }

    public function store(Request $request) {
        $data = [
            'title' => $request->input('name'),
            'desc' => $request->input('desc'),
            'expired_at' => $request->input('expired_at'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        DB::table('tasks')->insert($data);
        return json_encode(['code' => 0, 'msg' => '创建成功']);
    }

    public function edit($id)
    {
        $info = DB::table('tasks')->where('id', $id)->first();
        $this->viewdata['info'] = $info;
        return view('task.edit', $this->viewdata);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->input('name'),
            'desc' => $request->input('desc'),
            'expired_at' => $request->input('expired_at'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Db::table('tasks')->where('id', $id)->update($data);
        return json_encode(['code' => 0, 'msg' => '修改成功']);
    }

    public function delete($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return json_encode(['code' => 0, 'msg' => '删除成功']);
    }
}
