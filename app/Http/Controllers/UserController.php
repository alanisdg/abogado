<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;
use App\Models\Role;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendPassword;

// Request
use App\Http\Requests\UsersRequest;

class UserController extends Controller
{
    protected $config = [
        "moduleName" => "Usuarios",
        "moduleLabel" => "Registro de Usuarios",
        "routeView" => "modules.users.",
        "routeLink" => "users",
        "add" => "Registrar Usuario",
        "edit" => "Editar Usuario",
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $array = User::with('roles')->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "index")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('roles', Role::all())
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Register user
            $addUser = New User();
            $addUser->rut = $request->input('rut');
            $addUser->first_name = $request->input('first_name');
            $addUser->last_name = $request->input('last_name');
            $addUser->email = $request->input('email');
            $addUser->password = bcrypt($request->input('password'));
            $addUser->status = 1;
            if ($addUser->save()) {

                $role = Role::find($request->input('rol'));
                $addUser->roles()->attach($role);

                // Send email
                    $userDetails = [
                        'title' => '¡APPABOPROC!',
                        'url'   => \Request::root(),
                        'user' => $addUser,
                        'email' => $addUser->email,
                        'password' => $request->input('password')
                    ];

                    Mail::to($addUser->email)->send(new SendPassword($userDetails));

                // Return response
                    Toastr::success("", "¡Usuario Registrado!");
                    return redirect('users');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        foreach ($user->roles as $value) {
            $rolId = $value->id;
        }

        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('rolId', $rolId)
            ->with('roles', Role::all())
            ->with('row', $user)
            ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
            $updateUser = User::find($user->id);
            $updateUser->rut = $request->input('rut');
            $updateUser->first_name = $request->input('first_name');
            $updateUser->last_name = $request->input('last_name');
            $updateUser->email = $request->input('email');
            if ($request->input("password") != null) {
                $updateUser->password = bcrypt($request->input("password"));
            }
            if ($updateUser->save()) {

                // Update role
                    $updateUser->roles()->detach();
                    $role = Role::find($request->input('rol'));
                    $updateUser->roles()->attach($role);

                Toastr::success("", "¡Usuario Actualizado!");
                return redirect('users/'.$updateUser->id.'/edit');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Update status
     */
    public function updateStatus(Request $request)
    {
        $dataUser = User::find($request->input('user_id'));
        ($dataUser->status == 1) ? $dataUser->status = 2 : $dataUser->status = 1;
        $dataUser->save();

        return response()->json(1);
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $dataUser = User::whereId($id)->delete();

        Toastr::success("", "¡Usuario Eliminado!");
        return redirect('users');
    }

    /**
     * View profile
     */
    public function editProfile()
    {
        return view($this->config["routeView"] . "profile")
                    ->with("row", Auth::user())
                    ->with("config", $this->config);
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        // Data user
            $updateProfile = User::find(Auth::user()->id);
            $updateProfile->rut = $request->input('rut');
            $updateProfile->first_name = $request->input('first_name');
            $updateProfile->last_name = $request->input('last_name');
            $updateProfile->email = $request->input('email');
            if ($updateProfile->save()) {
                if ($request->input('password') != null) {
                    $updateProfile->update(["password" => bcrypt($request->input('password'))]);
                }

                Toastr::success("", "¡Perfil Actualizado!");
                return redirect('user-profile');
            }

    }
}
