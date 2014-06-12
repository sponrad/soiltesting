@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>
@stop

@section('content') 
  <div class="row">
    <style scope>
     h2 {
       padding-top: 65px;
       margin-top: -65px;
     }
    </style>
    <div class="col-md-3">

      <ul class="nav" data-spy="affix">
	<h2>DensityPro Help</h2>
	<li><a href="#createproject">Create A Project</a></li>
	<li><a href="#addmaximumdensity">Enter A Maximum Density</a></li>
	<li><a href="#addatest">Record A Test</a></li>
	<li><a href="#edittest">Edit A Test</a></li>
	<li><a href="#addprojectnotes">Make Project Notes</a></li>
	<li><a href="#editmaximumdensity">Edit A Maximum Density</a></li>
	<li><a href="#deleteproject">Delete A Project</a></li>
	<li><a href="#exportdata">Export Project Data</a></li>
      </ul>
    </div>

    <div class="col-md-9">
      <h2 id="createproject">Create a Project</h2>
      <p>To create a new project you must first have an account. Register for an account and log in. After successfully logging in you will be taken to your Company's Home screen. Click the "New Project" button and give your project a name before clicking "Create". The project will always be accessible via the Home page. Click a project to be taken to it's Overview page.</p>


      <h2 id="addmaximumdensity">Add a Maximum Density</h2>
      <p>Maximum Density's are managed on the project Overview page. Access your project's Overview page by logging in and clicking your project. Near the bottom of the page is the Maximum Density section. Click the "Add Maximum Density" button. Enter at a minimum a Dry Density and Percent Moisture before clicking "Add Maximum Density". It is very helpful to also name and describe maximum density values. It is important to have at least one maximum density stored before recording any density tests.</p>

      <h2 id="editmaximumdensity">Edit a Maximum Density</h2>
      <p>Edit a maximum density by clicking the blue edit icon next to it from the project Overview page. Be careful, editing values for a maximum density will affect all tests that reference that density.</p>

      <h2 id="addatest">Record a Test</h2>
      <p>To record a test click the blue "Record Test" button in the navigation bar. The button appears on all project pages after a project has been selected from the Home page. If you are on a mobile device you will need to first expand the menu by clicking the expand button at the top right of the screen.</p>

      <h2 id="edittest">Edit a Test</h2>
      <p>Tests can be edited from the Tests page which is accessed by clicking the "Tests" tab from the project Overview page. All tests will be displayed in a table on this page. Edit a test by first clicking it to expand it, revealing a blue "Edit" button. Clicking the "Edit" button will take you to the dedicated test edit page. Test notes can be edited without going to the test edit page.</p>

      <h2 id="addprojectnotes">Add Project Notes</h2>
      <p>Project notes are a good way to record day to day information about a project, think of them as sticky notes that are much harder to lose. To make project notes go to the project Overview page and click inside of the dashed "Notes" area. You will be able to add and edit text notes. When done click the blue check button.</p>
      
      <h2 id="deleteproject">Delete a Project</h2>
      <p>To delete a project click "Delete Project" from the project Overview page. You will be asked to confirm before project is removed. When a project is deleted it is gone completely and cannot be restored.</p>

      <h2 id="exportdata">Export Project Data</h2>
      <p>Project data can be exported with the click of one button. Click "CSV Export" from the project Overview page. Your data will be gathered and compiled into a ".csv" file which can be imported into many different software suites including Microsoft Excel. Exported data includes project information, maximum densities, and all density tests.</p>

    </div>

  </div>
@stop
