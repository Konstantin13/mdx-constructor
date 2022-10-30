<?php

namespace Konstantin13\MDX\DataTypes;

use Konstantin13\MDX\ParserQuery;

/*
	syntax: [Base, DataType, ...]
	return: (string) '(Base, DataType, ...)'
*/

class Turple{
		
		var $arr;
		
		public static function query($arr){return new self($arr);}
		
		public function __construct($arr){
								
				$this->arr = $this->parse($arr);
				
		}
		
		public function parse($arr){
				
				if(!is_array($arr)){
						$arr = [$arr];
				}
				
				foreach($arr as $key=>$item){
						
						if(ParserQuery::isDataType($item)){
							$arr[$key] = $item->get();
							
						}elseif(!ParserQuery::isBase($item)){
							$arr[$key] = ParserQuery::parse($item);
							
						}
						
				}

				return $arr;
				
		}
		
		public function get(){
				
				return "(" . implode(", ", $this->arr) . ")";
				
		}
		
}