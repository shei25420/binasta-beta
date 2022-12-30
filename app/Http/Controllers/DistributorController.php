<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Country;
use App\Models\Distributor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDistributorRequest;
use App\Http\Requests\SuspendDistributorRequest;
use App\Http\Requests\UpdateDistributorRequest;
use App\Http\Requests\ValidateDistributorRequest;
use App\Models\DistributorOrder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\Tenant;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Illuminate\Support\Facades\DB;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Distributors', [
            'distributors' => Distributor::select('id', 'parent_distributor_id', 'ref', 'country_id', 'first_name', 'last_name', 'email', 'binapoints', 'gender', 'domain', 'verified', 'suspended', 'balance', 'created_at')->with(['country' => function ($query) {
                $query->select('id', 'name');
            }, 'patron' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])->withCount('orders')->get(),
            'countries' => Country::select('id', 'name')->get()
        ]);
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
     * @param  \App\Http\Requests\StoreDistributorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorRequest $request)
    {
        $data = $request->validated();

        $ref = Str::random(4);
        while(Distributor::where('ref', $ref)->exists()) $ref = Str::random(4);
        $data['ref'] = $ref;

        Distributor::create($data);
        return response()->redirectTo('/distributors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorRequest  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorRequest $request, Distributor $distributor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributors,id'])->validated()['id'];
        Distributor::where('id', $id)->delete();

        return response()->redirectTo('/distributors');
    }

    public function search ($subdomain, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'required|string'])->validated();
        return response()->json(Distributor::select('id', 'name', 'email')->where('name', 'LIKE', '%'.$data['query'].'%')->orWhere('email', 'LIKE', '%'.$data['query'].'%')->get());
    }

    public function fetchDistributorIdByRef ($subdomain, $ref) {
        $data = Validator::make(['ref' => $ref], ['ref' => 'required|exists:distributors,ref'])->validated();
        return response()->json(Distributor::select('id')->where('ref', $data['ref'])->first());
    }

    public function suspend (SuspendDistributorRequest $request) {
        $data = $request->validated();

        Distributor::where('id', $data['distributor_id'])->update(['suspended' => true]);
        return response()->redirectTo('/distributors');
    }

    public function verify (ValidateDistributorRequest $request) {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $distributor = Distributor::find($data["distributor_id"]);

            $website = new Website;
            app(WebsiteRepository::class)->create($website);
            
            $hostname = new Hostname;
            $hostname->fqdn = $distributor->domain.".".config("app.domain");
            $hostname = app(HostnameRepository::class)->create($hostname);

            app(HostnameRepository::class)->attach($hostname, $website);
            
            $tenancy = app(Environment::class);
            
            $tenancy->hostname($hostname);
            $tenancy->tenant($website);

            $distributor->verified = true;
            $distributor->save();
        }, 5);

        return response()->redirectTo('/distributors');
    }

}
