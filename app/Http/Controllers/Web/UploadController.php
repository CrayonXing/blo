<?php


namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;


class UploadController extends CController
{

    /**
     * 文章图片上传接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $request){
        $data = [
            'success'=>0,// 0 表示上传失败，1 表示上传成功
            'message'=>"提示的信息，上传成功或上传失败及错误信息等。",
            'url'=>''
        ];

        if (!$request->isMethod('post')) {
            $data['message'] = '接口请求方式错误...';
            return response()->json($data);
        }

        $file = $request->file('editormd-image-file');
        if(!$file){
            $file = $request->file('file-img');
        }

        if (!$file->isValid()) {
            $data['message'] = '上传文件验证错误...';
            return response()->json($data);
        }

        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径

        // 上传文件
        $filename = '001/'.date('Ymd').'/'. md5(date('His').uniqid()) . '.' . $ext;
        $bool = \Storage::disk('uploads')->put($filename, file_get_contents($realPath));
        if($bool){
            $data['success'] = 1;
            $data['message'] = '上传文件成功...';
            $data['url'] = url("/uploads/{$filename}");
        }else{
            $data['message'] = '上传文件失败...';
        }

        return response()->json($data);
    }
}