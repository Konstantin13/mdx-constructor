<?php

namespace konstantin13\MDX;

class BuilderQuery{
		
		var $structure;
		
		public function __construct($structure){
			
				$this->structure = $structure;
				
		}
		
		public function buildWith(){
				
				$response = '';
				
				if(isset($this->structure["with"]) and is_array($this->structure["with"])){
						
						foreach($this->structure["with"] as $itemWith){
							$response .= "WITH " . $itemWith . " ";
						}
						
				}
				
				return $response;
				
		}
		
		public function buildOnColumns(){
				
				if($this->structure["onColumns"]){
					return $this->structure["onColumns"] . " ON COLUMNS";
				}else{
					return "";
				}
				
		}
		
		public function buildOnRows(){
				
				if($this->structure["onRows"]){
					return $this->structure["onRows"] . " ON ROWS";
				}else{
					return "";
				}
				
		}
		
		public function buildSelect(){
				
				return "SELECT " . $this->buildOnColumns() . " " . $this->buildOnRows();
				
		}
		
		public function buildFrom(){
				
				return "FROM " . "(" . $this->structure["from"] . ")";
				
		}
		
		public function build(){
				
				return
						$this->buildWith() . " " . 
						$this->buildSelect() . " " . 
						$this->buildFrom();
					
				
		}
		
}