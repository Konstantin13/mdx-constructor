<?php

namespace MDX\DataTypes;

use MDX\ParserQuery;
use Exception;

/*
	syntax: string
	return: string
*/

class Member{
		
		var $item;
		
		public static function query($item){return new self($item);}
		
		public function __construct($item){
				
				$this->item = $this->parse($item);
				
		}
		
		public function parse($item){
				
				if(!ParserQuery::isBase($item)){
					throw new Exception("the Member class received an invalid parameter. Expected base item, and getting " . gettype($item));
				}
				
				return $item;
				
		}
		
		public function get(){
				
				return $this->item;
				
		}
		
}