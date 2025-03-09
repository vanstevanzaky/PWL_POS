<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }
    public function tambah_simpan()
    {
        UserModel::create([
            'username' => request('username'),
            'nama' => request('nama'),
            'password' => Hash::make(request('password')),
            'level_id' => request('level_id')
        ]);
        return redirect('user');
    }
    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    public function ubah_simpan($id)
    {
        $user = UserModel::find($id);

        $user->username = request('username');
        $user->nama = request('nama');
        $user->password = Hash::make(request('password'));
        $user->level_id = request('level_id');
        $user->save();
        return redirect('user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('user');
    }

}

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager11',
        //         'nama' => 'Manager11',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );
        // $user->username = 'manager12';
        // $user->save();
        // $user->wasChanged();
        // $user->wasChanged('username');
        // $user->wasChanged(['username', 'level_id']);
        // $user->wasChanged('nama'); 
        // dd($user->wasChanged(['nama', 'username']));


        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );
        // $user->username = 'manager56';
        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['username', 'nama']);
        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['username', 'nama']);
        // $user->save();
        // $user->isDirty();
        // $user->isClean();
        // dd($user->isDirty());

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );
        // $user->save();
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ]
        // );
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // return view('user', ['data' => $user]);

        // $user = userModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('username', 'manager')->firstOrFail();
        // return view('user', ['data' => $user]);

        // $user = userModel::findOrFail(1);
        // return view('user', ['data' => $user]);
        // $user = userModel::findor(20, ['username','nama'], function(){
        //     abort(404);
        // });
        // return  view('user', ['data' => $user]);

        // $user = UserModel::firstWhere('level_id', 1);
        // return  view('user', ['data' => $user]);

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