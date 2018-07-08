<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Editor\Uploaders;

/**
 * Class UploadScrawl.
 */
class UploadScrawl extends AbstractUpload
{
    /**
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function doUpload()
    {
        $base64Data = $this->request->get($this->fileField);
        $img = base64_decode($base64Data);
        if (!$img) {
            $this->stateInfo = $this->getStateInfo('ERROR_FILE_NOT_FOUND');

            return false;
        }
        $this->oriName = $this->config['oriName'];
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = basename($this->filePath);
        $dirName = dirname($this->filePath);
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo('ERROR_SIZE_EXCEED');

            return false;
        }
        if (!file_exists($dirName) && !mkdir($dirName, 0777, true)) {
            $this->stateInfo = $this->getStateInfo('ERROR_CREATE_DIR');

            return false;
        } elseif (!is_writeable($dirName)) {
            $this->stateInfo = $this->getStateInfo('ERROR_DIR_NOT_WRITEABLE');

            return false;
        }
        if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) {
            $this->stateInfo = $this->getStateInfo('ERROR_WRITE_CONTENT');

            return false;
        } else {
            $this->stateInfo = $this->stateMap[0];

            return false;
        }
    }

    /**
     * @return string
     */
    protected function getFileExt()
    {
        return strtolower(strrchr($this->oriName, '.'));
    }
}
