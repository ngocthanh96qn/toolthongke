<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\tokenPage;
use App\Http\Requests\TeamAbRequest;
class TeamAb extends Controller
{
    public function index(){
    	$pages = tokenPage::all();
    	$data_page = array();
    	foreach ($pages as $key => $page) {
    		$response = Http::get('https://graph.facebook.com/'.$page->id_page.'/insights/page_posts_impressions_unique?access_token='.$page->token);
    		if(isset($response->json()['error'])){
    			$data_page[$key]['name']=$page->name_page;
    			$data_page[$key]['id']=$page->id;
    			$data_page[$key]['yesterday']['not_paid']='lỗi token';
    			$data_page[$key]['BeforeYesterday']['not_paid']='lỗi token';
    			$data_page[$key]['28days']['not_paid']='lỗi token';
    			$data_page[$key]['yesterday']['paid']='lỗi token';
    			$data_page[$key]['BeforeYesterday']['paid']='lỗi token';
    			$data_page[$key]['28days']['paid']='lỗi token';
    		}
    		else {
    			while (isset($response->json()['paging']['next'])) {
    				$response = Http::get($response->json()['paging']['next']);
    			}
    			$response = Http::get($response->json()['paging']['previous']);
    			$data_page[$key]['name']=$page->name_page;
    			$data_page[$key]['id']=$page->id;
    			$data_page[$key]['yesterday']['not_paid']=number_format($response->json()['data'][0]['values'][1]['value'],'0','.','.');
    			$data_page[$key]['BeforeYesterday']['not_paid']=number_format($response->json()['data'][0]['values'][0]['value'],'0','.','.');
    			$data_page[$key]['28days']['not_paid']=number_format($response->json()['data'][2]['values'][1]['value'],'0','.','.');

    			$response = Http::get('https://graph.facebook.com/'.$page->id_page.'/insights/page_impressions_paid_unique?access_token='.$page->token);
    			while (isset($response->json()['paging']['next'])) {
    				$response = Http::get($response->json()['paging']['next']);
    			}
    			$response = Http::get($response->json()['paging']['previous']);
    			$data_page[$key]['yesterday']['paid']=number_format($response->json()['data'][0]['values'][1]['value'],'0','.','.');
    			$data_page[$key]['BeforeYesterday']['paid']=number_format($response->json()['data'][0]['values'][0]['value'],'0','.','.');
    			$data_page[$key]['28days']['paid']= number_format($response->json()['data'][2]['values'][1]['value'],'0','.','.');
    		}
    	}
    	// dd($data_page);
    	return view('pages.pageTeamAb',compact('data_page'));
    }
    public function store(TeamAbRequest $request){
    	$data = $request->except('_token');
    	tokenPage::create($data);
    	return redirect()->route('menu.teamAb');

    }
    public function destroy(Request $request){
    	tokenPage::find($request->id)->delete();
    	return redirect()->route('menu.teamAb');

    }
}
