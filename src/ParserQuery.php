<?php

namespace konstantin13\MDX;

class ParserQuery{
		
		/*
			-Строки - Member
			-Кортежи - Turple, syntax: [Member1, Member2, ...]
			-Наборы - Set, syntax: [Turple|Member|Set, Turple|Membe|Set, ...]
			-Range, syntax: (Member1, Member2)
			-NoneEmpty, syntax: [Set1, Set2, ...]
			-CrossJoin, syntax: [Set1, Set2, ...]
		*/
		
		/*
			Получает на входе $query, который может быть строкой / массивом / классом / callable функцией
			В качестве результата возвращает строку
		*/
		
		public static function parse($query){
								
				if(self::isBase($query)){
					
						return $query;
					
				}elseif(is_array($query)){
					
						return Turple::query()->get($query);
					
				}elseif(is_callable($query)){
						
						$subQuery = new MDX;
						$query($subQuery);
						return $subQuery->get();
						
				}elseif(is_object($query)){
						
						return $query->get();
						
				}
				
		}
		
		/*
			Проверяет, является ли элемент базовым:
				- строкой / числом
		*/
		public static function isBase($item){
				
				if(is_string($item) or is_numeric($item)){
					return true;
				}else{
					return false;
				}
				
		}
		
		public static function isDataType($item){
				
				
				
		}
		
		public static function getDataType($item){
				
				
				
		}
		
}