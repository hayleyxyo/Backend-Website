<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*	Thumbnailer Class
	================================================

	Options	You can specify options in the constructor.
			These options will act as globals for the
			rest of the work.

			You can also specify options in the call
			to make(). These options will override
			the options for a single thumbnail.


	Usage:	To use properly, make a new instance of
			Thumbnailer to load the original, and
			possibly set some of the options.

				$options=array(…);
				$thumbnail=new Thumbnailer($fileName,$options);

			Then call make() to save a thumbnail
			to a destination. You can call this
			multiple times with different destinations
			and with different options.

				$thumbnail->make($destination);
				$thumbnail->make($destination,$options);

	================================================ */

	class Thumbnailer {

		//	Properties
			private	$image;
			private	$thumbnail;
			private $type=null;
			private $name=null;

		//	Options
			private $defaultOptions=array(
				'width'=>160,
				'height'=>120,
				'method'=>'pad',
				'padding'=>0,
				'colour'=>null,
				'newtype'=>null,
				'scale'=>25,
				'fill'=>array(0,0,0),
			);
			private $options=array();

		//	Constructor

			public function __construct($fileName,$options=array()) {
				$this->image=self::load($fileName);
				$this->options=$this->defaultOptions;
				if($options) $this->setOptions($options);
			}

		//	Public Methods

			public function make($destination,$options=array()) {
				$thumbnail=$this->thumbnail($options);
				$type=@$this->options['newtype']?:$this->type;
				$this->save($thumbnail,$destination,$type);
			}

			public function setOptions($options) {
				if(!is_array($options)) parse_str($options,$array);
				$this->options=array_intersect_key(array_merge($this->options,$options),$this->options);
			}

		//	Utility Methods

			public function save($image,$fileName,$type=IMAGETYPE_JPEG,$rename=false) {
				$dirname=dirname($fileName);
				$basename=basename($fileName);
				if($rename) $basename=preg_replace('/(.*)\..*/','$1',$basename);

				switch($type) {
					case IMAGETYPE_PNG:
						if($rename) $fileName="$dirname/$basename.png";
						imagepng($image,$fileName);
						return true;
					case IMAGETYPE_JPEG:
						if($rename) $filename="$dirname/$basename.jpg";
						imagejpeg($image,$fileName);
						return true;
					case IMAGETYPE_GIF:
						if($rename) $filename="$dirname/$basename.gif";
						imagegif($image,$fileName);
						return true;
					default:
						return false;
				}
			}

			public function load($fileName) {
				if(!$imageData=getimagesize($fileName)) return false;
				list($w,$h,$type,$i)=$imageData;
				switch($type) {
					case IMAGETYPE_PNG:
						$image=imagecreatefrompng($fileName);
						break;
					case IMAGETYPE_JPEG:
						$image=imagecreatefromjpeg($fileName);
						break;
					case IMAGETYPE_GIF:
						$image=imagecreatefromgif($fileName);
						break;
					default:
						$image=false;
				}
				if(isset($this)) {	//	not static?
					$this->type=$type;
					$this->name=basename($fileName);;
				}
				return $image;
			}

		//	Make Thumbnail

		function thumbnail($options=array()) {
			//	Options
				$options=array_merge($this->options,array_intersect_key($options,$this->options));

			//	Source Dimensions
				$sw=imagesx($this->image);
				$sh=imagesy($this->image);

				$sratio=$sw/$sh;

			//	Adjust dimensions
				if($options['method']=='crop') {
					$thumbnail=imagecreatetruecolor($dw=$options['width'],$dh=$options['height']);

					$dratio=$dw/$dh;
					if($sratio<$dratio) 	$sh=$sw/$dratio;	//	source narrow => reset source height
					elseif($sratio>$dratio) $sw=$sh*$dratio;	//	source wide => reset wource width

					$dx=$dy=0;
				}
				elseif($options['method']=='pad' || $options['method']=='transparent') {
					$thumbnail=imagecreatetruecolor($dw=$options['width'],$dh=$options['height']);

					$dratio=$dw/$dh;
					if($sratio<$dratio) 	$dw=round($dh*$sratio);	//	source narrow => reset destination width
					elseif($sratio>$dratio) $dh=round($dw/$sratio);	//	source wide =? reset destination height

					$dx=($options['width']-$dw)/2;
					$dy=($options['height']-$dh)/2;
				}
				else {
					$thumbnail=imagecreatetruecolor($dw=$sw*$options['scale']/100,$dh=$sh*$options['scale']/100);
					$dx=$dy=0;
				}

			//	Fill Colour
				if($options['method']='transparent') {
					imagealphablending($thumbnail, false);
					imagesavealpha($thumbnail, true);
					$fill=imagecolorallocatealpha($thumbnail, $this->options['fill'][0],$this->options['fill'][1],$this->options['fill'][2], 127);
				}
				else $fill=imagecolorallocate($thumbnail, $this->options['fill'][0],$this->options['fill'][1],$this->options['fill'][2]);

				imagefill($thumbnail,0,0,$fill);

			//	Copy into Thumbnail
				imagecopyresampled($thumbnail,$this->image,$dx,$dy,0,0,$dw,$dh,$sw,$sh);

			//	Colorise
				if(!$options['colour'] && isset($options['color'])) $options['colour']=$options['color'];
				if($options['colour']=='grey'||$options['colour']=='gray'||$options['colour']=='sepia')
					imagefilter($thumbnail,IMG_FILTER_GRAYSCALE);
				if($options['colour']=='sepia')
					imagefilter($thumbnail,IMG_FILTER_COLORIZE,90,60,40);

			return $thumbnail;
		}
	}
?>
<?php

	/*	Procedural Functions
		================================================ */

		function makeThumbnail($source,$destination,$options=array()) {
			$thumbnail=new Thumbnailer($source,$options);
			$thumbnail->make($destination);
		}


?>
