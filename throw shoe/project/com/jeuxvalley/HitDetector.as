package com.jeuxvalley {
	import flash.display.MovieClip;
	import flash.display.DisplayObject;
	
	public class HitDetector {
		public function HitDetector() {			
		}
		public function testHitAgainstMany(objToTest:DisplayObject , objToTestAgainst:Array):Boolean{
			var hasHit:Boolean = false;
			for(i:int;i<objToTestAgainst.length;i++){				
				if(objToTest.hitTestObject(objToTestAgainst[i] as DisplayObject)){
					hasHit = true;
				}
			}
			return hasHit;
		}
		public function testHitAgainstOne(objToTest:DisplayObject , objToTestAgainst:DisplayObject):Boolean{
			return objToTest.hitTestObject(objToTestAgainst);
		}

	}
	
}
