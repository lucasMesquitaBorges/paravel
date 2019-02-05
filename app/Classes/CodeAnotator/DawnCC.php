<?php

namespace App\Classes\CodeAnotator;

use App\Classes\CodeAnotator\CodeAnotator;
use Storage;

class DawnCC extends CodeAnotator {

	public function anotateFile($fileDirectory) {
		$currentDirectory = getcwd();

		$this->cdToCodeAnotaterBinaryDirectory();
		exec("./run.sh -d ". config("app.dawnCC_path") ." -src ".$fileDirectory);

		chdir($currentDirectory);
	}

	public function cdToCodeAnotaterBinaryDirectory() {
		chdir(config("app.dawnCC_path").'/DawnCC/');
	}

	public static function getAnotatedFileName($fileName) {
		return (pathinfo($fileName, PATHINFO_FILENAME).'_AI.'.pathinfo($fileName, PATHINFO_EXTENSION));
	}
}