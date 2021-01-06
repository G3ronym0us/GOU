<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Documentation;
class DocumentationController extends Controller
{
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
        return view('documentation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documentation = Documentation::where('user_id','=',$id)->first();
        return view('documentation.show',['documentation' => $documentation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $documentation = Documentation::where('user_id','=',$id)->first();

        if($request->get('license')){
            $documentation->license=$request->license;
            $fileName = time().'.'.$request->license_img->extension();  
            $documentation->license_img = $fileName;
            $request->license_img->move(public_path('img'), $fileName);
        }

        if($request->get('carlicense')){
            $documentation->carlicense=$request->carlicense;
            $fileName = time().'.'.$request->carlicense_img->extension();  
            $documentation->carlicense_img = $fileName;
            $request->carlicense_img->move(public_path('img/carlicense'), $fileName);
        }

        if($request->get('insuranse')){
            $documentation->insuranse=$request->insuranse;
            $fileName = 'user'.$id.'-'.time().'.'.$request->insuranse_img->extension();  
            $documentation->insuranse_img = $fileName;
            $request->insuranse_img->move(public_path('img/insuranse'), $fileName);
        }

        if($request->get('vtv')){
            $documentation->vtv=$request->vtv;
            $fileName = 'user'.$id.'-'.time().'.'.$request->vtv_img->extension();  
            $documentation->vtv_img = $fileName;
            $request->vtv_img->move(public_path('img/vtv'), $fileName);
        }

        if($request->front_img){

            $fileName = 'user'.$id.'-'.time().'.'.$request->front_img->extension();  
            $documentation->front_img = $fileName;
            $request->front_img->move(public_path('img/front_car'), $fileName);
        }

        if($request->back_img){
            $fileName = 'user'.$id.'-'.time().'.'.$request->back_img->extension();  
            $documentation->back_img = $fileName;
            $request->back_img->move(public_path('img/back_car'), $fileName);
        }

        if($request->right_img){
            $fileName = 'user'.$id.'-'.time().'.'.$request->right_img->extension();  
            $documentation->right_img = $fileName;
            $request->right_img->move(public_path('img/right_car'), $fileName);
        }

        if($request->left_img){
            $fileName = 'user'.$id.'-'.time().'.'.$request->left_img->extension();  
            $documentation->left_img = $fileName;
            $request->left_img->move(public_path('img/left_car'), $fileName);
        }

    	

        $documentation->update();
        return redirect('/documentation/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function approveDocument(Request $request, $id)
    {
        $documentation = Documentation::find($id);
        switch ($request->document) {
            case 'license':
                $documentation->license_status = true;
                break;
            case 'carlicense':
                $documentation->carlicense_status = true;
                break;
            case 'insurance':
                $documentation->insurance_status = true;
                break;
            case 'vtv':
                $documentation->vtv_status = true;
                break;
            case 'front_img':
                $documentation->front_status = true;
                break;
            case 'back_img':
                $documentation->back_status = true;
                break;
            case 'right_img':
                $documentation->right_status = true;
                break;
            case 'left_img':
                $documentation->left_status = true;
                break;
            default:
                # code...
                break;
        }
        $documentation->update();
        return redirect('/documentation/'.$request->user_id);
        
    }

    public function rejectDocument(Driver $driver, $value)
    {
        $backName = $value.'1';
        $driver->documentation->$value = 2;
        $driver->documentation->$backName = 2;
        $driver->validated = false;
        $driver->documentation->save();

        return redirect('/admin/driver/show/'.$driver->id)->with('message','Documentación rechazada correctamente.');
    }

}
