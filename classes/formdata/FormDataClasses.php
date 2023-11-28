<?php

class FastEducationData
{
	private $type = 'fast_education';
	private $semester;
	private $course;


	public function __construct()
	{
		$this->semester = $_SESSION['user']['semestr'];
		$this->course = ceil($_SESSION['user']['semestr'] / 2);
	}


	public function toArray()
	{
		return [
			'type' => $this->type,
			'semester' => $this->semester,
			'course' => $this->course
		];
	}
}


class PersonalData
{
	private $type = 'personal';


	public function toArray()
	{
		include_once('module/spravkanew/asr1C.class');
		$asr1C = new asr1C();
		$response1C = $asr1C->GetData('current_name', ['student_id' => $_SESSION['user']['zbook']]);
		return [
			'type' => $this->type,
			'last_name' => $response1C['current_name']['last_name'],
			'first_name' => $response1C['current_name']['first_name'],
			'middle_name' => $response1C['current_name']['middle_name']
		];
	}
}


class DiscountData
{
	private $type = 'discount';


	public function toArray()
	{
	
		$response1C = spravka1c::$asr1C->GetData('payment_info', ['student_id' => $_SESSION['user']['zbook']]);
		$_SESSION['user']['future_semesters'] = $response1C['payment_info'][0]['future_semesters'];
		return [
			'type' => $this->type,
			'sum' => (string)$response1C['payment_info'][0]['future_semesters'][0]['price']
		];
	}
}


class IupData
{
	private $type = 'iup';


	public function toArray()
	{
	
		return [
			'type' => $this->type,
			'semester' => 1
		];
	}
}

