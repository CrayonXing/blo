<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 上传文件控制器
 *
 * Class UploadController
 * @package App\Http\Controllers\Web
 */
class UploadController extends CController
{

    /**
     * 图片上传接口
     *
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

        $files = $request->only(['editormd-image-file','file-img']);
        if(empty($files)){
            $data['message'] = '获取上传文件信息失败...';
            return response()->json($data);
        }

        $file = $request->file(key($files));
        if (!$file->isValid()) {
            $data['message'] = '上传文件验证错误...';
            return response()->json($data);
        }

        if (!in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg', 'gif'])) {
            return $this->ajaxReturn(305, '不支持此类文件上传');
        }

        $path = Storage::disk('public')->put(date('Ymd'), $file);
        if($path){
            $data['success'] = 1;
            $data['message'] = '上传文件成功...';
            $data['url']     = "/storage/{$path}";
        }else{
            $data['message'] = '上传文件失败...';
        }

        return response()->json($data);
    }
}