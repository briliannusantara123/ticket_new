<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Company;
use App\User;
use App\Project_relation;
use DB;

class ProjectsController extends Controller
{
    public function index()
    {
        $company = Company::all();
    	$projects = DB::table('projects')
                        ->leftJoin('company', 'company.idc', '=', 'projects.id_company')
                        ->select('projects.code', 'projects.nama_projects','projects.id','company.nama','projects.ticket','projects.ticket_used','projects.ticket_active')
                        ->get();
        $cek = DB::table('projects')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Projects::all()->last();
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }
    	return view('projects.index',compact('projects','nomer','urut','company'));
    }
    public function create(Request $request)
    {
        $projects =Projects::create($request->all());
        return redirect('/projects')->with('success','data berhasil disimpan');
    }
     public function edit($id)
    {
        $projects = Projects::find($id);
        $company = Company::all();
       
        return view('projects.edit',compact('projects','company'));
    }
    public function update(Request $request,$id)
    {
        $projects = Projects::find($id);
        $projects->update($request->all());
        return redirect('/projects')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $projects = Projects::find($id);
        $projects->delete($projects);
        return redirect('/projects')->with('success','Data Projects Berhasil Di Hapus');
    }
    public function p_relation($id)
    {
        $projects = DB::table('projects')->leftjoin('company','company.idc', '=', 'projects.id_company')->find($id);
        $user = User::all();
        $pr = DB::table('project_relation')->get();
        $p_relation = DB::table('project_relation')
                        ->leftJoin('projects', 'projects.id', '=', 'project_relation.id_project')
                        ->leftJoin('users', 'users.id', '=', 'project_relation.id_user')
                        ->select('projects.nama_projects','project_relation.id','users.username','users.role','project_relation.default_consultant','project_relation.created_at')
                        ->where('id_project',$id)
                        ->orderBy('default_consultant', 'desc')
                        ->get();
        
        return view('projects.p_relation',compact('p_relation','projects','user'));
    }
    public function p_relation_post(Request $request)
    { 
        $idp = $request->id_project;
        $pl = Project_relation::find('id_project');

        if ($request->default_consultant == null) {
        $pr = Project_relation::create([
            'id_project' => $request->id_project,
            'id_user' => $request->id_user,
            'email' => $request->email,
            'id_jabatan' => $request->id_jabatan,
            'default_consultant' => $request->default_consultant,
        ]);
    
        }else{
        $pr = Project_relation::create([
            'id_project' => $request->id_project,
            'id_user' => $request->id_user,
            'email' => $request->email,
            'id_jabatan' => $request->id_jabatan,
            'default_consultant' => $request->default_consultant,
        ]);
    
        }

        
        $prd = new Project_relation;
        $prd->id_project = $request->id_project;
        $prd->id_user = $request->id_user_developer;
        $prd->email = $request->emails;
        $prd->id_jabatan = $request->id_jabatans;
        $prd->save();
        return redirect()->back()->with('success','Berhasil Menambahkan Users di Projectlines');    
    }
    public function delete_pr($id)
    {
        $pr = Project_relation::find($id);
        $pr->delete($pr);
        return redirect()->back()->with('success','Users Berhasil Dihapus di Projectlines');
    }
}
