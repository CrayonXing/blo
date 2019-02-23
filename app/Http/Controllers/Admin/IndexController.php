<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 后台主页面
     * @return string
     */
    public function index(Request $request){



    	$data = [
    		[
    			'id'			=>0,
    			'title'			=>'',
    			'describe'		=>'',
    			'imgs'			=>[
    				'http://47.105.180.123/web/images/text02.jpg',
    			],
    			'release_time'	=>'',
    			'tags'			=>[
    				'Tag1','Tag2','Tag3'
    			],
    			'visit'			=>0,
    		],
    		[
    			'id'			=>0,
    			'title'			=>'',
    			'describe'		=>'',
    			'imgs'			=>[
    				'http://47.105.180.123/web/images/text02.jpg',
    			],
    			'release_time'	=>'',
    			'tags'			=>[
    				'Tag1','Tag2','Tag3'
    			],
    			'visit'			=>0,
    		],
    		[
    			'id'			=>0,
    			'title'			=>'',
    			'describe'		=>'',
    			'imgs'			=>[
    				'http://47.105.180.123/web/images/text02.jpg',
    			],
    			'release_time'	=>'',
    			'tags'			=>[
    				'Tag1','Tag2','Tag3'
    			],
    			'visit'			=>0,
    		]
    	];

   






        return view('admin.index.index');
    }
}
