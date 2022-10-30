<?php

namespace konstantin13\MDX;

use MDX\ParserQuery;
use MDX\BuilderQuery;

class MDX{
		
		private $structure = [
			"onColumns" => null,
			"onRows" => null,
			"with" => [],
			"from" => null,
		];
		
		public function __construct(){}
		
		public static function select(){ return new self; }
		
		public function onColumns($query){
				
				$this->structure["onColumns"] = $this->parseQuery($query);
				
				return $this;
				
		}
		
		public function onRows($query){
				
				$this->structure["onRows"] = $this->parseQuery($query);
				
				return $this;
				
		}
		
		public function with($name, $query){
				
				$this->structure["with"][] = "SET $name AS " . $this->parseQuery($query);
				
				return $this;
				
		}
		
		public function from($query){
				
				$this->structure["from"] = $this->parseQuery($query);
				
				return $this;
				
		}
		
		public function get(){
				
				$builder = new BuilderQuery($this->structure);
				
				return $builder->build();
								
		}
		
		public function parseQuery($query){
				
				return ParserQuery::parse($query);
				
				
		}
		
		
		
}