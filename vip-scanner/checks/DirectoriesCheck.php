<?php

class DirectoriesCheck extends BaseCheck {
	function check( $files ) {

		$result = true;
		$found = false;

		foreach ( $files as $path => $file ) {
			$this->increment_check_count();
			foreach ( $this->development_directories as $development_directory ) {
				if ( strpos( $path, $development_directory ) !== false ) {
					$found = true;
				}
			}
		}

		if ( $found ) {
			$this->add_error(
				'unnecessary-directories',
				'Please remove any extraneous directories like: ' . implode( ',', $this->development_directories ),
				'required'
			);
			$result = false;
		}
		return $result;
	}
}
