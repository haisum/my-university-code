package com.jeuxvalley{
	import flash.events.Event;
	import flash.display.MovieClip;
	
	public class PictureEvent extends Event {
		private var _mc:MovieClip = null;
		public function PictureEvent(mc:MovieClip , TYPE:String) {
			super( TYPE );
			this._mc = mc;
		}
		public function get mc():MovieClip{
			return _mc;
		}

	}
	
}
