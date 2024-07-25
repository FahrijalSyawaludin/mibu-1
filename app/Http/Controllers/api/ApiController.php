<?php

namespace App\Http\Controllers\api;

use App\Models\DataIbuHamil;
use App\Models\DataAnak;
use App\Models\DataArtikel;
use App\Models\DataImunisasi;
use App\Models\DataNifas;
use App\Models\User;
use App\Models\DataLayananKb;
use App\Models\DataKesehatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Validator;
use Auth;

class ApiController extends Controller
{
public function apiIbuHamil(Request $request)
    {
        try {
            $search = $request->input('search');
            $data_ibu_hamils = DataIbuHamil::where('nama_ibu', 'like', "%$search%")->get();
    
            return response()->json([
                'success' => true,
                'message' => 'Ibu hamil list retrieved successfully',
                'data_ibu_hamils' => $data_ibu_hamils,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Ibu hamil list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiKb(Request $request)
    {
        try {
            $search = $request->input('search');
            $data_layanan_kbs = DataLayananKb::where('nama_ibu', 'like', "%$search%")->get();
    
            return response()->json([
                'success' => true,
                'message' => 'KB list retrieved successfully',
                'data_layanan_kbs' => $data_layanan_kbs,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve KB list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiAnak(Request $request)
    {
        try {
            $search     = $request->input('search');
            $data_anaks = DataAnak::where('nama_ibu', 'like', "%$search%")->orWhere('nama_anak', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'Anak list retrieved successfully',
                'data_anaks' => $data_anaks,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve anak list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiImunisasi(Request $request)
    {
        try {
            $search          = $request->input('search');
            $data_imunisasis = DataImunisasi::where('nama_anak', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'Imunisasi retrieved successfully',
                'data_imunisasis' => $data_imunisasis,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve imunisasi list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiNifas(Request $request)
    {
        try {
            $search     = $request->input('search');
            $data_nifas = DataNifas::where('nama_ibu', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'Nifas retrieved successfully',
                'data_nifas' => $data_nifas,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve nifas list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiArtikel(Request $request)
    {
        try {
            $search     = $request->input('search');
            $data_artikels = DataArtikel::where('judul', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'artikel retrieved successfully',
                'data_artikel' => $data_artikels,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve artikel list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiBidan(Request $request)
    {
        try {
            $search     = $request->input('search');
            $data_bidans = User::where('name', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'bidan retrieved successfully',
                'data_bidan' => $data_bidans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve bidan list',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function apiKesehatan(Request $request)
    {
        try {
            $search = $request->input('search');
            $data_kesehatan = DataKesehatan::where('nama_ibu', 'like', "%$search%")->get();

            return response()->json([
                'success' => true,
                'message' => 'Data Catatan Kesehatan retrieved successfully',
                'data_kesehatan' => $data_kesehatan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Data Catatan Kesehatan',
                'error' => $e->getMessage(),
            ], 500); // 500 is the HTTP status code for internal server error
        }
    }

    public function registerIbu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ibu' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:data_ibu_hamils,email',
            'no_telepon' => 'required',
            'password' => 'required',
            'umur_ibu' => 'required',
            'kehamilan_ke' => 'required',
            'nama_suami' => 'required',
            'umur_suami' => 'required',
            'nik' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'data' => $validator->errors()
            ], 422);
        }

        // Check for existing email
        $existingUser = DataIbuHamil::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exists.',
                'data' => ['email' => 'This email is already registered.']
            ], 409); // 409 Conflict
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['nama_ibu'] = $input['nama_ibu'] ?? 'default_username';
        $user = DataIbuHamil::create($input);

        $success['remember_token'] = $user->createToken('remember_token')->plainTextToken;
        $success['nama_ibu'] = $user->nama_ibu;
        $success['email'] = $user->email;
        $success['alamat'] = $user->alamat;
        $success['no_telepon'] = $user->no_telepon;
        $success['umur_ibu'] = $user->umur_ibu;
        $success['kehamilan_ke'] = $user->umur_suami;
        $success['nama_suami'] = $user->nama_suami;
        $success['umur_suami'] = $user->umur_suami;
        $success['nik'] = $user->nik;

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration Successful.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ]);
    }



    public function loginIbu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'data' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('ibu')->attempt($credentials)) {
            $user = Auth::guard('ibu')->user();

            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['id'] = $user->id;
            $success['nama_ibu'] = $user->nama_ibu;
            $success['email'] = $user->email;
            $success['alamat'] = $user->alamat;
            $success['no_telepon'] = $user->no_telepon;
            $success['umur_ibu'] = $user->umur_ibu;
            $success['kehamilan_ke'] = $user->kehamilan_ke;
            $success['nama_suami'] = $user->nama_suami;
            $success['umur_suami'] = $user->umur_suami;
            $success['nik'] = $user->nik;

            return response()->json([
                'success' => true,
                'message' => 'Login Successful',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function updateProfileImage(Request $request)
    {

        // dd($request);
        if ($request->bearerToken()) {
            $user = Auth::guard('sanctum')->user();

            // dd($user);

            if ($user) {
                $request->validate([
                    'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:10048', // Adjust file size and allowed formats as needed
                ]);

                // dd($request->hasFile('profile_photo'));

                if ($request->hasFile('profile_photo')) {
                    $file = $request->file('profile_photo');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('profile_photo', $fileName, 'public');


                    // Update user's profile image path in the database
                    $user->profile_photo = $filePath;

                    // dd($user->profile_photo);
                    $user->save();

                    return response()->json(['success' => true, 'msg' => 'Profile image updated', 'file_path' => $filePath]);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Profile image not provided'], 400);
                }
            } else {
                return response()->json(['success' => false, 'msg' => 'User not found or token expired'], 401);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Token not provided'], 401);
        }
    }

    // public function verify($id, Request $request)
    // {
    //     if (!$request->hasValidSignature()){
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Verifikasi email gagal.'
    //         ], 400);
    //     }

    //     $user = DataIbuHamil::find($id);

    //     if (!$user->hasVerifiedEmail()) {
    //         $user->markEmailAsVerified();
    //     }

    //     return redirect()->to('login');
    // }

    public function verify($id, Request $request)
    {
        $user = DataIbuHamil::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => 'Email is already verified.'
            ], 400);
        }

        $hash = $request->route('hash');
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid verification link.'
            ], 403);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'status' => true,
            'message' => 'Email verified successfully.'
        ], 200);
    }


    public function notice()
    {
        return response()->json([
            'status' => false,
            'message' => 'Anda belum melakukan verifikasi email.'
        ], 400);
    }

}
