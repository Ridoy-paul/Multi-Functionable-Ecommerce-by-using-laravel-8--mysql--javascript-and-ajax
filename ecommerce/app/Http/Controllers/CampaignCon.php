<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CampaignCon extends Controller
{
    // Wallet index page
    public function index(){
        $allWallets = DB::table('admin_wallets')->orderBy('id', 'DESC')->get();
        return view('cms.wallet.all_wallet', compact('allWallets'));
    }

    // Add Campaign Wallet Function
    public function AddCampaign(Request $request){
        $request->validate([
            'campaign_name' => 'required|unique:admin_wallets',
        ]);


        $data = array();
        $data['campaign_name'] = $request->campaign_name;
        $data['type'] = $request->type;
        $data['point_or_tk'] = $request->point_or_tk;
        $data['price_amount'] = $request->price_amount;
        $data['maximum_buy'] = $request->maximum_buy;
        $data['start_date'] = $request->start_date;
        $data['exp_date'] = $request->exp_date;
        $data['active'] = $request->active;
        $data['created_at'] = date("Y-m-d");

        DB::table('admin_wallets')->insert($data);
        return Redirect()->back()->with('status', 'New Campaign Added Successfully');

    }

    // Edit Campaign Wallet Function
    public function EditCampaignWallet($id){
        $wallet = DB::table('admin_wallets')->where('id', $id) ->first();
        return view('cms.wallet.edit_wallet', compact('wallet'));
    }

    // Update Promo Function
    public function UpdateCampaignWallet(Request $request, $id){

        $data = array();
        $data['campaign_name'] = $request->campaign_name;
        $data['type'] = $request->type;
        $data['point_or_tk'] = $request->point_or_tk;
        $data['price_amount'] = $request->price_amount;
        $data['maximum_buy'] = $request->maximum_buy;
        $data['start_date'] = $request->start_date;
        $data['exp_date'] = $request->exp_date;
        $data['active'] = $request->active;
        $data['updated_at'] = date("Y-m-d");

        DB::table('admin_wallets')-> where('id', $id) ->update($data);
        return Redirect() ->route('all_wallet')->with('status', 'Wallet Campaign Update Successfully');
    }

    // Update Wallet Setting Function
    public function UpdateWalletSetting(Request $request, $id){

        $data = array();
        $data['minimum_point_to_convert'] = $request->minimum_point_to_convert;
        $data['point_to_tk_convert_rate'] = $request->point_to_tk_convert_rate;
        $data['purchase_point'] = $request->purchase_point;
        $data['minimum_purchase_amount_in_tk_use_wallet_bl'] = $request->minimum_purchase_amount_in_tk_use_wallet_bl;
        $data['updated_at'] = date("Y-m-d");

        DB::table('shop_settings')-> where('id', $id) ->update($data);
        return Redirect() ->route('all_wallet')->with('status', 'Wallet Point Setting Update Successfully');
    }

    


}
