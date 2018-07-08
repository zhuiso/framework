<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Editor\Uploaders;

use Illuminate\Http\Request;

/**
 * Class AbstractUpload.
 */
abstract class AbstractUpload
{
    protected $fileField;

    protected $file;

    protected $base64;

    protected $config;

    protected $fileName;

    protected $fullName;

    protected $filePath;

    protected $fileSize;

    protected $fileType;

    /**
     * @var \Zs\Foundation\Image\ImageManager
     */
    protected $image;

    protected $oriName;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    protected $stateInfo;

    protected $stateMap;

    abstract public function doUpload();

    /**
     * AbstractUpload constructor.
     *
     * @param array                    $config
     * @param \Illuminate\Http\Request $request
     * @param                          $image
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(array $config, Request $request, $image)
    {
        $this->config = $config;
        $this->image = $image;
        $this->request = $request;
        $this->fileField = $this->config['fieldName'];
        if (isset($config['allowFiles'])) {
            $this->allowFiles = $config['allowFiles'];
        } else {
            $this->allowFiles = [];
        }
        $stateMap = [
            'SUCCESS',
            trans('UEditor::upload.upload_max_filesize'),
            trans('UEditor::upload.upload_error'),
            trans('UEditor::upload.no_file_uploaded'),
            trans('UEditor::upload.upload_file_empty'),
            'ERROR_TMP_FILE'           => trans('UEditor::upload.ERROR_TMP_FILE'),
            'ERROR_TMP_FILE_NOT_FOUND' => trans('UEditor::upload.ERROR_TMP_FILE_NOT_FOUND'),
            'ERROR_SIZE_EXCEED'        => trans('UEditor::upload.ERROR_SIZE_EXCEED'),
            'ERROR_TYPE_NOT_ALLOWED'   => trans('UEditor::upload.ERROR_TYPE_NOT_ALLOWED'),
            'ERROR_CREATE_DIR'         => trans('UEditor::upload.ERROR_CREATE_DIR'),
            'ERROR_DIR_NOT_WRITEABLE'  => trans('UEditor::upload.ERROR_DIR_NOT_WRITEABL'),
            'ERROR_FILE_MOVE'          => trans('UEditor::upload.ERROR_FILE_MOVE'),
            'ERROR_FILE_NOT_FOUND'     => trans('UEditor::upload.ERROR_FILE_NOT_FOUND'),
            'ERROR_WRITE_CONTENT'      => trans('UEditor::upload.ERROR_WRITE_CONTENT'),
            'ERROR_UNKNOWN'            => trans('UEditor::upload.ERROR_UNKNOWN'),
            'ERROR_DEAD_LINK'          => trans('UEditor::upload.ERROR_DEAD_LINK'),
            'ERROR_HTTP_LINK'          => trans('UEditor::upload.ERROR_HTTP_LINK'),
            'ERROR_HTTP_CONTENTTYPE'   => trans('UEditor::upload.ERROR_HTTP_CONTENTTYPE'),
            'ERROR_UNKNOWN_MODE'       => trans('UEditor::upload.ERROR_UNKNOWN_MODE'),
        ];
        $this->stateMap = $stateMap;
    }

    /**
     * @return array
     */
    public function upload()
    {
        $this->doUpload();

        return $this->getFileInfo();
    }

    /**
     * @param $errCode
     *
     * @return mixed
     */
    protected function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap['ERROR_UNKNOWN'] : $this->stateMap[$errCode];
    }

    /**
     * @return bool
     */
    protected function checkSize()
    {
        return $this->fileSize <= ($this->config['maxSize']);
    }

    /**
     * @return string
     */
    protected function getFileExt()
    {
        return '.' . $this->file->getClientOriginalExtension();
    }

    /**
     * @return string
     */
    protected function getFullName()
    {
        $t = time();
        $d = explode('-', date('Y-y-m-d-H-i-s'));
        $format = $this->config['pathFormat'];
        $format = str_replace('{yyyy}', $d[0], $format);
        $format = str_replace('{yy}', $d[1], $format);
        $format = str_replace('{mm}', $d[2], $format);
        $format = str_replace('{dd}', $d[3], $format);
        $format = str_replace('{hh}', $d[4], $format);
        $format = str_replace('{ii}', $d[5], $format);
        $format = str_replace('{ss}', $d[6], $format);
        $format = str_replace('{time}', $t, $format);
        $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
        $oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
        $format = str_replace('{filename}', $oriName, $format);
        $randNum = rand(1, 10000000000) . rand(1, 10000000000);
        if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
            $format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
        }
        $ext = $this->getFileExt();

        return $format . $ext;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFilePath()
    {
        $fullName = $this->fullName;
        $rootPath = static_path();
        $fullName = ltrim($fullName, '/');

        return $rootPath . '/' . $fullName;
    }

    /**
     * @return bool
     */
    protected function checkType()
    {
        return in_array($this->getFileExt(), $this->config['allowFiles']);
    }

    /**
     * @return array
     */
    public function getFileInfo()
    {
        return [
            'state'    => $this->stateInfo,
            'url'      => $this->fullName,
            'title'    => $this->fileName,
            'original' => $this->oriName,
            'type'     => $this->fileType,
            'size'     => $this->fileSize,
        ];
    }
}
