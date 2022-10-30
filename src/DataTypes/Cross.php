<?php

namespace MDX\DataTypes;

use Exception;
use MDX\ParserQuery;

/*
	syntax: [Base, DataType, ...]
	return: Base * DataType * ...
*/

class Cross{
		
		var $arr;
		
		public static function query($arr){return new self($arr);}
		
		public function __construct($arr){
				
				$this->arr = $this->parse($arr);
				
		}
		
		public function parse($arr){
				
				if(!is_array($arr)){
						throw new Exception("the Cross class received an invalid parameter. Expected array, and getting " . gettype($arr));
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
				
				return implode(" * ", $this->arr);
				
		}
		
}