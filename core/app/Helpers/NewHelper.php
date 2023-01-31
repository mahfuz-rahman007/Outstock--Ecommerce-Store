<?php



if(!function_exists('saveFile')){
    /**
     * save file
     * @param Request $request
     * @param string $filename
     * @param string $previouseFile
     * @param string $path
     */
    function saveFile($file, $fileName, $previousFile, $path)
    {
        @unlink($path . $previousFile);
        $extension = $file->getClientOriginalExtension();
        $fileFullName = $fileName.'_'.time(). '.' . $extension;
        $file->move($path,$fileFullName);
        return $fileFullName;
    }
}

?>
