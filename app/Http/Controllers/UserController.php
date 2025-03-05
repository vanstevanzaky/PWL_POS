<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user = UserModel::firstWhere('level_id', 1);
        return  view('user', ['data' => $user]);

    }
}
        // $user = userModel::where('level_id', 1)->first();
        // return  view('user', ['data' => $user]);


        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4

        // ];
        // UserModel::insert($data);

        // $data = [
        //     'nama' => 'Pelangan Pertama',
        // ];

        // UserModel::where('username', 'customer-1')->update($data);

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);
        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);