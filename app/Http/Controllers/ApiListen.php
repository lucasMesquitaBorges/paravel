<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\SequentialCode\CSequentialCode;
use App\Classes\ParallelCompiler\Ppcg;
use App\Classes\CodeAnotator\DawnCC;
use App\Classes\FileManipulation;
use Storage;

class ApiListen extends Controller
{
	public function testCodeAnotate() {
		return view('tests.testCodeAnotate');
	}

	public function testCodeAnotatePost(Request $request) {
        $dawnCCAnotator = new DawnCC();
		$ppcg = new Ppcg();

		$file = new FileManipulation();
		$file->setFile($request->file('fileTest'));

		$file->setFileDirectory('anotateFiles/');
		$file->storageFile($file->getFileName());

		$dawnCCAnotator->anotateFile($file->getStorageFilePath(true));

		$ppcg->setFile($file);
		if($ppcg->parallelizeFile()) {
			$execName = $file->getFileName().'GPU';
			chdir($file->getStorageFilePath(true));
			exec("nvcc ".$file->getFileName().'_AI_host.cu -arch='.config('app.arch_sm')." -o ".$execName);

			$execOutput = shell_exec("./$execName");
		}

		return $execOutput;
    }

    public function parallelize(Request $request)
    {
        $dawnCCAnotator = new DawnCC();
        $file = new FileManipulation();

        $code = str_replace('#include "simpletools.h"', '#include <stdio.h>', $request->code);

        $file->setFileDirectory('anotateFiles/');
        $file->createFileFromString($code, $request->projectName);

		$dawnCCAnotator->anotateFile($file->getStorageFilePath(true));

        $ppcg = new Ppcg();
		$ppcg->setFile($file);
		if($ppcg->parallelizeFile()) {
			$execName = $file->getFileName().'GPU';
            chdir($file->getStorageFilePath(true));

            $compilerOutput = shell_exec("nvcc ".$file->getFileName().'_AI_host.cu -arch='.config('app.arch_sm')." -o ".$execName);

			$execOutput = shell_exec("./$execName");
		}

        return response()->json([
                            'success' => true,
                            'compilerOutput' => $execOutput,
                            'compilerError' => ""
                        ]);
    }
}
