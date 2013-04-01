package com.jeuxvalley
{
	import flash.display.Loader;
	import flash.net.URLRequest;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.EventDispatcher;
	import flash.text.TextField;
	import flash.events.IOErrorEvent;

	public class PictureLoader extends Sprite
	{
		public static const PICTURE_LOADED:String = "picture_loaded";
		private var loader:Loader;
		private var loc:String;
		private var bitmap:Bitmap;
		private var isLoaded:Boolean = false;
		private var error:String = "";
		public function PictureLoader(loc:String)
		{
			this.loc = loc;
			loadContent();
		}
		private function get movieClip():MovieClip
		{

			var mc:MovieClip = new MovieClip();
			if (error == "")
			{
				mc.addChild(new Bitmap(bitmap.bitmapData));
				return mc;
			}
			else{
				var txt:TextField = new TextField();
				txt.text = error;
				mc.addChild(txt);
				return mc;
			}

		}
		private function loadContent():void
		{
			loader = new Loader();
			loader.load(new URLRequest(loc));
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, movieLoaded, false, 0 , true);
			loader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR, errorOccured, false, 0 , true);
			loader.contentLoaderInfo.addEventListener(IOErrorEvent.NETWORK_ERROR, errorOccured, false, 0 , true);
		}
		private function errorOccured(e:IOErrorEvent):void
		{
			error = e.text;
			trace("Error Message: " + error);
			trace("Type: " + e.type);
			dispatchEvent(new PictureEvent(this.movieClip , PICTURE_LOADED));
		}
		private function movieLoaded(e:Event):void
		{
			setBitmapFromLoader();
			dispatchEvent(new PictureEvent(this.movieClip , PICTURE_LOADED));

		}
		private function setBitmapFromLoader():void
		{
			bitmap = new Bitmap(Bitmap(loader.content).bitmapData);

		}

	}


}