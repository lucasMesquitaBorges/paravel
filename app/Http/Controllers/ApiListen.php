<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SequentialCode\CSequentialCode;
use App\Classes\CodeAnotater\DawnCC;
use App\Classes\FileManipulation;
use Storage;

class ApiListen extends Controller
{
	public function testCodeAnotate() {
		return view('tests.testCodeAnotate');
	}

	public function testCodeAnotatePost(Request $request) {
		$dawnCCAnotator = new DawnCC();

		$file = new FileManipulation();
		$file->setFile($request->file('fileTest'));

		$file->setFileDirectory('anotateFiles/');
		$file->storageFile($file->getFileName());

		$dawnCCAnotator->anotateFile($file->getStorageFilePath(true));

		return Storage::download($file->getStorageFilePath().DawnCC::getAnotatedFileName($file->getFullFileName()));
	}
}