<?php
/**
 * Ouvre un fichier JSON et retourne un tableau
 */
function jsonFileToArray(string $filename){
	$str=file_get_contents($filename);
	return json_decode($str,true);
}
/**
 * Affiche le tableau de données $values
 */
function arrayDump(array $values,?string $title=null):void{
	if($title!=null){
		echo "\n$title\n";
		echo "-----------------------\n";
	}
	foreach($values as $element){
		foreach($element as $name=>$value){
				echo "$name : $value\t";
		}
		echo "\n";
	}
}
/**
 * Ouvre un fichier JSON et retourne un tableau
 * Affiche le tableau de données $values
 */
function loadAndDump(string $filename):array{
	$values=jsonFileToArray($filename);
	arrayDump($values,basename($filename));
	return $values;
}

function getEmployeesByService(array $employees,string $service):array{
	return array_filter($employees,function($emp)use($service) {
		return $emp['service']==$service;}
	);
}

/**
 * Retourne un tableau filtr� d'�l�ments satisfaisant une condition $key=$value
 * @param array $array Tableau � filtrer
 * @param string $key nom du champ sur lequel une condition est pos�e
 * @param mixed $value valeur de recherche
 * @return array 
 */
function where(array $array, string $key, $value):array{
    $result=[];
    foreach ($array as $element){
        if ($element[$key]===$value){
            $result[]=$element;
        }
    }
    return $result;
}

/**
 * Retourne une version du tableau $array
 * dans laquelles seuls les champs $selectFields sont conserv�s
 * @param array $array Tableau initial
 * @param array $selectFields liste des champs s�lectionn�s
 * @return array
 */
function select(array $array, array $selectFields):array{
    $result=[];
    foreach ($array as $index=>$element){
        $result[$index]=[];
        foreach ($selectFields as $fieldkey){
            $result[$index][$fieldkey]=$element[$fieldkey];
        }
    }
    return $result;
}


/**
 * @param array $array
 * @param array $selectFields
 * @param array $where
 */
function selectWhere(array $array, array $selectFields, array $where):array{
    return select(where($array,$where[0], $where[1]), $selectFields);
}








