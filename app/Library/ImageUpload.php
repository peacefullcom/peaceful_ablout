<?php
/**
 * ClassName: ImageUpload
 * 图片上传
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Library;


class ImageUpload
{  
    protected $allowedExt = ["png", "jpg", "gif", "jpeg"];


    /**
     * 图片上传
     * @param Request $request
     * @return mixed
     */
    public function save($file, $folder, $filePrefix)
    {
        $folderName = "uploads/images/$folder/" . date("Ym/d", time());
        $uploadPath = public_path() . '/' . $folderName;
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $fileName = $filePrefix . '_' . time() . '_' . mt_rand(0, 10) . '.' . $extension;
        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }
        $file->move($uploadPath, $fileName);
        return "/$folderName/$fileName";
    }


}