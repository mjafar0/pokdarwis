<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

use Closure;
use Exception;
use App\Models\User;

use Yajra\DataTables\DataTables;

use App\Http\Requests\System\UsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            $data = User::select('*')
            ->where('role', 'admin');
            
            return DataTables::of($data)
            ->addIndexColumn()      
            ->toJson();
        }
        else
        {
            return view('admin.settings.users.users-index', []);
        }
    }    
    public function show(Request $request, $id)
    {    

        $tab = $request->query('tab', 'profile');

        try
        {
            $user = User::find($id);

            if (is_null($user))
            {
                throw new \Exception("User dengan ID ($id) tidak terdaftar.");        
            }

            $role_name = $request->query('role', $user->default_role);
            $daftar_role_user = $user->getRoleNames()->toArray();

            if (!in_array($role_name, $daftar_role_user)) 
            {
                throw new \Exception("User dengan ID ($id) bukan anggota dari role " . json_encode($daftar_role_user));
            }

            $data_view = [
                'tab' => $tab,
                'data_user' => $user,
                'daftar_role_user' => $daftar_role_user,
                'jumlah_role' => count($daftar_role_user),
                'jumlah_permission' => $user->permissions->count(),
            ];

            switch($tab)
            {
                case 'profile':
                    $daftar_activity = [];
                    $data_view['daftar_aktivitas'] = $daftar_activity;
                break;
                case 'role':
                    $daftar_role = Role::select(DB::raw('
                        id,
                        name
                    '))		
                    ->where('guard_name', 'web')      
                    ->orderBy('id', 'asc')
                    ->get()
                    ->pluck('name', 'name')
                    ->prepend('- PILIH ROLE -', '')    
                    ->toArray();

                    $data_view['daftar_role'] = $daftar_role;
                break;
                case 'permission':
                    $role = Role::findByName($role_name);

                    $user_permission = $user->permissions;
                    $role_permission = $role->permissions;
                    
                    $data_view['data_role'] = $role;          
                    $data_view['role_permissions'] = $role_permission;
                    $data_view['user_permissions'] = $user_permission->pluck('name','id')->toArray();
                break;
            }
            
            return view('settings.system.users.user.user-show', $data_view);
        }
        catch(\Exception $e)
        {
            \Alert::error($e->getMessage())->persistent();
            return redirect(route('system-users-manage.index'))->with('swal', false);
        }    
    }	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //daftar role
        $daftar_role = Role::select(DB::raw('
            id,
            name
        '))		
        ->where('guard_name', 'web')
        ->whereNotIn('name',  ['alumni', 'mahasiswabaru', 'mahasiswa', 'dosen', 'dosenwali', 'orangtuawali'])
        ->orderBy('id', 'asc')
        ->get()
        ->pluck('name', 'name')
        ->prepend('- PILIH ROLE -', '')    
        ->toArray();
        
        return view('settings.system.users.user.user-create', [     
            'daftar_role' => $daftar_role
        ]);
    }	
    /**
     * digunakan untuk membuat token untuk user
     */
    public function createtoken(Request $request, $id)
    {
        $user = User::find($id);

        if (is_null($user))
        {
            \Alert::error("ID user ($id) tidak terdaftar.")->autoClose(3000)->timerProgressBar();
            return back()->with('swal', false);			      
        }   
        else
        {		
            $token = $user->createToken('bsi');
            return $token;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request): \Illuminate\Http\RedirectResponse
    {
        $table_name = User::getTableName();
        
        $tableNames = config('permission.table_names');
        
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated, $request) {      
            $user = User::create([					
                'name' => $validated['name'],
                'email' => $validated['email'],
                'nomor_hp' => $validated['nomor_hp'],
                'username'=> $validated['username'],
                'password' => Hash::make($validated['password']),        
                'theme' => 'default',
                'default_role' => $validated['default_role'],
                'foto'=> 'resources/userimages/no_photo.png',
            ]);       			   
            $user->syncRoles([$validated['default_role']]);          

            $permission = Role::findByName($validated['default_role'])->permissions;
            $user->givePermissionTo($permission->pluck('name'));
            
            activity()
                ->event('store-user')
                ->withProperties(['ip' => $request->ip()])
                ->tap(function (Activity $activity) {
                    $activity->log_name = 'system-user';
                })
                ->performedOn($user)
                ->log("User {$user->name} berhasil dibuat");

            return $user;
        });				    
        \Alert::success('Berhasil', 'User dengan role ' . $user->default_role. '  berhasil disimpan.')->autoClose(3000)->timerProgressBar();
        return redirect(route('system-users-manage.show', ['id' => $user->id]))->with('swal', true);
    }	
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            \Alert::error("User dengan ID ($id) tidak terdaftar.")->autoClose(3000)->timerProgressBar();
            return back()->with('swal', false);			            
        }
        else
        {
            //daftar role
            $daftar_role = Role::select(DB::raw('
                id,
                name
            '))		
            ->where('guard_name', 'web')    
            ->orderBy('id', 'asc')
            ->get()
            ->pluck('name', 'name')
            ->prepend('- PILIH ROLE -', '')    
            ->toArray();

            return view('settings.system.users.user.user-edit', [
                'daftar_role' => $daftar_role,
                'data' => $user,
            ]);
        }
    }
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);

        if (is_null($user))
        {
            \Alert::error("User dengan ID ($id) tidak terdaftar.")->autoClose(3000)->timerProgressBar();
            return back()->with('swal', false);
        }
        else
        {
            $validated = $request->validated();

            $user = DB::transaction(function () use ($validated, $user, $request) {				
                $old_role = $user->default_role;
                
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->username = $validated['username'];                   
                $user->nomor_hp = $validated['nomor_hp'];                   
                $user->nomor_hp2 = $validated['nomor_hp2'];                  
                
                if(!is_null($validated['password']))
                {
                    $user->password = Hash::make($validated['password']);
                } 
                        
                $user->updated_at = \Helper::tanggal('Y-m-d H:i:s');
                $user->default_role = $validated['default_role'];  
                
                if($request->hasFile('avatar'))
                {
                    $user->clearMediaCollection('profil');
                    
                    $avatar = $request->file('avatar');
                    $file_name = $avatar->getClientOriginalName();

                    $user->addMedia($avatar)
                    ->usingName($file_name)
                    ->usingFileName($avatar->hashName())
                    ->toMediaCollection('profil');

                    $objMedia = $user->getFirstMedia('profil');
                    $user->avatar = 'resources/' . $objMedia->getAttribute('id') . '/' . $objMedia->getAttribute('file_name');          
                }
                
                $user->save();          
                
                $default_role = $user->id == 1 ? 'superadmin' : $validated['default_role'];
                if($default_role != $old_role)
                {
                    $user->syncPermissions();
                    $user->syncRoles([$default_role]);          
    
                    $permissions = Role::findByName($default_role)->permissions;
                    $user->givePermissionTo($permissions);
                }

                activity()
                    ->event('store-user')
                    ->withProperties(['ip' => $request->ip()])
                    ->tap(function (Activity $activity) {
                        $activity->log_name = 'system-user';
                    })
                    ->performedOn($user)
                    ->log("User {$user->name} berhasil diubah");
                return $user;
            });		
            \Alert::success('Berhasil', 'Data user dengan role ' . $user->default_role. '  berhasil diubah.')->autoClose(3000)->timerProgressBar();	
                        
            return redirect(route('system-users-manage.show', ['id' => $user->id]))->with('swal', true);
        }
    }	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        try
        {
            if (is_null($user))
            {
                throw new Exception("User dengan ID ($id) tidak terdaftar.");
            }

            if ($user->isdeleted == 0)
            {
                throw new Exception("User dengan ID ($id) tidak bisa dihapus karena memiliki flag isdeleted = 0.");
            }

            if ($user->default_role == 'mahasiswa' && $user->mahasiswa->count() > 0)
            {
                throw new Exception("User mahasiswa ini tidak bisa dhapus karena memiliki satu atau lebih register mahasiswa");      
            }

            if ($user->default_role == 'mahasiswabaru' && $user->mahasiswabaru->count() > 0)
            {
                throw new Exception("User mahasiswa baru ini tidak bisa dhapus karena memiliki satu atau lebih formulir pendaftaran");
            }

            if ($user->default_role == 'dosen')
            {
                throw new Exception("User dengan default role dosen tidak bisa dhapus melalui halaman ini");
            }

            $default_role = $user->default_role;
            $user->delete();

            activity()
                ->event('store-user')
                ->withProperties(['ip' => $request->ip()])
                ->tap(function (Activity $activity) {
                    $activity->log_name = 'system-user';
                })
                ->performedOn($user)
                ->log("User {$user->name} berhasil dihapus");

            \Alert::success("Data user dengan role $default_role berhasil dihapus.")->autoClose(3000)->timerProgressBar();
            return redirect(route('system-users-manage.index'))->with('swal', true);
        }
        catch(\Exception $e)
        {
            \Alert::error($e->getMessage())->persistent();
            return redirect(route('system-users-manage.index'))->with('swal', false);
        }
    }
    /**
     * Store user permissions resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeuserpermissions(Request $request)
    {      
        $table_user = User::getTableName();
        
        $this->validate($request, [
            'user_id' => "required|exists:$table_user,id",
        ]);
        $post = $request->all();		
        $user_id = $post['user_id'];

        $user = User::find($user_id);			

        $permissions = isset($post['chkpermission']) ? $post['chkpermission'] : [];
        $current_permission_role = $user->permissions->pluck('name','id')->toArray();
        
        $permissions = $current_permission_role + $permissions;		
        
        $records = [];
        foreach($permissions as $perm_id=>$v)
        {
            $records[] = $perm_id;
        }
        
        $user->givePermissionTo($records);		
        
        \Alert::success('Berhasil', 'Permission user ' . $user->username . ' berhasil diubah atau ditambah.')->autoClose(3000)->timerProgressBar();
        return redirect(route('system-users-manage.show', ['id' => $user_id, 'tab' => 'permission']))->with('swal', true);
    }
    /**
     * Destroy user permissions resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function revokeuserpermission(Request $request)
    {      
        $post = $request->all();
        $name = $post['permission_name'];
        $user_id = $post['user_id'];		
        $pid = $post['pid'];		

        $user = User::find($user_id);

        $user->revokePermissionTo($name);
        
        \Alert::success('Berhasil', 'Permission '. $request->input('permission_name'). ' dari user ' . $user->name . ' berhasil dihapus.')->autoClose(3000)->timerProgressBar();
        return redirect(route("$pid.show", ['id' => $request->input('user_id'), 'tab' => 'permission']))->with('swal', true);		
    }	
    /**
     * Create user permissions resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeuserrole(Request $request)
    {
        $table_user = User::getTableName();
        $table_role = config('permission.table_names')['roles'];
        
        $this->validate($request, [
            'user_id' => "required|exists:$table_user,id",
            'role_name' => "required|exists:$table_role,name",
        ], [
            'user_id.required' => 'Silakan pilih pengguna yang akan ditambahkan role-nya',
            'user_id.exists' => 'Pengguna yang akan ditambahkan role-nya tidak terdaftar',
            'role_name.required' => 'Silakan pilih salah satu role pengguna yang akan ditambahkan',
            'role_name.exists' => 'Role pengguna yang akan ditambahkan tidak terdaftar',
        ]);
        
        $post = $request->all();		
        $user_id = $post['user_id'];
        $role_name = $post['role_name'];
        $pid = $post['pid'];		
        
        $user = User::find($user_id);			

        $daftar_role = $user->getRoleNames()->toArray();
        $daftar_role[] = $role_name;
        
        $user->syncRoles($daftar_role);

        \Alert::success('Berhasil', 'Role '. $request->input('role_name'). ' dari user ' . $user->name . ' berhasil ditambah.')->autoClose(3000)->timerProgressBar();
        return redirect(route("$pid.show", ['id' => $user_id, 'tab' => 'role']))->with('swal', true);		
    }
    /**
     * Destroy user permissions resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function revokeuserrole(Request $request)
    {      
        $table_user = User::getTableName();
        $table_role = config('permission.table_names')['roles'];

        $this->validate($request, [
            'user_id' => "required|exists:$table_user,id",
            'role_name_delete' => "required|exists:$table_role,name",
        ],[
            'user_id.required' => 'Silakan pilih pengguna yang akan dihapus role-nya',
            'user_id.exists' => 'Pengguna yang akan dihapus role-nya tidak terdaftar',
            'role_name_delete.required' => 'Silakan pilih salah satu role pengguna yang akan dihapus',
            'role_name_delete.exists' => 'Role pengguna yang akan dihapus tidak terdaftar',
        ]);

        $post = $request->all();
        $name = $post['role_name_delete'];
        $user_id = $post['user_id'];		
        $pid = $post['pid'];		

        $user = User::find($user_id);
        $daftar_role = $user->getRoleNames()->toArray();

        if (in_array($name, $daftar_role)) 
        {
            unset($daftar_role[array_search($name, $daftar_role)]);

            $role = Role::findByName($name);
            $role_permission = $role->permissions->pluck('name')->toArray();

            $user->revokePermissionTo($role_permission);      
        }    
        $user->syncRoles($daftar_role);
        
        \Alert::success('Berhasil', 'Role '. $request->input('role_name'). ' dari user ' . $user->name . ' berhasil dihapus.')->autoClose(3000)->timerProgressBar();
        return redirect(route("$pid.show", ['id' => $user_id, 'tab' => 'role']))->with('swal', true);		
    }	

    public function resetrole(Request $request, $id)
    {
        $user = User::find($id);
        
        if (is_null($user))
        {
            flash("User dengan ID ($id) tidak terdaftar.")->error();
            return back();			            
        }
        
        $user->syncRoles([$user->default_role]);

        \Alert::success("Role user  ($user->name) berhasil direset menjadi role default.")->autoClose(3000)->timerProgressBar();
        return redirect(route('system-users-manage.index'))->with('swal', true);
    }

    public function resetpermission(Request $request)
    {
        \Alert::success('Berhasil', 'Seluruh permission user masing-masing role akan direset sesuai dengan role yang dimilikinya, berhasil ditambah ke queue.')->autoClose(3000)->timerProgressBar();
        return redirect(route('system-users-manage.index'))->with('swal', true);
    }
}
