<?php

namespace App\Http\Controllers;

use App\Models\BinapointsConfiguration;
use App\Http\Requests\StoreBinapointsConfigurationRequest;
use App\Http\Requests\UpdateBinapointsConfigurationRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BinapointsConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/BinapointsConfigurations', [
            'configurations' => BinapointsConfiguration::select('id', 'awarded', 'value', 'created_at')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBinapointsConfigurationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBinapointsConfigurationRequest $request)
    {
        BinapointsConfiguration::create($request->validated());
        response()->redirectTo('/configurations');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBinapointsConfigurationRequest  $request
     * @param  \App\Models\BinapointsConfiguration  $binapointsConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateBinapointsConfigurationRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:binapoints_configurations,id'])->validated()['id'];

        BinapointsConfiguration::where('id', $data['id'])->update($data);
        return response()->redirectTo('/configurations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BinapointsConfiguration  $binapointsConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:binapoints_configurations,id'])->validated()['id'];
        BinapointsConfiguration::where('id', $id)->delete();
        return response()->redirectTo('/configurations');
    }
}
