<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 06:21
 */
class UploadLibrary
{
    private $destination = 'public/images/uploads/';
    private $fileName = 'images.jpg';
    private $maxSize = '5242880'; // bytes (5242880 bytes = 5 meg)
    private $allowedExtensions = array('image/jpeg', 'image/png', 'image/gif'); // mime types
    public $printError = TRUE;
    public $error = '';

    //START: Functions to Change Default Settings
    public function setDestination($newDestination)
    {
        $this->destination = $newDestination;
    }

    public function setFileName($newFileName)
    {
        $this->fileName = $newFileName;
    }

    public function setPrintError($newValue)
    {
        $this->printError = $newValue;
    }

    public function setMaxSize($newSize)
    {
        $this->maxSize = $newSize;
    }

    public function setAllowedExtensions($newExtensions)
    {
        if (is_array($newExtensions)) {
            $this->allowedExtensions = $newExtensions;
        } else {
            $this->allowedExtensions = array($newExtensions);
        }
    }
    //END: Functions to Change Default Settings

    //START: Process File Functions
    public function upload($file)
    {
        $this->validate($file);

        if ($this->error) {
            if ($this->printError) print $this->error;
        } else {
            move_uploaded_file($file['tmp_name'], $this->destination . $this->fileName) or $this->error .= 'Upload Error: Destination Directory Permission Problem.<br />';
            if ($this->error && $this->printError) print $this->error;
        }
    }

    public function delete($file)
    {

        if (file_exists($file)) {
            unlink($file) or $this->error .= 'Delete Error: Destination Directory Permission Problem.<br />';
        } else {
            $this->error .= 'Không tìm thấy, không thể xóa ' . $file . '<br />';
        }

        if ($this->error && $this->printError) print $this->error;
    }
    //END: Process File Functions

    //START: Helper Functions
    public function validate($file)
    {
        $error = '';

        //check file exist
        if (empty($file['name'][0])) $error .= 'Không tìm thấy file.<br />';
        //check allowed extensions
        if (!in_array($this->getExtension($file), $this->allowedExtensions)) $error .= 'Định dạng không cho phép.<br />';
        //check file size
        if ($file['size'][0] > $this->maxSize) $error .= 'Kích thước file vượt quá mức cho phép. Limit: ' . ($this->maxSize/1024) . ' Kilobyte.<br />';

        $this->error = $error;
    }

    public function getExtension($file)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $ext = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        return $ext;
    }
    //END: Helper Functions
}