<?php

use MDX\MDX;
use MDX\DataTypes\Member;
use MDX\DataTypes\Turple;
use MDX\DataTypes\Set;
use MDX\DataTypes\Range;
use MDX\DataTypes\NoneEmpty;
use MDX\DataTypes\Cross;

//include "MDX\MDX.php";
//include "MDX\DataTypes\Member.php";
//include "MDX\DataTypes\Cross.php";
//include "MDX\DataTypes\NoneEmpty.php";
//include "MDX\DataTypes\Range.php";
//include "MDX\DataTypes\Set.php";
//include "MDX\DataTypes\Turple.php";
//include "MDX\ParserQuery.php";
//include "MDX\BuilderQuery.php";


//	WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
//	SELECT
//		NoneEmpty(
//			[Address].[Town] * NoneEmpty(
//				[Branch].[Name] * NoneEmpty([SaleType].[Name], MySetName),
//				 MySetName
//			), 
//			MySetName
//		) * MySetName ON COLUMNS,
//		NoneEmpty(
//			[Product].[Product].[Name] * NoneEmpty([Date].[Date].[Day], MySetName), 
//			MySetName
//		) ON ROWS
//	FROM (
//		SELECT 
//			{[Product].[Product].&[134947954], [Product].[Product].&[134947981], [Product].[Product].&[11145970], [Product].[Product].&[101362503]} * {[Address].[Region].&[77], [Address].[Region].&[54]} *{[Branch].[Name].&[6332], [Branch].[Name].&[295]} ON COLUMNS
//		FROM (
//			SELECT
//				{[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
//			FROM [Sales]
//		)
//	)

$query = MDX::select()
		->with('MySetName', Set::query(["[Measures].[Amount]","[Measures].[Rest]"]))
		->onColumns(
			Cross::query([
				NoneEmpty::query([
					Cross::query([
						"[Address].[Town]",
						NoneEmpty::query([
							Cross::query([
								"[Branch].[Name]",
								NoneEmpty::query(["[SaleType].[Name]", "MySetName"])
							]),
							"MySetName",
						])
					]),
					"MySetName",
				]),
				"MySetName",
			])
		)
		->onRows(
			NoneEmpty::query([
					Cross::query([
						"[Product].[Product].[Name]",
						NoneEmpty::query([
							"[Date].[Date].[Day]", "MySetName",
						]),
					]),
					"MySetName",
			])
		)
		->from(function($subQuery){
			$subQuery
				->onColumns(
					Cross::query([
						Set::query([
							"[Product].[Product].&[134947954]",
							"[Product].[Product].&[134947981]",
							"[Product].[Product].&[11145970]",
							"[Product].[Product].&[101362503]"
						]),
						Set::query([
							"[Address].[Region].&[77]",
							"[Address].[Region].&[54]",
						]),
						Set::query([
							"[Branch].[Name].&[6332]",
							"[Branch].[Name].&[295]",
						]),
					])
				)
				->from(function($subQuery){
					$subQuery
						->onColumns(
							Range::query(
								"[Date].[Date].[Month].&[202101]",
								"[Date].[Date].[Month].&[202112]"
							)
						)
						->from("[Sales]");
				});
		})
		->get();
		