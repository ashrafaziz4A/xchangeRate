<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ExchangeRate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        return [
			'status' 	=> 'success',
			'list'		=> Purchase::where('user_id' , $user_id)->get()
			
		];
	}

    public function store($postData)
    {	
		if (isset($postData['user_id'])){
			$purchase = new Purchase;
			$purchase->user_id = $postData['user_id'];
			$purchase->name = $postData['name'] ?? '';
			$purchase->price_in_rm = $postData['price_in_rm'] ?? '';
			$purchase->exchange_rate = $postData['exchange_rate'];
			
			$purchase->exchange_rate_date = $postData['exchange_rate_date']  ?? Carbon::now();
			$purchase->save();
			return [
				'status' 	=> 'success'
			];
		}
		return [
			'status' 	=> 'false'
		];
    }

    public function update(Request $request)
    {
        $postData = $request->all()['data'];
		if (isset($postData['id'])){
			$purchase = Purchase::find($postData['id']);
			$purchase->name = $postData['name'];
			$purchase->price_in_rm = $postData['price_in_rm'];
			$purchase->save();
			return [
				'status' => 'success'
			];
		}else{
			return $this->store($postData);
		}
		

    }

    public function destroy($id)
    {
		$purchase = Purchase::where('id' , $id);
		$purchase->delete();
		return [
			'status' => 'success'
		];
    }
}
