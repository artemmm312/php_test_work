<?php

class Team
{
	private $name;
	private $country;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function __toString()
	{
		if ($this->country !== NULL)
			return $this->name . ' (' . $this->country . ')';
		else return $this->name;
	}

/* 	public function __set($name, $value)
	{
		switch ($name) {
			case 'name':
				$this->name = $value;
				break;
			case 'country':
				$this->country = $value;
				break;
		}
	}

	public function __get($name)
	{
		switch ($name) {
			case 'name':
				return $this->name;
			case 'country':
				return $this->country;
		}
	} */

	public function setCountry($country)
	{
		$this->country = $country;
		return $this;
	}
}
