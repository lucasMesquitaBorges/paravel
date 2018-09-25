<?php

namespace App\Classes\CodeAnotater;

use App\Classes\CodeAnotater\CodeAnotater;
use Storage;

class DawnCC extends CodeAnotater {

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