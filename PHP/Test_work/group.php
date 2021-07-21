<?php

class Group
{
	private $name;
	private $teams = [];

	public function __construct($name, Group $group = NULL)
	{
		$this->name = $name;
		if ($group !== NULL) {
			$count = count($group->teams);
			for ($i = 0; $i < $count; $i++) {
				$this->teams[] = $group->teams[$i];
			}
		}
	}

	public function __toString()
	{
		return $this->name;
	}

/* 	public function __set($name, $value)
	{
		switch ($name) {
			case 'name':
				$this->name = $value;
				break;
			case 'teams':
				$this->teams = $value;
				break;
		}
	}

	public function __get($name)
	{
		switch ($name) {
			case 'name':
				return $this->name;
			case 'teams':
				return $this->teams;
		}
	} */

	public function addTeam(Team $team)
	{
		$this->teams[count($this->teams)] = $team;
		return $this;
	}

	public function generateCalendar()
	{
		if (count($this->teams) % 2 !== 0)    //проверяем четное ли количество команд, и если нет то добавляем в конец строчку "slip" - она нужна будет для пропуска игры
			array_push($this->teams, "slip");

		$count = count($this->teams);   //присваиваем длинну массива (количество команд) переменной, что бы не использовать функцию в условиях цикла
		$row2 = array_splice($this->teams, ($count / 2));   //присваиваем переменной вторую часть массива
		$row1 = $this->teams;   //присваиваем переменной первую часть массива
		$row2 = array_reverse($row2);   //переварачиваем второй массив что бы следовать круговой системе
		//var_dump($row2);
		//var_dump($row2);
		for ($i = 1; $i < $count; $i++) {   //глобальный цикл количества туров
			echo $this->name . ". Round $i <br />";
			if ($i == 1) {   //самый первый тур
				for ($j = 0; $j < $count / 2; $j++) {   //цикл для игр в туре
					if ($row1[$j] !== "slip" && $row2[$j] !== "slip")   //проверяем что бы значения были отличными от "slip" и в первом и во втором массиве команд
						echo $row1[$j] . ' - ' . $row2[$j] . '<br />';   //если true, то происходит игра
					else continue;   //а если false то игра пропускается и переходит к следующей
				}
			} else {   //все последующие туры
				array_push($row2, array_pop($row1));   //извлекаем последний элемент из первого массива и добавляем в конец второго
				$first = array_shift($row1);   //извлекаем и сохраняем отдельно первый элемент первого массива (самую первую команду)
				array_unshift($row1, array_shift($row2));   //извлекаем первый элемент второго массива и добавляем в начало первого массива
				array_unshift($row1, $first);   //и в конце добавляем (возвращаем) самую первую команду в начало первого массива
				for ($j = 0; $j < $count / 2; $j++)
					if ($row1[$j] !== "slip" && $row2[$j] !== "slip")
						echo $row1[$j] . ' - ' . $row2[$j] . '<br />';
					else continue;
			}
		}
	}
}
