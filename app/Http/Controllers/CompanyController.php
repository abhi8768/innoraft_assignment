<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$company =  Company::orderBy('id','DESC')->paginate(10);
        return view('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$alldata = $request->all();
        $this->validate($request, [
        	'name' => 'required',
        	'email' => 'required',
        	'website' => 'required',
            'logo' => 'required|dimensions:min_width=100,min_height=100|mimes:jpg,png,jpeg',
        ]);
        $images = $request->file('logo');
        //echo $images;die;
        if ($images) {
        	$path = Storage::path('public/company_logo/');
            if (!file_exists($path)) {
			    mkdir($path, 0777, true);
			}
            $extension = $images->getClientOriginalExtension(); // getting image extension
            $imageName = time() . '.' . $extension; // renameing file
            if($images->move($path, $imageName)){
                $imagename= $imageName;
            }
        } 
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->logo = $imagename;        
        if($company->save()){
            return back()->with("success", "Company Successfully Created.");
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
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
        $company = Company::find($id);
        return view('company.edit',compact('company'));
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
        $images = $request->file('logo');
        if($images){
           $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'website' => 'required',
                'logo' => 'required|dimensions:min_width=100,min_height=100|mimes:jpg,png,jpeg',
            ]);            
            $path = Storage::path('public/company_logo/');
            $extension = $images->getClientOriginalExtension(); // getting image extension
            $imageName = time() . '.' . $extension; // renameing file
            if($images->move($path, $imageName)){
                $imagename= $imageName;
                $pre_image = $request->pre_image;
                Storage::delete('public/company_logo/'.$pre_image);
            }            
       }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'website' => 'required',
            ]);
            $imagename = $request->pre_image;
       }
       $company =  Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->logo = $imagename;        
        if($company->update()){
            return back()->with("success", "Company Successfully Updated.");
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $imagename = $company->logo;
        Storage::delete('public/company_logo/'.$imagename);
        if($company->delete()){
            return redirect()->back()->with('success', 'Successfully Deleted Company Record.');
        }else{
            return back()->withInput()->with("error", "Sorry! Some error occured. Please try again.");
        }
    }
}
