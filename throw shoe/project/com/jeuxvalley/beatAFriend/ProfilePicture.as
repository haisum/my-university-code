package com.jeuxvalley.beatAFriend
{
	import flash.display.MovieClip;
	import fl.motion.AnimatorFactory3D;
	import fl.motion.MotionBase;
	import flash.filters.*;
	import flash.geom.Point;
	public class ProfilePicture
	{
		private var profilePic:MovieClip;
		private var hitEffect:MovieClip;
		private var picWidth:Number;
		private var picHeight:Number;
		private var __motion_Symbol3_191:MotionBase;
		private var __animFactory_Symbol3_191:AnimatorFactory3D;
		public function ProfilePicture(profilePic:MovieClip, hitEffect:MovieClip, picWidth:Number = 50, picHeight:Number = 50)
		{
			this.profilePic = profilePic;
			this.hitEffect = hitEffect;
			this.picWidth = picWidth;
			this.picHeight = picHeight;
			setMcProperties();
			addHitEffect();

		}
		public function gotHit():void
		{
			__motion_Symbol3_191 = null;
			__animFactory_Symbol3_191 = null;
			hitEffect.alpha = 100;
			dropPic();
		}
		private function dropPic():void
		{

			if (__motion_Symbol3_191 == null)
			{
				__motion_Symbol3_191 = new MotionBase();
				__motion_Symbol3_191.duration = 12;

				// Call overrideTargetTransform to prevent the scale, skew,
				// or rotation values from being made relative to the target
				// object's original transform.
				// __motion_Symbol3_191.overrideTargetTransform();

				// The following calls to addPropertyArray assign data values
				// for each tweened property. There is one value in the Array
				// for every frame in the tween, or fewer if the last value
				// remains the same for the rest of the frames.
				__motion_Symbol3_191.addPropertyArray("x", [0]);
				__motion_Symbol3_191.addPropertyArray("y", [0]);
				__motion_Symbol3_191.addPropertyArray("scaleX", [0.000000]);
				__motion_Symbol3_191.addPropertyArray("scaleY", [0.000000]);
				__motion_Symbol3_191.addPropertyArray("skewX", [0]);
				__motion_Symbol3_191.addPropertyArray("skewY", [0]);
				__motion_Symbol3_191.addPropertyArray("z", [0]);
				__motion_Symbol3_191.addPropertyArray("rotationX", [6,-0.391733,-6.78347,-13.1752,-19.5669,-25.9587,-32.3504,-38.7421,-45.1339,-51.5256,-57.9173,-64.3091]);
				__motion_Symbol3_191.addPropertyArray("rotationY", [0,-0.438662,-0.877324,-1.31599,-1.75465,-2.19331,-2.63197,-3.07063,-3.50929,-3.94796,-4.38662,-4.82528]);
				__motion_Symbol3_191.addPropertyArray("rotationZ", [0,0.0580981,0.116196,0.174294,0.232393,0.290491,0.348589,0.406687,0.464785,0.522883,0.580981,0.639079]);
				__motion_Symbol3_191.addPropertyArray("blendMode", ["normal"]);
				__motion_Symbol3_191.addPropertyArray("cacheAsBitmap", [false]);

				// Create an AnimatorFactory instance, which will manage;
				// targets for its corresponding Motion.
				__animFactory_Symbol3_191 = new AnimatorFactory3D(__motion_Symbol3_191);
				__animFactory_Symbol3_191.transformationPoint = new Point(0.000000,0.000000);

				// Call the addTarget function on the AnimatorFactory
				// instance to target a DisplayObject with this Motion.
				// The second parameter is the number of times the animation
				// will play - the default value of 0 means it will loop.
				__animFactory_Symbol3_191.addTarget(profilePic, 1);
			}

		}
		private function addHitEffect():void
		{
			profilePic.addChildAt(hitEffect, profilePic.numChildren);
		}
		private function setMcProperties():void
		{
			profilePic.height = picHeight;
			profilePic.width = picWidth;
			hitEffect.height = picHeight * 0.6;// 60 % of profile pic
			hitEffect.width = picWidth * 0.6;
			hitEffect.x = 5;
			hitEffect.y = 5;
			hitEffect.alpha = 0;
		}

	}


}