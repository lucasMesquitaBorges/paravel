<?php

namespace App\Classes;

use Storage;

class FileManipulation {

	private $file;
	private $fileName;
	private $fullFileName;
	private $fileDirectory;
	private $storageFilePath;

	public function storageFile($createFolder = '', $disk = 'local') {

		if(!empty($createFolder)) {
			$createFolder .= '/';
		}

		$this->storageFilePath = $this->fileDirectory.$createFolder;

		Storage::disk($disk)->put($this->storageFilePath.$this->fullFileName, file_get_contents($this->file));
	}

	public function getStorageFilePath($fullPath = false, $disk = 'local') {
		return $fullPath ? (Storage::disk($disk)->getAdapter()->getPathPrefix().$this->storageFilePath) : $this->storageFilePath;
	}

	public function setFile($file) {
		$this->file = $file;

		$this->fileName = pathinfo($this->getFile()->getClientOriginalName(), PATHINFO_FILENAME);

		$this->fullFileName = $this->getFile()->getClientOriginalName();
    }

    public function createFileFromString($fileContents, $name)
    {
        $this->fileName = $name;
        $this->fullFileName = $name.'.c';
        $this->storageFilePath = $this->fileDirectory.$this->fileName;

        $absolutePathToFile = "{$this->fileDirectory}/{$this->fileName}/{$this->fullFileName}";

        Storage::put($absolutePathToFile, $fileContents);

        $this->file = Storage::get($absolutePathToFile);
    }

	public function getFile() {
		return $this->file;
	}

	public function setFileName($fileName) {
		$this->fileName = $fileName;
	}

	public function getFileName() {
		return $this->fileName;
	}

	public function setFullFileName($fullFileName) {
		$this->fullFileName = $fullFileName;
	}

	public function getFullFileName() {
		return $this->fullFileName;
	}

	public function setFileDirectory($fileDirectory) {
		$this->fileDirectory = $fileDirectory;
	}

	public function getFileDirectory() {
		return $this->fileDirectory;
	}
}
