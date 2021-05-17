<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view ('slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->input('slider_title');
        $slider->message = $request->input('slider_message');
        $slider->image_url = '';
        if($slider->save()){
            $photo = $request->file('slider_image');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $file_name = rand() . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $file_name)){
                        $slider->image_url = url('/') . '/' . $file_name;
                        $slider->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Slider Saved!');
        }
        return redirect()->back()->with('failed', 'Couldn\'t save slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->title = $request->input('slider_title');
        $slider->message = $request->input('slider_message');
        $slider->image_url = '';
        if($slider->save()){
            $photo = $request->file('slider_image');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $file_name = rand() . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $file_name)){
                        $slider->image_url = url('/') . '/' . $file_name;
                        $slider->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Slider changes Saved!');
        }
        return redirect()->back()->with('failed', 'Couldn\'t save slider changes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Slider::destroy($id)){
            return redirect()->back()->with('success', 'Slider deleted successfully.');
        }
        return redirect()->back()->with('failed', 'Error while trying to delete this slider.');
    }
}
