<?php

namespace App\Classes\SequentialCode;

use App\Interfaces\SequentialCodeInterface;

abstract class SequentialCode implements SequentialCodeInterface {

	public function test() {
		echo "test";
	}

}