<?php
	/*
	 * File to receive Notify from PayGate
	 * NOTE: File must be made accessible by www
	 */

	error_log(file_get_contents('php://input'));

	echo 'OK';