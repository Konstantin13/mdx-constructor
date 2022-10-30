<?php

namespace MDX\DataTypes;

use MDX\ParserQuery;
use Exception;

class Range{
		
		var $item1, $item2;
		
		public static function query($item1,$item2){return new self($item1,$item2);}
		
		public function __construct($item1,$item2){
				
				$this->item1 = $this->parse($item1);
				$this->item2 = $this->parse($item2);
				
		}
		
		public function parse($item){

				if(ParserQuery::isBase($item)){
					return $item;
				}
				
				if($item instanceOf Member){
					return $item->get();
				}
				
				throw new Exception('the Range class received an invalid parameter. Expected base item, and getting ' . gettype($item));
			
		}
		
		public function get(){
				
				return "{" . $this->item1 . ":" . $this->item2 . "}";
				
		}
		
}