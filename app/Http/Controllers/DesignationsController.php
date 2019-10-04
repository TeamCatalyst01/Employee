<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;

class DesignationsController extends Controller
{
    /**
     *  Only authenticated users can access this controller
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         *  read all the comments from DepartmentsController
         *  they are all the same.
         */
        
        $designations = Designation::paginate(5);
        return view('sys_mg.designations.index')->with('designations',$designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.designations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'designation_name' => 'required|min:3|unique:designations'
        ]);
        $designation = new Designation();
        $designation->designation_name = $request->input('designation_name');
        $designation->save();
        return redirect('/designations')->with('info','New Designation has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation = Designation::find($id);
        return view('sys_mg.designations.edit')->with('designation',$designation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'designation_name' => 'required|min:3|unique:designations'
        ]);
        $designation = Designation::find($id);
        $designation->designation_name = $request->input('designation_name');
        $designation->save();
        return redirect('/designations')->with('info','Selected Designation has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return redirect('/designations')->with('info','Selected Designation has been deleted!');
    }

    /**
     *  Search For Resource(s)
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required'
        ]);
        $str = $request->input('search');
        $designations = Designation::where( 'designation_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('designation_name','asc')
            ->paginate(4);
        return view('sys_mg.designations.index')->with([ 'designations' => $designations ,'search' => true ]);
    }
}
