<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar User yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                // $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">';
                // $btn .= csrf_field() . method_field('DELETE');
                // $btn .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail Ajax</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit Ajax</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus Ajax</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax')->with('level', $level);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            UserModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    public function show_ajax($id)
    {
        $user = UserModel::with('level')->find($id);
    
        if ($user) {
            return view('user.show_ajax', ['user' => $user]);
        }
    
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    }
    




    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }
    public function update_ajax(Request $request, $id)
    {

        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama'     => 'required|max:100',
                'password' => 'nullable|min:6|max:20'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal 
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }

                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id);
        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }




    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil ditambahkan');
    }
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user';

        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    //untuk registrasi
    public function createRegistrasi()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User'
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.registrasi', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function storeRegistrasi(Request $request)
    {
        
        if($request->ajax() || $request->wantsJson()){
            
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5',
                'level_id' => 'required|integer'
            ]);
    
           
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }
    
            
            try {
                UserModel::create([
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => bcrypt($request->password),
                    'level_id' => $request->level_id
                ]);
                
                return response()->json([
                    'status' => true,
                    'message' => 'Registrasi Berhasil, Silahkan Login',
                    'redirect' => url('/login'),
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Registrasi Gagal: ' . $e->getMessage()
                ]);
            }
        }
    } 

    public function import()
    {
        return view('user.import');
    }
    public function import_ajax(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            
            $file = $request->file('file_user');  // ambil file dari request
            $reader = IOFactory::createReader('Xlsx');  // load reader file excel
            $reader->setReadDataOnly(true);             // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true);   // ambil data excel
            $insert = [];
            if(count($data) > 1){ // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if($baris > 1){ // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                        ];
                    }
                }
                if(count($insert) > 0){
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    UserModel::insertOrIgnore($insert);   
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data User berhasil diimport'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }
    public function export_excel(){
        $user = UserModel::select('username', 'nama', 'level_id')
            ->with('level') // ambil data dari relasi level
            ->orderBy('level_id')
            ->get();
    
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Username');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Nama Level');
    
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
    
        $no = 1;
        $baris = 2;
        foreach ($user as $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->username);
            $sheet->setCellValue('C'.$baris, $value->nama);
            $sheet->setCellValue('D'.$baris, $value->level->level_nama ?? '-');
            $no++;
            $baris++;
        }
    
        foreach(range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    
        $sheet->setTitle('Data User');
    
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_User_' . date('Y-m-d_H-i-s') . '.xlsx';
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
    
        $writer->save('php://output');
        exit;
    }
    

    public function export_pdf(){
        $users = UserModel::select('level_id','username', 'nama')
        ->with('level')
        ->orderBy('level_id')
        ->orderBy('username')
        ->get();

        $pdf = Pdf::loadview('user.export_pdf', compact('users'));
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->render();
        return $pdf->stream('Data User' . date('Y-m-d H:i:s'). '.pdf');

    }
    

}
