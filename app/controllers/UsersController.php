<?php

class UsersController extends BaseController {
    protected $layout = "main";

    public function __construct(){
        $this->beforeFilter('csrf', array('on'=>'post', 'except'=>'postEditable'));
        $this->beforeFilter('auth', array('only'=> array(
            'getHome',
            'getProject',
            'postProject',
            'getSettings',
            'postSettings',
            'getProjectTests',
            'postProjectTests',
            'getProjectFiles',
            'postProjectFiles',
            'postEditable',
            'getTest',
            'postTest',
            'getProctor',
            'postProctor',
            'getProjectExport',
        )));
    }

    public function getAbout() {
        return View::make('users.about');
    }

    public function getFeatures() {
        return View::make('users.features');
    }

    public function getContact() {
        return View::make('users.contact');
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
        $tests = Test::where("project_id", "=", $project->id)->orderBy("number", "DESC")->take(5)->get();
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
            $proctor = new Proctor;
            $proctor->project()->associate($project);
            $proctor->name = Input::get('name');
            $proctor->description = Input::get('description');
            //$proctor->date = Input::get('date');
            $proctor->density_dry = Input::get('density_dry');
            $proctor->percent_moisture = Input::get('percent_moisture');
            $proctor->density_wet = $proctor->density_dry * (1 + $proctor->percent_moisture/100);
            $proctor->save();

            return Redirect::to('/home/'.$project->id.'-'.$project->name)->with('message', 'Maximum Density Added');
        }

        if ($action == "changeprojectname"){
            $project->name = Input::get("projectname");
            $project->save();
            return Redirect::to('/home/'.$project->id.'-'.$project->name)->with('message', 'Project name changed');
        }

        if ($action == "deleteproject"){
            Proctor::where("project_id", "=", $project->id)->delete();
            Test::where("project_id", "=", $project->id)->delete();
            $project->delete();

            return Redirect::to('/home')->with('message', 'Project deleted');
        }

    }

    public function getProjectTests($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);
        $tests = Test::where("project_id", "=", $project->id)->orderBy("number", "DESC")->get();
        $proctors = Proctor::where("project_id", "=", $project->id)->get();
        
        return View::make('users.projecttests')->with(
            array(
                "project" => $project,
                "tests" => $tests,
                "proctors" => $proctors,
            ));
    }

    public function postProjectTests($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);
        $action = Input::get("action");

        if ($action == "createtest"){
            $user = Auth::user();
            $test = new Test;
            $test->project()->associate($project);
            $test->density_wet = Input::get('density_wet');
            $test->density_dry = Input::get('density_dry');
            $test->percent_moisture = Input::get('percent_moisture');
            $proctor = Proctor::find( intval(Input::get('proctor')) );
            $test->proctor()->associate( $proctor );
            $test->elevation = Input::get('elevation');
            $test->location = Input::get('location');
            $test->notes = Input::get('notes');
            $test->number = Test::where("project_id", "=", $project->id)->count() + 1;

            $test->save();

            return Redirect::to('/home/'.$project->id.'-'.$project->name.'/tests')->with('message', 'Test Added');
        }
    }

    public function getTest($projectId, $projectName, $testId){
        $user = Auth::user();
        $project = Project::find($projectId);
        $test = Test::find($testId);
        $proctors = Proctor::where("project_id", "=", $project->id)->get();
        
        return View::make('users.test')->with(
            array(
                "project" => $project,
                "test" => $test,
                "proctors" => $proctors,
            ));
    }

    public function postTest($projectId, $projectName, $testId){
        $action = Input::get("action");
        $user = Auth::user();
        $project = Project::find($projectId);
        $test = Test::find($testId);

        if ($action == "edittest"){
            $test->density_wet = Input::get('density_wet');
            $test->density_dry = Input::get('density_dry');
            $test->percent_moisture = Input::get('percent_moisture');
            $proctor = Proctor::find( intval(Input::get('proctor')) );
            $test->proctor()->associate( $proctor );
            $test->elevation = Input::get('elevation');
            $test->location = Input::get('location');
            $test->notes = Input::get('notes');
            $test->retest_of_number = Input::get('retest') ? Input::get('retest') : null;

            $test->save();

            return Redirect::to('/home/'.$project->id.'-'.$project->name.'/tests#test'.$test->number)->with('message', 'Test Edited');
        }
    }

    public function getProctor($projectId, $projectName, $proctorId){
        $user = Auth::user();
        $project = Project::find($projectId);
        $editingproctor = Proctor::find($proctorId);
        $proctors = Proctor::where("project_id", "=", $project->id)->get();
        
        return View::make('users.proctor')->with(
            array(
                "project" => $project,
                "editingproctor" => $editingproctor,
                "proctors" => $proctors,
            ));
    }

    public function postProctor($projectId, $projectName, $proctorId){
        $action = Input::get("action");
        $user = Auth::user();
        $project = Project::find($projectId);
        $proctor = Proctor::find($proctorId);

        if ($action == "editproctor"){
            $proctor->name = Input::get('name');
            $proctor->description = Input::get('description');
            //$proctor->date = Input::get('date');
            $proctor->density_dry = Input::get('density_dry');
            $proctor->percent_moisture = Input::get('percent_moisture');
            $proctor->density_wet = $proctor->density_dry * (1 + $proctor->percent_moisture/100);
            $proctor->save();

            //TODO check for any affected tests

            return Redirect::to('/home/'.$project->id.'-'.$project->name)->with('message', 'Maximum Density Saved');
        }
    }

    public function getProjectExport($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);
        $proctors = Proctor::where("project_id", "=", $project->id)->get();
        $tests = Test::where("project_id", "=", $project->id)->orderBy("number", "DESC")->get();

        $file = fopen('file.csv', 'w');

        $output = "";

        $output.= $project->name."\r\n".$project->account->companyname."\r\n";

        $output.="\r\nMaximum Densities:\r\n";
        $output.="ID, Created, Edited, Project ID, Name, Date, Wet Density, Dry Density, Percent Moisture, Description\r\n";
        foreach ($proctors as $row) {
            $output.=  implode(",",$row->toArray()) . "\r\n";
        }
        $output.= "\r\nTests:\r\n";
        $output.="ID, Created, Edited, Project ID, Maximum Density ID, Number, Date, Elevation, Latitude, Longitude, Description, Location, Notes, Wet Density, Dry Density, Percent Moisture, Density Required, Retest of Number, Pass, Relative Compaction\r\n";
        foreach ($tests as $row) {
            $output.=  implode(",",$row->toArray()) . ",".$row->percent_compaction().",\r\n";
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$project->name.'.csv"',
        );

        return Response::make(rtrim($output, "\n"), 200, $headers);
    }

    public function getProjectFiles($projectId, $projectName){
        $user = Auth::user();
        $project = Project::find($projectId);        
        
        return View::make('users.projectfiles')->with(
            array(
                "project" => $project,       
            ));
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
        $user = Auth::user();
        return View::make('users.settings');
    }

    public function postSettings(){
        $user = Auth::user();
        $account = $user->account();
        $password = Input::get('password');
        $password_confirmation = Input::get('password_confirmation');

        if ($password == $password_confirmation && $password != ""){
            $user->password = Hash::make(Input::get('password'));                    }

        $user->save();
        
        return Redirect::to('/settings')->with('message', 'Settings Saved');
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

    public function postEditable() {
        $inputs = Input::all();
        switch ( $inputs['action'] ) {
        case "testnotes":
            $entity = Test::find(intval($inputs['pk']));
            $entity->$inputs['name'] = $inputs['value'];
            break;
        case "projectnotes":
            $entity = Project::find(intval($inputs['pk']));
            $entity->$inputs['name'] = $inputs['value'];
            break;
        }
        return strval($entity->save());
    }
}

?>