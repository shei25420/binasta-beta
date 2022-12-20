<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Addresses', [
            'addresses' => UserAddress::select('id', 'location', 'phone_number')->where('user_id', auth()->id())->map(function ($address) {
                return [
                    'id' => $address->id,
                    'location' => $address->location,
                    'phone_number' => $address->phone_number
                ];
            })
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
     * @param  \App\Http\Requests\StoreUserAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserAddressRequest $request)
    {
        $data = $request->validated();
        
        $isAdmin = auth('admin')->check();
        if(!$isAdmin) $data['id'] = auth()->id();


        $address = UserAddress::create($data);
        if($isAdmin) {
            if($request->query('res')) return response()->json($address);
            else return response()->redirectTo('/user_addresses');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAddressRequest  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }

    public function search (Request $request, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'required|string'])->validated();
        
        if(auth('admin')->check()) $data['id'] = $request->query('id');
        else $data['id'] = auth()->id();

        $addresses = UserAddress::select('id', 'location', 'phone_number')
                    ->where('user_id', $data['id'])
                    ->where('location', 'like', '%'.$data['query'].'%')
                    ->orWhere('phone_number', 'like', '%'.$data['query'].'%')
                    ->get();

        return response()->json($addresses);
    }
}
