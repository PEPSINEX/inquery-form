<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # 管理者以外のスタッフを取得。全てのデータから管理者を除くメソッドにした方がいいのかな？
        $staffs = User::getStaff();
        return view('staffs.index', ['staffs' => $staffs]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staffs = User::where('id', $id)->delete();

        return redirect()->action('StaffController@index');
    }
}
