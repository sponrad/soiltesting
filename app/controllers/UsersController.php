<?php

class UsersController extends BaseController {
    protected $layout = "main";

    public function __construct(){
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=> array(
            'getHome',
            'getProject',
            'postProject',
            'getSettings',
        )));
    }

    public function getRegister() {
        return View::make('users.register');
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postSignin() {
        if (Auth::attempt(
            array(
                'email'=>Input::get('email'), 
                'password'=>Input::get('password')), 
            true)
        ) {
//            return Redirect::to('users/home')->with('message', 'You are now logged in!');
            return Redirect::to('/home');
        } else {
            return Redirect::to('/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }        
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/')->with('message', 'Logout successful');
    }

    public function getHome(){
        $user = Auth::user();
        $projects = Project::where("account_id", "=", $user->account->id)->get()->sortBy('name');
        return View::make('users.home')->with(
            array(
                'projects' => $projects
            ));
    }
    
    public function postHome(){
        //create a new project
        $action = Input::get('action');
        if ($action == "createproject"){
            $user = Auth::user();
            $project = new Project;
            $project->account()->associate($user->account);
            $project->name = Input::get('projectname');
            $project->save();
        }
        return Redirect::to('/home')->with('message', 'Project created');
    }

    public function getProject($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);
        $tests = Test::where("project_id", "=", $project->id)->get();
        $proctors = Proctor::where("project_id", "=", $project->id)->get();
        
        return View::make('users.project')->with(
            array(
                "project" => $project,
                "tests" => $tests,
                "proctors" => $proctors,
            ));
    }

    public function postProject($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);

        $action = Input::get('action');

        if ($action == "createproctor"){
            $user = Auth::user();
            $proctor = new Proctor;
            $proctor->project()->associate($project);
            $proctor->name = Input::get('name');
            $proctor->description = Input::get('description');
            //$proctor->date = Input::get('date');
            $proctor->density_dry = Input::get('density_dry');
            $proctor->percent_moisture = Input::get('percent_moisture');
            $proctor->density_wet = $proctor->density_dry * (1 + $proctor->percent_moisture/100);
            $proctor->save();

            return Redirect::to('/home/'.$project->id.'-'.$project->name)->with('message', 'Project created');
        }

    }

    public function getFolder($folderId, $folderName){
        $user = Auth::user();
        $folder = Folder::find($folderId);
        $files = TFile::where("folder_id", "=", $folder->id)->get();
        
        return View::make('users.folder')->with(
            array(
                "folder" => $folder,
                "files" => $files,
            ));
    }

    public function getSettings(){
        return View::make('users.settings');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$register_rules);
 
        if ($validator->passes()) {
            // validation has passed, create user
            $account = new Account;
            $account->companyname = Input::get('companyname');
            $account->save();

            $user = new User;
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->account()->associate($account);
            $user->save();
 
            return Redirect::to('/login')->with('message', 'Thanks for registering!');
        } else {
            // validation has failed, display error messages   
            return Redirect::to('/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            
        }        
    }
}

?>