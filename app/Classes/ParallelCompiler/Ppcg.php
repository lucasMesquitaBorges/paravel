<?php

namespace App\Classes\ParallelCompiler;

use App\Interfaces\ParallelCompilerInterface;
use App\Classes\FileManipulation;
use App\Classes\CodeAnotator\DawnCC;

class Ppcg implements ParallelCompilerInterface {
	private $file;

	public function cdToParallelCompilerBinaryDirectory() {
		chdir(config("app.ppcg_path"));
	}

	public function parallelizeFile() {
		$currentDirectory = getcwd();
		$fullFilePath = $this->file->getStorageFilePath(true).DawnCC::getAnotatedFileName($this->file->getFullFileName());

		$this->cdToParallelCompilerBinaryDirectory();
		exec("./ppcg --target=cuda $fullFilePath");

		exec("mv ".$this->file->getFileName()."* ".$this->file->getStorageFilePath(true));

		chdir($currentDirectory);

		return true;
	}

	public function setFile(FileManipulation $file) {
		$this->file = $file;
	}

	public function getFile() {
		return $this->file;
	}
}